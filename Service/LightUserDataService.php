<?php


namespace Ling\Light_UserData\Service;


use Ling\Bat\FileSystemTool;
use Ling\DirScanner\YorgDirScannerTool;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_User\LightUserInterface;

/**
 * The LightUserDataService class.
 */
class LightUserDataService
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
     * Builds the LightUserDataService instance.
     */
    public function __construct()
    {
        $this->container = null;
        $this->rootDir = null;
        $this->currentUser = null;
    }

    /**
     * Sets the container.
     *
     * @param LightServiceContainerInterface $container
     */
    public function setContainer(LightServiceContainerInterface $container)
    {
        $this->container = $container;
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
     * Returns the array of all files owned by the current user.
     */
    public function list(): array
    {
        $dir = $this->getUserDir();
        return YorgDirScannerTool::getFiles($dir, true);
    }


    /**
     * Saves the data for the current user to the given relative path.
     *
     * @param string $path
     * @param string $data
     * @throws \Exception
     */
    public function save(string $path, string $data)
    {
        $file = $this->getUserDir() . "/$path";
        FileSystemTool::mkfile($file, $data);
    }

    /**
     * Returns the content of the file of the current user which relative path is given,
     * or false if there is no file at the expected location.
     *
     * @param string $path
     * @return string|false
     * @throws \Exception
     */
    public function getContent(string $path)
    {
        $file = $this->getUserDir() . "/$path";
        if (file_exists($file)) {
            return file_get_contents($file);
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

        // obfuscate
        $directoryName = $this->getDirectoryNameByUserIdentifier($identifier);

        return $this->rootDir . "/" . $directoryName;
    }


    /**
     * Returns the directory name from the given user identifier.
     *
     * @param string $identifier
     * @return string
     * @overrideMe
     */
    protected function getDirectoryNameByUserIdentifier(string $identifier): string
    {
        return $identifier;
    }
}