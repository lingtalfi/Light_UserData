Ling/Light_UserData
================
2019-09-27 --> 2019-10-21




Table of contents
===========

- [CustomDirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/Custom/CustomDirectoryMapApi.md) &ndash; The CustomDirectoryMapApi class.
    - [CustomDirectoryMapApi::getDirectoryMapByRealName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/Custom/CustomDirectoryMapApi/getDirectoryMapByRealName.md) &ndash; Returns the directoryMap row identified by the given realName.
    - [DirectoryMapApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/__construct.md) &ndash; Builds the DirectoryMapApi instance.
    - [DirectoryMapApi::insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/insertDirectoryMap.md) &ndash; Inserts the given directoryMap in the database.
    - [DirectoryMapApi::getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/getDirectoryMapByObfuscatedName.md) &ndash; Returns the directoryMap row identified by the given obfuscated_name.
    - [DirectoryMapApi::updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/updateDirectoryMapByObfuscatedName.md) &ndash; Updates the directoryMap row identified by the given obfuscated_name.
    - [DirectoryMapApi::deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/deleteDirectoryMapByObfuscatedName.md) &ndash; Deletes the directoryMap identified by the given obfuscated_name.
    - [DirectoryMapApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.
- [DirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi.md) &ndash; The DirectoryMapApi class.
    - [DirectoryMapApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/__construct.md) &ndash; Builds the DirectoryMapApi instance.
    - [DirectoryMapApi::insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/insertDirectoryMap.md) &ndash; Inserts the given directoryMap in the database.
    - [DirectoryMapApi::getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/getDirectoryMapByObfuscatedName.md) &ndash; Returns the directoryMap row identified by the given obfuscated_name.
    - [DirectoryMapApi::updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/updateDirectoryMapByObfuscatedName.md) &ndash; Updates the directoryMap row identified by the given obfuscated_name.
    - [DirectoryMapApi::deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/deleteDirectoryMapByObfuscatedName.md) &ndash; Deletes the directoryMap identified by the given obfuscated_name.
    - [DirectoryMapApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.
- [DirectoryMapApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface.md) &ndash; The DirectoryMapApiInterface interface.
    - [DirectoryMapApiInterface::getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface/getDirectoryMapByObfuscatedName.md) &ndash; Returns the directoryMap row identified by the given obfuscated_name.
    - [DirectoryMapApiInterface::updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface/updateDirectoryMapByObfuscatedName.md) &ndash; Updates the directoryMap row identified by the given obfuscated_name.
    - [DirectoryMapApiInterface::insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface/insertDirectoryMap.md) &ndash; Inserts the given directoryMap in the database.
    - [DirectoryMapApiInterface::deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface/deleteDirectoryMapByObfuscatedName.md) &ndash; Deletes the directoryMap identified by the given obfuscated_name.
- [LightUserDataApiFactory](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory.md) &ndash; The LightUserDataApiFactory class.
    - [LightUserDataApiFactory::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory/__construct.md) &ndash; Builds the LightUserDataApiFactory instance.
    - [LightUserDataApiFactory::getDirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory/getDirectoryMapApi.md) &ndash; Returns a CustomDirectoryMapApi.
    - [LightUserDataApiFactory::getResourceApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory/getResourceApi.md) &ndash; Returns a ResourceApiInterface.
    - [LightUserDataApiFactory::getResourceHasTagApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory/getResourceHasTagApi.md) &ndash; Returns a ResourceHasTagApiInterface.
    - [LightUserDataApiFactory::getTagApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory/getTagApi.md) &ndash; Returns a TagApiInterface.
    - [LightUserDataApiFactory::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory/setPdoWrapper.md) &ndash; Sets the pdoWrapper.
- [ResourceApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi.md) &ndash; The ResourceApi class.
    - [ResourceApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi/__construct.md) &ndash; Builds the ResourceApi instance.
    - [ResourceApi::insertResource](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi/insertResource.md) &ndash; Inserts the given resource in the database.
    - [ResourceApi::getResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi/getResourceById.md) &ndash; Returns the resource row identified by the given id.
    - [ResourceApi::updateResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi/updateResourceById.md) &ndash; Updates the resource row identified by the given id.
    - [ResourceApi::deleteResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi/deleteResourceById.md) &ndash; Deletes the resource identified by the given id.
    - [ResourceApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.
- [ResourceApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface.md) &ndash; The ResourceApiInterface interface.
    - [ResourceApiInterface::getResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/getResourceById.md) &ndash; Returns the resource row identified by the given id.
    - [ResourceApiInterface::updateResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/updateResourceById.md) &ndash; Updates the resource row identified by the given id.
    - [ResourceApiInterface::insertResource](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/insertResource.md) &ndash; Inserts the given resource in the database.
    - [ResourceApiInterface::deleteResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/deleteResourceById.md) &ndash; Deletes the resource identified by the given id.
- [ResourceHasTagApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi.md) &ndash; The ResourceHasTagApi class.
    - [ResourceHasTagApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi/__construct.md) &ndash; Builds the ResourceHasTagApi instance.
    - [ResourceHasTagApi::insertResourceHasTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi/insertResourceHasTag.md) &ndash; Inserts the given resourceHasTag in the database.
    - [ResourceHasTagApi::getResourceHasTagByResourceIdAndTagId](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi/getResourceHasTagByResourceIdAndTagId.md) &ndash; Returns the resourceHasTag row identified by the given resource_id and tag_id.
    - [ResourceHasTagApi::updateResourceHasTagByResourceIdAndTagId](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi/updateResourceHasTagByResourceIdAndTagId.md) &ndash; Updates the resourceHasTag row identified by the given resource_id and tag_id.
    - [ResourceHasTagApi::deleteResourceHasTagByResourceIdAndTagId](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi/deleteResourceHasTagByResourceIdAndTagId.md) &ndash; Deletes the resourceHasTag identified by the given resource_id and tag_id.
    - [ResourceHasTagApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.
- [ResourceHasTagApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApiInterface.md) &ndash; The ResourceHasTagApiInterface interface.
    - [ResourceHasTagApiInterface::getResourceHasTagByResourceIdAndTagId](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApiInterface/getResourceHasTagByResourceIdAndTagId.md) &ndash; Returns the resourceHasTag row identified by the given resource_id and tag_id.
    - [ResourceHasTagApiInterface::updateResourceHasTagByResourceIdAndTagId](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApiInterface/updateResourceHasTagByResourceIdAndTagId.md) &ndash; Updates the resourceHasTag row identified by the given resource_id and tag_id.
    - [ResourceHasTagApiInterface::insertResourceHasTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApiInterface/insertResourceHasTag.md) &ndash; Inserts the given resourceHasTag in the database.
    - [ResourceHasTagApiInterface::deleteResourceHasTagByResourceIdAndTagId](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApiInterface/deleteResourceHasTagByResourceIdAndTagId.md) &ndash; Deletes the resourceHasTag identified by the given resource_id and tag_id.
- [TagApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi.md) &ndash; The TagApi class.
    - [TagApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/__construct.md) &ndash; Builds the TagApi instance.
    - [TagApi::insertTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/insertTag.md) &ndash; Inserts the given tag in the database.
    - [TagApi::getTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/getTagById.md) &ndash; Returns the tag row identified by the given id.
    - [TagApi::updateTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/updateTagById.md) &ndash; Updates the tag row identified by the given id.
    - [TagApi::deleteTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/deleteTagById.md) &ndash; Deletes the tag identified by the given id.
    - [TagApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.
- [TagApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface.md) &ndash; The TagApiInterface interface.
    - [TagApiInterface::getTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/getTagById.md) &ndash; Returns the tag row identified by the given id.
    - [TagApiInterface::updateTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/updateTagById.md) &ndash; Updates the tag row identified by the given id.
    - [TagApiInterface::insertTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/insertTag.md) &ndash; Inserts the given tag in the database.
    - [TagApiInterface::deleteTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/deleteTagById.md) &ndash; Deletes the tag identified by the given id.
- [LightUserDataController](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Controller/LightUserDataController.md) &ndash; The LightUserDataController class.
    - [LightUserDataController::render](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Controller/LightUserDataController/render.md) &ndash; or throws an exception.
    - LightController::__construct &ndash; Builds the LightController instance.
    - LightController::setLight &ndash; Sets the light instance.
- [LightUserDataException](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Exception/LightUserDataException.md) &ndash; The LightUserDataException class.
- [LightUserDataService](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService.md) &ndash; The LightUserDataService class.
    - [LightUserDataService::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/__construct.md) &ndash; Builds the LightUserDataService instance.
    - [LightUserDataService::initialize](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/initialize.md) &ndash; Initializes a service with the given Light instance and HttpRequestInterface instance.
    - [LightUserDataService::installDatabase](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/installDatabase.md) &ndash; Installs the database part of this planet.
    - [LightUserDataService::uninstallDatabase](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/uninstallDatabase.md) &ndash; Uninstalls the database part of this planet.
    - [LightUserDataService::setContainer](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setContainer.md) &ndash; Sets the container.
    - [LightUserDataService::setObfuscationParams](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setObfuscationParams.md) &ndash; Sets the obfuscation parameters to use.
    - [LightUserDataService::setRootDir](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setRootDir.md) &ndash; Sets the rootDir.
    - [LightUserDataService::getRootDir](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getRootDir.md) &ndash; Returns the rootDir of this instance.
    - [LightUserDataService::setTemporaryUser](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setTemporaryUser.md) &ndash; Sets a temporary user.
    - [LightUserDataService::unsetTemporaryUser](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/unsetTemporaryUser.md) &ndash; Unsets the temporary user if any.
    - [LightUserDataService::list](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/list.md) &ndash; Returns the array of the files owned by the current user.
    - [LightUserDataService::save](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/save.md) &ndash; and returns the url of the saved resource.
    - [LightUserDataService::getResourceUrl](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getResourceUrl.md) &ndash; Returns the url to access the resource identified by the given userIdentifier and relativePath.
    - [LightUserDataService::getContent](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getContent.md) &ndash; Returns the content of the file of the current user which relative path is given.
    - [LightUserDataService::isPrivate](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/isPrivate.md) &ndash; Returns whether the given file is private or not.
    - [LightUserDataService::refreshReferences](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/refreshReferences.md) &ndash; You should call this method every time you change the obfuscating method.
    - [LightUserDataService::getUserRealDirectoryName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getUserRealDirectoryName.md) &ndash; or returns false if no directory matches.


Dependencies
============
- [SimplePdoWrapper](https://github.com/lingtalfi/SimplePdoWrapper)
- [Bat](https://github.com/lingtalfi/Bat)
- [Light](https://github.com/lingtalfi/Light)
- [Light_User](https://github.com/lingtalfi/Light_User)
- [DirScanner](https://github.com/lingtalfi/DirScanner)
- [Light_Initializer](https://github.com/lingtalfi/Light_Initializer)
- [Light_PluginDatabaseInstaller](https://github.com/lingtalfi/Light_PluginDatabaseInstaller)
- [Light_UserDatabase](https://github.com/lingtalfi/Light_UserDatabase)


