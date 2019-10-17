[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)



The CustomDirectoryMapApi class
================
2019-09-27 --> 2019-10-17






Introduction
============

The CustomDirectoryMapApi class.



Class synopsis
==============


class <span class="pl-k">CustomDirectoryMapApi</span> extends [DirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi.md) implements [DirectoryMapApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApiInterface.md) {

- Inherited properties
    - protected Ling\SimplePdoWrapper\SimplePdoWrapperInterface [DirectoryMapApi::$pdoWrapper](#property-pdoWrapper) ;

- Methods
    - public [getDirectoryMapByRealName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/Custom/CustomDirectoryMapApi/getDirectoryMapByRealName.md)(string $realName, ?$default = null, ?bool $throwNotFoundEx = false) : mixed

- Inherited methods
    - public [DirectoryMapApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/__construct.md)() : void
    - public [DirectoryMapApi::insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/insertDirectoryMap.md)(array $directoryMap, ?bool $ignoreDuplicate = true, ?bool $returnRic = false) : mixed
    - public [DirectoryMapApi::getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/getDirectoryMapByObfuscatedName.md)(string $obfuscated_name, ?$default = null, ?bool $throwNotFoundEx = false) : mixed
    - public [DirectoryMapApi::updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/updateDirectoryMapByObfuscatedName.md)(string $obfuscated_name, array $directoryMap) : void
    - public [DirectoryMapApi::deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/deleteDirectoryMapByObfuscatedName.md)(string $obfuscated_name) : void
    - public [DirectoryMapApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/setPdoWrapper.md)(Ling\SimplePdoWrapper\SimplePdoWrapperInterface $pdoWrapper) : void

}






Methods
==============

- [CustomDirectoryMapApi::getDirectoryMapByRealName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/Custom/CustomDirectoryMapApi/getDirectoryMapByRealName.md) &ndash; Returns the directoryMap row identified by the given realName.
- [DirectoryMapApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/__construct.md) &ndash; Builds the DirectoryMapApi instance.
- [DirectoryMapApi::insertDirectoryMap](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/insertDirectoryMap.md) &ndash; Inserts the given directoryMap in the database.
- [DirectoryMapApi::getDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/getDirectoryMapByObfuscatedName.md) &ndash; Returns the directoryMap row identified by the given obfuscated_name.
- [DirectoryMapApi::updateDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/updateDirectoryMapByObfuscatedName.md) &ndash; Updates the directoryMap row identified by the given obfuscated_name.
- [DirectoryMapApi::deleteDirectoryMapByObfuscatedName](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/deleteDirectoryMapByObfuscatedName.md) &ndash; Deletes the directoryMap identified by the given obfuscated_name.
- [DirectoryMapApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.





Location
=============
Ling\Light_UserData\Api\Custom\CustomDirectoryMapApi<br>
See the source code of [Ling\Light_UserData\Api\Custom\CustomDirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/Api/Custom/CustomDirectoryMapApi.php)



SeeAlso
==============
Next class: [DirectoryMapApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/DirectoryMapApi.md)<br>
