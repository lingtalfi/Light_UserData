[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)



The LightUserDataService class
================
2019-09-27 --> 2019-10-21






Introduction
============

The LightUserDataService class.

For more details, refer to the [conception notes](https://github.com/lingtalfi/Light_UserData/blob/master/doc/pages/conception-notes.md).



Class synopsis
==============


class <span class="pl-k">LightUserDataService</span> implements [LightInitializerInterface](https://github.com/lingtalfi/Light_Initializer/blob/master/doc/api/Ling/Light_Initializer/Initializer/LightInitializerInterface.md) {

- Properties
    - protected [Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) [$container](#property-container) ;
    - protected string [$rootDir](#property-rootDir) ;
    - protected [Ling\Light_User\LightUserInterface](https://github.com/lingtalfi/Light_User/blob/master/doc/api/Ling/Light_User/LightUserInterface.md)|null [$currentUser](#property-currentUser) ;
    - protected string [$obfuscationAlgorithm](#property-obfuscationAlgorithm) ;
    - protected string [$obfuscationSecret](#property-obfuscationSecret) ;
    - protected [Ling\Light_UserData\Api\LightUserDataApiFactory](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/LightUserDataApiFactory.md) [$factory](#property-factory) ;
    - private string [$directoryKey](#property-directoryKey) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/__construct.md)() : void
    - public [initialize](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/initialize.md)([Ling\Light\Core\Light](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/Core/Light.md) $light, Ling\Light\Http\HttpRequestInterface $httpRequest) : mixed
    - public [installDatabase](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/installDatabase.md)() : void
    - public [uninstallDatabase](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/uninstallDatabase.md)() : void
    - public [setContainer](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setContainer.md)([Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) $container) : void
    - public [setObfuscationParams](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setObfuscationParams.md)(string $algoName, string $secret) : void
    - public [setRootDir](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setRootDir.md)(string $rootDir) : void
    - public [getRootDir](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getRootDir.md)() : string
    - public [setTemporaryUser](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/setTemporaryUser.md)([Ling\Light_User\LightUserInterface](https://github.com/lingtalfi/Light_User/blob/master/doc/api/Ling/Light_User/LightUserInterface.md) $user) : void
    - public [unsetTemporaryUser](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/unsetTemporaryUser.md)() : void
    - public [list](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/list.md)(?string $directory = null) : array
    - public [save](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/save.md)(string $path, string $data, ?array $options = []) : string
    - public [getResourceUrl](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getResourceUrl.md)(string $userIdentifier, string $relativePath) : string
    - public [getContent](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getContent.md)(string $path, ?bool $throwEx = true) : string | false
    - public [isPrivate](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/isPrivate.md)(string $file) : bool
    - public [refreshReferences](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/refreshReferences.md)() : void
    - public [getUserRealDirectoryName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getUserRealDirectoryName.md)(string $obfuscatedName) : string | false
    - public [getUserObfuscatedDirectoryName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getUserObfuscatedDirectoryName.md)(string $userId) : string | false
    - protected [getUserDir](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getUserDir.md)() : string

}




Properties
=============

- <span id="property-container"><b>container</b></span>

    This property holds the container for this instance.
    
    

- <span id="property-rootDir"><b>rootDir</b></span>

    This property holds the rootDir for this instance.
    
    

- <span id="property-currentUser"><b>currentUser</b></span>

    This property holds the currentUser for this instance.
    
    

- <span id="property-obfuscationAlgorithm"><b>obfuscationAlgorithm</b></span>

    This property holds the obfuscationAlgorithm for this instance.
    
    

- <span id="property-obfuscationSecret"><b>obfuscationSecret</b></span>

    This property holds the obfuscationSecret for this instance.
    
    

- <span id="property-factory"><b>factory</b></span>

    This property holds the factory for this instance.
    
    

- <span id="property-directoryKey"><b>directoryKey</b></span>

    This property holds the directoryKey for this instance.
    
    



Methods
==============

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
- [LightUserDataService::getUserObfuscatedDirectoryName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getUserObfuscatedDirectoryName.md) &ndash; or returns false in case of no match.
- [LightUserDataService::getUserDir](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getUserDir.md) &ndash; Returns the directory path of the current user.





Location
=============
Ling\Light_UserData\Service\LightUserDataService<br>
See the source code of [Ling\Light_UserData\Service\LightUserDataService](https://github.com/lingtalfi/Light_UserData/blob/master/Service/LightUserDataService.php)



SeeAlso
==============
Previous class: [LightUserDataException](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Exception/LightUserDataException.md)<br>
