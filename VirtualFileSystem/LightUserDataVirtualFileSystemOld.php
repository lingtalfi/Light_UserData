<?php


namespace Ling\Light_UserData\VirtualFileSystem;


use Ling\BabyYaml\BabyYamlUtil;
use Ling\Bat\FileSystemTool;
use Ling\Bat\FileTool;
use Ling\Bat\TagTool;
use Ling\CheapLogger\CheapLogger;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_UploadGems\GemHelper\GemHelperTool;
use Ling\Light_UserData\Exception\LightUserDataException;
use Ling\Light_UserData\Service\LightUserDataService;
use Ling\Light_UserManager\Service\LightUserManagerService;

/**
 * The LightUserDataVirtualFileSystem class.
 *
 *
 * Our filesystem structure looks like this:
 *
 * - $baseDir:
 * ----- $contextId
 * --------- commit_list.byml
 * --------- files/
 * ------------- $relPath
 *
 *
 *
 */
class LightUserDataVirtualFileSystemOld
{
    /**
     * This property holds the baseDir for this instance.
     * @var string
     */
    protected $baseDir;

    /**
     * This property holds the contextId for this instance.
     * @var string
     */
    protected $contextId;

    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;


    /**
     * Builds the LightUserDataVirtualFileSystem instance.
     */
    public function __construct()
    {
        $this->baseDir = "/tmp";
        $this->contextId = "not_set";
        $this->container = null;
    }

    /**
     * Sets the baseDir.
     *
     * @param string $baseDir
     */
    public function setBaseDir(string $baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * Sets the contextId.
     *
     * @param string $contextId
     */
    public function setContextId(string $contextId)
    {
        /**
         * Note: I replace colon with dots, because on mac apparently the colon is replaced with slash, which
         * ends up creating directories which name contain slashes, which confuses me.
         *
         * The potential problem with this replacement is legit name conflicts, so I will watch this thread,
         * but in the meantime, this replacement works for me...
         */
        $this->contextId = str_replace(':', '.', $contextId);
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



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns whether this contains the resource identified by the given id.
     *
     * Available options are:
     *
     * - useAdd: bool=true, whether to look in the to_add section
     * - useUpdate: bool=true, whether to look in the to_update section
     *
     * See more details in the @page(user data file manager document, commit list section).
     *
     * @param string $resourceId
     * @param array $options
     * @return bool
     */
    public function hasResource(string $resourceId, array $options = []): bool
    {
        $useAdd = $options['useAdd'] ?? true;
        $useUpdate = $options['useUpdate'] ?? true;

        $conf = $this->getCommitListContent();
        if (true === $useAdd) {
            if (true === array_key_exists($resourceId, $conf['to_add'])) {
                return true;
            }
        }
        if (true === $useUpdate) {
            if (true === array_key_exists($resourceId, $conf['to_update'])) {
                return true;
            }
        }
        return false;
    }


    /**
     * Removes the file identified by the given resource id.
     * If the file doesn't exist, the method does nothing and doesn't complain.
     *
     * Technical details: we try to play nice and we remove the resource from both
     * the commit.byml file and the virtual file system, to avoid any potential sync problems.
     *
     * @param string $resourceId
     */
    public function removeResourceById(string $resourceId)
    {
        $changeDetected = false;
        $conf = $this->getCommitListContent();


        $sections = [
            'to_add',
            'to_update',
        ];
        foreach ($sections as $section) {
            $resources = $conf[$section];
            if (array_key_exists($resourceId, $resources)) {
                $changeDetected = true;
                $resource = $resources[$resourceId];
                $this->removeFileItemsFiles($resource['files']);

                /**
                 * Remove from commit.byml
                 */
                unset($conf[$section][$resourceId]);
                break;
            }
        }

        if (true === $changeDetected) {
            $this->updateCommitListContent($conf);
        }
    }


    /**
     * Adds the given resource id in the **to_remove** section of the commit file.
     * The intent is that the real server deletes this file later when we commit.
     * See the @page(Light_UserData conception notes) for more details.
     *
     * @param string $resourceId
     */
    public function addRealServerResourceIdToRemoveList(string $resourceId)
    {
        $f = $this->getCommitListPath();
        $conf = $this->getCommitListContent();
        $toRemove = $conf['to_remove'] ?? [];
        if (false === in_array($resourceId, $toRemove, true)) {
            $toRemove[] = $resourceId;
            $conf['to_remove'] = $toRemove;
        }
        BabyYamlUtil::writeFile($conf, $f);
    }


    /**
     * Resets the virtual file server for the configured context id.
     */
    public function reset()
    {
        $contextDir = $this->baseDir . "/" . $this->contextId;
        FileSystemTool::remove($contextDir);
    }


    /**
     * Returns the current weight of all files uploaded by the user so far.
     *
     * @return int
     */
    public function getCurrentCapacity(): int
    {
        $filesDir = $this->getFilesDirectory();
        return FileSystemTool::getDirectorySize($filesDir);
    }


    /**
     * Adds a file to the virtual server, updates the commit file accordingly, and returns the resourceId.
     *
     * Params are:
     * - src_path: the absolute path of the source file to add.
     * - user_rel_path: the base relative path, relative to the user dir, as provided by the user.
     *      This is used as a suggestion while processing the "files" property.
     * - tags: array of tag names to attach to the source file
     * - is_private: bool, whether the source file is considered private
     * - files: array, where to really put the file and related. It can use the filename as a reference/helper.
     *      See the ["Upload file configuration" section of the user-data-file-manager.md document](https://github.com/lingtalfi/Light_UserData/blob/master/doc/pages/user-data-file-manager.md) for more details.
     * - keep_original: bool=false. Whether to keep the original. This will work only with images. The source file will be used
     *      as the source of the copy.
     *
     *
     *
     *
     * See the [source file section of our conception notes](https://github.com/lingtalfi/Light_UserData/blob/master/doc/pages/conception-notes.md#the-source-file) for more details
     * about the source file.
     *
     *
     *
     *
     * @param array $params
     * @return string
     */
    public function add(array $params): string
    {
        return $this->doAdd($params);
    }


    /**
     * Like the add method, but with extra options.
     *
     * Available options are:
     * - resourceId: the resourceId to use. If not specified, one will be generated automatically.
     * - section: string=to_add, the name of the section to update.
     * - dry: bool=false. If true, the file variations will not be created, but the paths in the commit file will be updated (and point to non existing files).
     *
     *
     * @param array $params
     * @param array $options
     * @return string
     * @throws \Exception
     */
    private function doAdd(array $params, array $options = []): string
    {


        $content = $this->getCommitListContent();
        $section = $options['section'] ?? "to_add";
        $dry = $options['dry'] ?? false;
        $filesDirectory = $this->getFilesDirectory();

        /**
         * @var $ud LightUserDataService
         */
        $ud = $this->container->get("user_data");

        $sourceWasFound = false;
        $srcPath = $params['src_path'];
        $userRelPath = $params['user_rel_path'];
        $tags = $params['tags'];
        $isPrivate = $params['is_private'];
        $keepOriginal = $params['keep_original'] ?? false;
        $files = $params['files'];
        if (empty($files)) {
            $this->error("There is no concrete variation attached to this resource ($userRelPath). Aborting the add operation...");
        }


        //--------------------------------------------
        // CREATE THE FILE VARIATIONS
        //--------------------------------------------
        $variations = [];
        $nbFiles = count($files);
        foreach ($files as $fInfo) {
            $nickname = $this->getFileItemProperty($fInfo, "nickname");
            $path = $this->getFileItemProperty($fInfo, "path");
            $imageTransformer = $fInfo['imageTransformer'] ?? null;
            $isSource = (1 === $nbFiles) ? true : $fInfo['is_source'] ?? false;
            $path = $this->createCopy($path, $userRelPath, $srcPath, [
                'imageTransformer' => $imageTransformer,
                'dry' => $dry,
            ]);
            $variations[] = [
                "path" => $path,
                "nickname" => $nickname,
                "is_source" => (int)$isSource,
            ];


            if (false === $dry && true === $isSource) {
                $sourceWasFound = true;

                //--------------------------------------------
                // ORIGINAL IMAGE COPY
                //--------------------------------------------
                if (true === $keepOriginal) {
                    $srcFilePath = $filesDirectory . "/" . $path;
                    if (false === file_exists($srcFilePath)) {
                        $this->error("Oops, for some reason this file wasn't found: \"$srcFilePath\".");
                    }

                    if (false === FileTool::isImage($srcPath)) {
                        /**
                         * Should we really complain if it's not an image?
                         */
                        $this->error("Will not save the file as an original, since it's not an image: \"$srcPath\".");
                    }
                    $oriPath = $this->getOriginalPath($srcFilePath);
                    FileSystemTool::copyFile($srcPath, $oriPath);
                }
            }
        }


        if (false === $dry && false === $sourceWasFound) {
            $this->error("No source file was defined in the given file configuration.");
        }


        //--------------------------------------------
        // UPDATE THE COMMIT FILE
        //--------------------------------------------
        $resourceId = $options['resourceId'] ?? $ud->getNewResourceIdentifier();
        $content[$section][$resourceId] = [
            "tags" => $tags,
            "is_private" => $isPrivate,
            "files" => $variations,
        ];

        $this->updateCommitListContent($content);
        return $resourceId;
    }

    /**
     *
     * Updates the information of the virtual file identified by the given resourceIdentifier in the commit file.
     * If the file is also modified, it will update the file and all its variations in the virtual file system.
     *
     *
     * Params are:
     * - src_path: string|null. The absolute path of the source file to add.
     *      This is null when the user/client doesn't provide a file.
     *
     * - user_rel_path: the base relative path, relative to the user dir, as provided by the user.
     *      This is used as a suggestion while processing the "files" property.
     * - tags: array of tag names to attach to the source file
     * - is_private: bool, whether the source file is considered private
     * - files: array, where to really put the file and related. It can use the filename as a reference/helper.
     *      See the ["Upload file configuration" section of the user-data-file-manager.md document](https://github.com/lingtalfi/Light_UserData/blob/master/doc/pages/user-data-file-manager.md) for more details.
     * - keep_original: bool=false. Whether to keep the given file as the (new) original. This will work only with images. The source file will be used
     *      as the source of the copy.
     *
     *
     *
     * @param string $resourceIdentifier
     * @param array $params
     */
    public function update(string $resourceIdentifier, array $params)
    {
        $userRelPath = $params['user_rel_path'];
        $tags = $params['tags'];
        $isPrivate = $params['is_private'];
        $files = $params['files'];
        $srcPath = $params['src_path'];

        /**
         * @var $ud LightUserDataService
         */
        $ud = $this->container->get("user_data");


        $content = $this->getCommitListContent();
        $resources = $content['to_update'] ?? [];


        if (true === array_key_exists($resourceIdentifier, $resources)) {


            $resource = $resources[$resourceIdentifier];

            //--------------------------------------------
            // UPDATING FILE FROM THE VIRTUAL SERVER
            //--------------------------------------------
            if (empty($files)) {
                $this->error("There is no concrete variation attached to this resource ($userRelPath). Aborting the update operation...");
            }


            //--------------------------------------------
            // THE USER PROVIDED A NEW FILE
            //--------------------------------------------
            if (null !== $srcPath) {
                /**
                 * In this case, our approach is to remove all the old files, and add the new ones
                 */
                $this->removeFilesByResource($resource);
                $this->doAdd($params, [
                    "resourceId" => $resourceIdentifier,
                    "section" => "to_update",
                ]);
            } else {
                //--------------------------------------------
                // NO FILE PROVIDED
                //--------------------------------------------
                /**
                 * Note that if the filenames are changed, we need to rename the stored files as well.
                 */
                $resource['is_private'] = $isPrivate;
                $resource['tags'] = $tags;


                $this->updateResourceFilePaths($resource, $files, $userRelPath);
                $content['to_update'][$resourceIdentifier] = $resource;
                $this->updateCommitListContent($content);

            }

        } else {
            //--------------------------------------------
            // UPDATING FILE FROM THE REAL SERVER
            //--------------------------------------------
            /**
             * The resource doesn't exist in our virtual server.
             * It's probably because it's an update from a file form the real server.
             * In this case, as far as we are concerned, we're just storing it on the virtual server, treating the entry as an add operation.
             * This will be resolved later when committing to the real server.
             */
            $ud->checkUserHasResource($resourceIdentifier);


            $fileProvided = (null !== $srcPath);
            $this->doAdd($params, [
                "resourceId" => $resourceIdentifier,
                "dry" => !$fileProvided,
                "section" => 'to_update',
            ]);
        }


    }


    /**
     * Returns an array of information about the source file identified by the given resource id.
     * The array contains the following information:
     *
     * - directory: string, relative directory path (relative to the user directory) of the source file.
     * - name: string, @page(filename) of the source file.
     * - url: string, the url of the source file.
     * - is_private: bool, whether the source file is private.
     * - tags: array of tags used by the resource containing the source file.
     * - original_url: string|null, the url pointing to the original image if any, or null if non applicable.
     * - abs_path: string, absolute path to the source file.
     *
     *
     * @param string $resourceId
     * @return array
     */
    public function getSourceFileInfoByResourceId(string $resourceId): array
    {
        $ret = [];
        $content = $this->getCommitListContent();

        if (array_key_exists($resourceId, $content['to_add'])) {
            $ret = $this->compileInfoByResourceItem($resourceId, $content['to_add'][$resourceId]);
        } elseif (array_key_exists($resourceId, $content['to_update'])) {
            //--------------------------------------------
            // THE FILE EXISTS ONLY ON THE REAL SERVER
            //--------------------------------------------

            $resource = $content['to_update'][$resourceId];
            if (array_key_exists("user_path", $resource)) {
                //--------------------------------------------
                // THE USER DID NOT PROVIDE A FILE
                //--------------------------------------------
                $ret = [
                    "directory" => 0,
                    "name" => 0,
                    "url" => 0,
                    "is_private" => 0,
                    "tags" => 0,
                    "original_url" => 0,
                    "abs_path" => 0,
                ];

            } else {
                //--------------------------------------------
                // THE USER PROVIDED A FILE
                //--------------------------------------------
                $ret = $this->compileInfoByResourceItem($resourceId, $content['to_update'][$resourceId]);
            }

        }


        return $ret;
    }


    /**
     * Returns information about the to_update resource identified by the given resource id.
     * The returned array contains the following:
     *
     * - directory: string, relative directory path (relative to the user directory) of the source file.
     * - name: string, @page(filename) of the source file.
     * - url: string, the url of the source file.
     * - is_private: bool, whether the source file is private.
     * - tags: array of tags used by the resource containing the source file.
     * - original_url: string|null, the url pointing to the original image if any, or null if non applicable.
     * - abs_path: string, absolute path to the source file.
     *
     *
     * @param string $resourceId
     * @return array
     */
    public function getUpdateInfoByResourceId(string $resourceId): array
    {
        return [];
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Creates a copy of the file which source and dest are given, on the virtual server, and returns the resolved relative path (i.e. after the tags have been injected into it).
     *
     *
     *
     * The userRelPath variable is the relative path suggested by the user.
     * We will extract tags from it, and replace those tags in the given relativePath.
     * The extracted tags are defined in [the "upload file configuration" section of the user data file manager document](https://github.com/lingtalfi/Light_UserData/blob/master/doc/pages/user-data-file-manager.md#upload-file-configuration).
     *
     *
     * Available options are:
     * - imageTransformer: string=null, defines how to transform the image.
     *      See the [Light_UploadGems planet documentation](https://github.com/lingtalfi/Light_UploadGems/blob/master/doc/pages/conception-notes.md) for more info.
     * - dry: bool=false, if true, the concrete file will not be created/copied.
     *
     * @param string $relativePath
     * @param string $userRelPath
     * @param string|null $fileSrc
     * @param array $options
     */
    private function createCopy(string $relativePath, string $userRelPath, string $fileSrc = null, array $options = []): string
    {
        $imageTransformer = $options['imageTransformer'] ?? null;
        $dry = $options['dry'] ?? false;
        $dir = $this->getFilesDirectory();
        $relativePath = $this->resolveFilePath($userRelPath, $relativePath);
        $file = $dir . "/" . $relativePath;


        if (false === $dry) {
            if (null !== $imageTransformer) {
                GemHelperTool::transformImage($fileSrc, $file, $imageTransformer);
            } else {
                FileSystemTool::copyFile($fileSrc, $file);
            }
        }
        return $relativePath;
    }


    /**
     * Extracts the tags out of the given userRelPath, then injects them in the given relativePath and returns the corresponding resolved relative path.
     *
     * @param string $userRelPath
     * @param string $relativePath
     * @return string
     */
    private function resolveFilePath(string $userRelPath, string $relativePath): string
    {
        $userRelPath = FileSystemTool::removeTraversalDots($userRelPath);
        $tags = [
            'directory' => dirname($userRelPath),
            'filename' => basename($userRelPath),
            'basename' => FileSystemTool::getBasename($userRelPath),
            'extension' => FileSystemTool::getFileExtension($userRelPath),
        ];

        return TagTool::injectTags($relativePath, $tags);
    }


    /**
     * Returns the configuration contained in the commit list file for the configured contextId.
     *
     * If the commit file doesn't exist yet, it will be created.
     *
     * @return array
     */
    private function getCommitListContent()
    {
        /**
         * Note: we might add light execute notation processing later, so be sure to use only this method
         * to get the content of the commit file.
         */
        $f = $this->getCommitListPath();
        if (false === file_exists($f)) {
            BabyYamlUtil::writeFile([
                "to_remove" => [],
                "to_add" => [],
                "to_update" => [],
            ], $f);
        }
        return BabyYamlUtil::readFile($f);
    }

    /**
     * Replaces the commit_list.byml content with the given array.
     *
     * @param array $conf
     */
    private function updateCommitListContent(array $conf)
    {
        $f = $this->getCommitListPath();
        BabyYamlUtil::writeFile($conf, $f);

    }

    /**
     * Returns the absolute path to the commit list file.
     *
     * @return string
     */
    private function getCommitListPath(): string
    {
        return $this->baseDir . "/" . $this->contextId . "/commit_list.byml";
    }

    /**
     * Returns the absolute path of the file which relative path was given.
     * Note: we remove traversal dots (if any) from the given relative path.
     *
     *
     * @param string $relPath
     * @return string
     */
    private function getFileAbsolutePathByRelativePath(string $relPath): string
    {
        return $this->getFilesDirectory() . "/" . FileSystemTool::removeTraversalDots($relPath);
    }

    /**
     * Returns the given property defined in the given file item, or throws an exception otherwise.
     *
     * @param array $fileItem
     * @param string $property
     * @return string
     * @throws \Exception
     */
    private function getFileItemProperty(array $fileItem, string $property): string
    {
        if (array_key_exists($property, $fileItem)) {
            return $fileItem[$property];
        }
        $this->error("The \"$property\" property wasn't found for the given fileItem. Please review your configuration (contextId=$this->contextId).");
    }


    /**
     * Returns the path to the original (image) of the given path.
     * See more about the @page(original image concept in our conception notes).
     *
     * The given path must be absolute.
     *
     *
     * @param string $path
     * @return string
     */
    private function getOriginalPath(string $path): string
    {
        $oriDir = dirname($path);
        $oriBasename = FileSystemTool::getBasename($path);
        $oriExt = FileSystemTool::getFileExtension($path);
        if (false === empty($oriExt)) {
            $oriExt = "." . $oriExt;
        }
        return $oriDir . "/" . $oriBasename . "--ORIGINAL" . $oriExt;
    }


    /**
     * Removes the files on the virtual server, which are bound to the given resource array.
     *
     * @param array $resource
     */
    private function removeFilesByResource(array $resource)
    {
        $oldFiles = $resource['files'] ?? [];
        $dir = $this->getFilesDirectory();
        foreach ($oldFiles as $fileItem) {
            $path = $dir . "/" . $fileItem['path'];
            if (true === (bool)$fileItem['is_source']) {
                $oriPath = $this->getOriginalPath($path);
                unlink($oriPath);
            }
            unlink($path);
        }
    }

    /**
     * Renames the files defined in the given oldResource, moves them to where they are defined in the given fileItems array, and updates the oldResource.
     *
     * Hints:
     * - oldResource comes from the commit file
     * - fileItems comes from the uploadGems config (it can use tags, they will be resolved)
     *
     *
     * @param array $oldResource
     * @param array $fileItems
     * @param string $userRelPath
     */
    private function updateResourceFilePaths(array &$oldResource, array $fileItems, string $userRelPath)
    {
        $oldFiles = $oldResource['files'];
        $nbOldFiles = count($oldFiles);
        $nbFiles = count($fileItems);

        if ($nbOldFiles !== $nbFiles) {
            $this->error("The number of files to update must be the same as the number of file items in the config.");
        }


        //--------------------------------------------
        // UPDATING THE PATHS, AND RENAMING THE FILES
        //--------------------------------------------
        foreach ($fileItems as $index => $fileItem) {


            $path = $this->getFileItemProperty($fileItem, "path");
            $isSource = $fileItem['is_source'] ?? false;

            $newPath = $this->resolveFilePath($userRelPath, $path);
            $oldPath = $oldFiles[$index]["path"];


            // rename the file
            $oldPathAbs = $this->getFileAbsolutePathByRelativePath($oldPath);
            $newPathAbs = $this->getFileAbsolutePathByRelativePath($newPath);
            if (false !== file_exists($oldPathAbs)) {
                // we don't complain if the file doesn't exist, because this could be an update of meta only on a file that was already updated
                FileSystemTool::move($oldPathAbs, $newPathAbs);
            }

            // update the config array
            $oldResource['files'][$index]['path'] = $newPath;


            if (true === $isSource) {
                /**
                 * Copying the original image, if it exists.
                 * Assuming the old source file has the same index as the new source file.
                 *
                 */
                $oriOldPath = $this->getOriginalPath($oldPathAbs);
                if (file_exists($oriOldPath)) {
                    $oriNewPath = $this->getOriginalPath($newPathAbs);
                    FileSystemTool::move($oriOldPath, $oriNewPath);
                }


            }
        }
    }

    /**
     * Removes the files defined in the given file items.
     *
     * @param array $fileItems
     */
    private function removeFileItemsFiles(array $fileItems)
    {

        foreach ($fileItems as $fileItem) {
            // relPath can be non existing in some cases of update (if the user doesn't provide a file...)
            $relPath = $fileItem['path'] ?? null;
            if (null !== $relPath) {
                $path = $this->getFileAbsolutePathByRelativePath($relPath);
                /**
                 * Remove from filesystem
                 */
                if (file_exists($path)) {
                    unlink($path);
                }

                /**
                 * Remove the original image if it exists
                 */
                if (true === (bool)$fileItem['is_source']) {
                    $oriPath = $this->getOriginalPath($path);
                    if (file_exists($oriPath)) {
                        unlink($oriPath);
                    }
                }
            }
        }
    }


    /**
     * Returns an array of information from the given resource item.
     * The information is described in the getSourceFileInfoByResourceId method's comment,
     * but all properties are optional and are returned only if found.
     *
     *
     *
     * @param string $resourceId
     * @param array $resourceItem
     * @return array
     */
    private function compileInfoByResourceItem(string $resourceId, array $resourceItem): array
    {
        $files = $resourceItem['files'];
        $ret = [
            "is_private" => $resourceItem['is_private'],
            "tags" => $resourceItem['tags'],
        ];
        if ($files) {
            $found = false;
            foreach ($files as $item) {
                if (true === (bool)$item['is_source']) {
                    $found = true;


                    /**
                     * @var $ud LightUserDataService
                     */
                    $ud = $this->container->get("user_data");

                    $path = $item['path'];


                    $ret = array_merge($ret, [
                        "abs_path" => $this->getFileAbsolutePathByRelativePath($path),
                        "directory" => dirname($path),
                        "name" => basename($path),
                        "url" => $ud->getUrlByResourceIdentifier($resourceId),
                        "original_url" => $ud->getUrlByResourceIdentifier($resourceId, ['nickname' => "original"]),
                    ]);
                    break;
                }
            }
            if (false === $found) {
                $this->error("Configuration error: no source file defined, but files array is not empty (resourceId=$resourceId).");
            }
        }

        return $ret;
    }


    /**
     * Returns the absolute path to the "files" directory for the configured context.
     * @return string
     */
    private function getFilesDirectory(): string
    {
        return $this->baseDir . "/" . $this->contextId . "/files";
    }

    /**
     * Throws an exception.
     * @param string $msg
     * @throws \Exception
     */
    private function error(string $msg)
    {
        throw new LightUserDataException($msg);
    }
}