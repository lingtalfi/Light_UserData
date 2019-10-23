[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)



The DirectoryMapApi class
================
2019-09-27 --> 2019-10-23






Introduction
============

The DirectoryMapApi class.



Class synopsis
==============


class <span class="pl-k">DirectoryMapApi</span> implements [DirectoryMapApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface.md) {

- Properties
    - protected [Ling\SimplePdoWrapper\SimplePdoWrapperInterface](https://github.com/lingtalfi/SimplePdoWrapper/blob/master/doc/api/Ling/SimplePdoWrapper/SimplePdoWrapperInterface.md) [$pdoWrapper](#property-pdoWrapper) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/__construct.md)() : void
    - public [insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/insertDirectoryMap.md)(array $directoryMap, ?bool $ignoreDuplicate = true, ?bool $returnRic = false) : mixed
    - public [getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/getDirectoryMapByObfuscatedName.md)(string $obfuscated_name, ?$default = null, ?bool $throwNotFoundEx = false) : mixed
    - public [updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/updateDirectoryMapByObfuscatedName.md)(string $obfuscated_name, array $directoryMap) : void
    - public [deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/deleteDirectoryMapByObfuscatedName.md)(string $obfuscated_name) : void
    - public [setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/setPdoWrapper.md)([Ling\SimplePdoWrapper\SimplePdoWrapperInterface](https://github.com/lingtalfi/SimplePdoWrapper/blob/master/doc/api/Ling/SimplePdoWrapper/SimplePdoWrapperInterface.md) $pdoWrapper) : void

}




Properties
=============

- <span id="property-pdoWrapper"><b>pdoWrapper</b></span>

    This property holds the pdoWrapper for this instance.
    
    



Methods
==============

- [DirectoryMapApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/__construct.md) &ndash; Builds the DirectoryMapApi instance.
- [DirectoryMapApi::insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/insertDirectoryMap.md) &ndash; Inserts the given directoryMap in the database.
- [DirectoryMapApi::getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/getDirectoryMapByObfuscatedName.md) &ndash; Returns the directoryMap row identified by the given obfuscated_name.
- [DirectoryMapApi::updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/updateDirectoryMapByObfuscatedName.md) &ndash; Updates the directoryMap row identified by the given obfuscated_name.
- [DirectoryMapApi::deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/deleteDirectoryMapByObfuscatedName.md) &ndash; Deletes the directoryMap identified by the given obfuscated_name.
- [DirectoryMapApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.





Location
=============
Ling\Light_UserData\Api\DirectoryMapApi<br>
See the source code of [Ling\Light_UserData\Api\DirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/Api/DirectoryMapApi.php)



SeeAlso
==============
Previous class: [CustomDirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/Custom/CustomDirectoryMapApi.md)<br>Next class: [DirectoryMapApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface.md)<br>
