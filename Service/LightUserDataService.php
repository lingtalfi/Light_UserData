<?php


namespace Ling\Light_UserData\Service;


use Ling\Bat\FileSystemTool;
use Ling\Bat\HashTool;
use Ling\DirScanner\YorgDirScannerTool;
use Ling\Light\Core\Light;
use Ling\Light\Http\HttpRequestInterface;
use Ling\Light\ReverseRouter\LightReverseRouterInterface;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_Initializer\Initializer\LightInitializerInterface;
use Ling\Light_PluginDatabaseInstaller\Service\LightPluginDatabaseInstallerService;
use Ling\Light_User\LightUserInterface;
use Ling\Light_UserData\Api\LightUserDataApiFactory;
use Ling\Light_UserData\Exception\LightUserDataException;
use Ling\Light_UserDatabase\LightWebsiteUserDatabaseInterface;
use Ling\SimplePdoWrapper\SimplePdoWrapperInterface;
use Ling\SimplePdoWrapper\Util\MysqlInfoUtil;

/**
 * The LightUserDataService class.
 *
 * For more details, refer to the @page(conception notes).
 */
class LightUserDataService implements LightInitializerInterface
{


    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;

    /**
     * This property holds the rootDir for this instance.
     * @var string
     */
    protected $rootDir;

    /**
     * This property holds the currentUser for this instance.
     * @var LightUserInterface|null
     */
    protected $currentUser;

    /**
     * This property holds the obfuscationAlgorithm for this instance.
     *
     *
     * @var string=default
     */
    protected $obfuscationAlgorithm;

    /**
     * This property holds the obfuscationSecret for this instance.
     * @var string=abc
     */
    protected $obfuscationSecret;

    /**
     * This property holds the factory for this instance.
     * @var LightUserDataApiFactory
     */
    protected $factory;


    /**
     * This property holds the directoryKey for this instance.
     * @var string
     */
    private $directoryKey;


    /**
     * Builds the LightUserDataService instance.
     */
    public function __construct()
    {
        $this->container = null;
        $this->rootDir = null;
        $this->currentUser = null;
        $this->obfuscationAlgorithm = "default";
        $this->obfuscationSecret = 'abc';
        $this->factory = new LightUserDataApiFactory();
        $this->directoryKey = "directory";
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * @implementation
     */
    public function initialize(Light $light, HttpRequestInterface $httpRequest)
    {
        /**
         * @var $pih LightPluginDatabaseInstallerService
         */
        $pih = $this->container->get("plugin_database_installer");
        if (false === $pih->isInstalled("Light_UserData")) {
            $pih->install("Light_UserData");
        }

    }

    /**
     * Installs the database part of this planet.
     *
     * @throws \Exception
     */
    public function installDatabase()
    {

        /**
         * @var $db SimplePdoWrapperInterface
         */
        $db = $this->container->get("database");


        $util = new MysqlInfoUtil();
        $util->setWrapper($db);
        if (false === $util->hasTable("luda_directory_map")) {


            /**
             * We cannot put this statement inside the transaction, because of the mysql implicit commit rule:
             * https://dev.mysql.com/doc/refman/8.0/en/implicit-commit.html
             */
            $db->executeStatement(file_get_contents(__DIR__ . "/../assets/fixtures/recreate-structure.sql"));
            $this->refreshReferences();

        }
    }


    /**
     * Uninstalls the database part of this planet.
     *
     * @throws \Exception
     */
    public function uninstallDatabase()
    {
        /**
         * @var $db SimplePdoWrapperInterface
         */
        $db = $this->container->get('database');

        $db->executeStatement("DROP table if exists luda_resource_has_tag");
        $db->executeStatement("DROP table if exists luda_resource");
        $db->executeStatement("DROP table if exists luda_tag");
        $db->executeStatement("DROP table if exists luda_directory_map");


        //--------------------------------------------
        // REMOVING REFERENCES FROM THE LUD_USER TABLE
        //--------------------------------------------
        /**
         * @var $exception \Exception
         */
        $exception = null;
        $res = $db->transaction(function () {
            /**
             * @var $userDb LightWebsiteUserDatabaseInterface
             */
            $userDb = $this->container->get("user_database");
            $rows = $userDb->getAllUserInfo();
            foreach ($rows as $row) {
                $extra = $row['extra'];
                unset($extra[$this->directoryKey]);
                $row['extra'] = $extra;
                $userDb->updateUserById($row['id'], $row);
            }
        }, $exception);

        if (false === $res) {
            throw $exception;
        }

    }

    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Sets the container.
     *
     * @param LightServiceContainerInterface $container
     * @throws \Exception
     */
    public function setContainer(LightServiceContainerInterface $container)
    {
        $this->container = $container;
        $this->factory->setPdoWrapper($container->get("database"));
    }


    /**
     * Sets the obfuscation parameters to use.
     *
     * @param string $algoName
     * @param string $secret
     */
    public function setObfuscationParams(string $algoName, string $secret)
    {
        $this->obfuscationAlgorithm = $algoName;
        $this->obfuscationSecret = $secret;
    }

    /**
     * Sets the rootDir.
     *
     * @param string $rootDir
     */
    public function setRootDir(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * Returns the rootDir of this instance.
     *
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }


    /**
     * Sets a temporary user.
     *
     * @param LightUserInterface $user
     */
    public function setTemporaryUser(LightUserInterface $user)
    {
        $this->currentUser = $user;
    }

    /**
     * Unsets the temporary user if any.
     */
    public function unsetTemporaryUser()
    {
        $this->currentUser = null;
    }


    /**
     * Returns the array of the files owned by the current user.
     * If the directory is specified, only the list of the files found in that directory will be returned.
     *
     * Relative paths (from the user's root directory) are returned.
     *
     *
     * @param string|null $directory
     * @return array
     * @throws \Exception
     */
    public function list(string $directory = null): array
    {
        $dir = $this->getUserDir();
        if (null !== $directory) {
            $dir .= "/" . $directory;
        }
        return YorgDirScannerTool::getFilesWithoutExtension($dir, "private", false, true, true);
    }


    /**
     * Saves the data for the current user to the given relative path.
     *
     * The available options are:
     * - tags: an array of tags to bind to the given resource
     * - is_private: bool=false
     *
     *
     *
     * @param string $path
     * @param string $data
     * @param array $options
     * @throws \Exception
     */
    public function save(string $path, string $data, array $options = [])
    {

        $tags = $options['tags'] ?? [];
        $is_private = $options['is_private'] ?? false;


        /**
         * @var $db SimplePdoWrapperInterface
         */
        $db = $this->container->get("database");
        /**
         * @var $exception \Exception
         */
        $exception = null;
        $res = $db->transaction(function () use ($tags, $path) {
            $resourceId = $this->factory->getResourceApi()->insertResource([
                "real_path" => $path,
            ]);

            if ($tags) {
                foreach ($tags as $tag) {
                    $tagId = $this->factory->getTagApi()->insertTag([
                        "name" => $tag,
                    ]);

                    $this->factory->getResourceHasTagApi()->insertResourceHasTag([
                        "resource_id" => $resourceId,
                        "tag_id" => $tagId,
                    ]);
                }
            }

        }, $exception);

        if (false === $res) {
            throw $exception;
        }


        $file = $this->getUserDir() . "/$path";
        FileSystemTool::mkfile($file, $data);

        if (true === $is_private) {
            FileSystemTool::mkfile($file . ".private", $data);
        }

        //--------------------------------------------
        // RETURNING THE LINK
        //--------------------------------------------
    }


    /**
     * Returns the url to access the resource identified by the given userIdentifier and relativePath.
     * The relativePath is the path relative from the user directory.
     *
     *
     * @param string $userIdentifier
     * @param string $relativePath
     * @return string
     * @throws LightUserDataException
     * @throws \Exception
     */
    public function getResourceUrl(string $userIdentifier, string $relativePath): string
    {
        $file = $this->rootDir . "/" . $userIdentifier . "/" . $relativePath;
        if (file_exists($file)) {


            $row = $this->factory->getDirectoryMapApi()->getDirectoryMapByRealName($userIdentifier);
            if (null !== $row) {
                $obfuscatedName = $row['obfuscated_name'];

                /**
                 * @var $rr LightReverseRouterInterface
                 */
                $rr = $this->container->get('reverse_router');
                return $rr->getUrl("luda_route-virtual_server", [
                    "file" => $relativePath,
                    "id" => $obfuscatedName,
                ]);


            } else {
                throw new LightUserDataException("A problem occurred with the file $relativePath, the given user identifier wasn't found in the database. You might want to refresh the references, or maybe the user has been deleted?");
            }

        } else {
            // don't expose the user identifier in the error message, because that error message could be displayed to the user...
            throw new LightUserDataException("File does not exist: $relativePath.");
        }
    }


    /**
     * Returns the content of the file of the current user which relative path is given.
     * If the file doesn't exist, the method:
     *
     * - returns false if the throwEx flag is set to false
     * - throws an exception if the throwEx flag is set to true
     *
     *
     *
     * @param string $path
     * @param bool=true $throwEx
     * @return string|false
     * @throws \Exception
     */
    public function getContent(string $path, bool $throwEx = true)
    {
        $file = $this->getUserDir() . "/$path";
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        if (true === $throwEx) {
            throw new LightUserDataException("File not found with path $path.");
        }
        return false;
    }

    /**
     * Returns whether the given file is private or not.
     *
     * The given file is an absolute path.
     *
     * @param string $file
     * @return bool
     */
    public function isPrivate(string $file): bool
    {
        return file_exists($file . ".private");
    }


    /**
     *
     * This method will do two things:
     *
     * - recreate the correlation between user identifier and directory names in the luda_directory_map table
     * - update the lud_user table (@page(Light_UserDatabase)) to add the extra.directory property
     *
     * You should call this method every time you change the obfuscating method.
     *
     *
     */
    public function refreshReferences()
    {

        /**
         * @var $db SimplePdoWrapperInterface
         */
        $db = $this->container->get("database");

        /**
         * @var $exception \Exception
         */
        $exception = null;
        $res = $db->transaction(function () {

            $api = $this->factory->getDirectoryMapApi();
            /**
             * @var $userDb LightWebsiteUserDatabaseInterface
             */
            $userDb = $this->container->get("user_database");
            $rows = $userDb->getAllUserInfo();
            foreach ($rows as $row) {
                $identifier = $row['identifier'];
                $string = $identifier . $this->obfuscationSecret;
                $algorithmOptions = [];
                $obfuscated = password_hash($string, HashTool::getPasswordHashAlgorithm($this->obfuscationAlgorithm), $algorithmOptions);

                $api->insertDirectoryMap([
                    "obfuscated_name" => $obfuscated,
                    "real_name" => $identifier,
                ], false);


                $extra = $row['extra'];
                $extra[$this->directoryKey] = $obfuscated;
                $row['extra'] = $extra;
                unset($row['password']);
                $userDb->updateUserById($row['id'], $row);
            }


        }, $exception);

        if (false === $res) {
            throw $exception;
        }
    }


    /**
     * Returns the real name of the user directory, which obfuscated name was given,
     * or returns false if no directory matches.
     *
     * @param string $obfuscatedName
     * @return string|false
     * @throws \Exception
     */
    public function getUserRealDirectoryName(string $obfuscatedName)
    {
        $row = $this->factory->getDirectoryMapApi()->getDirectoryMapByObfuscatedName($obfuscatedName);
        if (null !== $row) {
            return $row['real_name'];
        }
        return false;

    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns the directory path of the current user.
     * @return string
     * @throws \Exception
     */
    protected function getUserDir(): string
    {
        $user = $this->currentUser;
        if (null === $user) {
            $user = $this->container->get("user_manager")->getUser();
        }
        $identifier = $user->getIdentifier();
        return $this->rootDir . "/" . $identifier;
    }


}