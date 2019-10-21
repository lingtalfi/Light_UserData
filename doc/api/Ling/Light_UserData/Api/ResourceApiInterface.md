[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)



The ResourceApiInterface class
================
2019-09-27 --> 2019-10-21






Introduction
============

The ResourceApiInterface interface.



Class synopsis
==============


abstract class <span class="pl-k">ResourceApiInterface</span>  {

- Methods
    - abstract public [getResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/getResourceById.md)(int $id, ?$default = null, ?bool $throwNotFoundEx = false) : mixed
    - abstract public [updateResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/updateResourceById.md)(int $id, array $resource) : void
    - abstract public [insertResource](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/insertResource.md)(array $resource, ?bool $ignoreDuplicate = true, ?bool $returnRic = false) : mixed
    - abstract public [deleteResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/deleteResourceById.md)(int $id) : void

}






Methods
==============

- [ResourceApiInterface::getResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/getResourceById.md) &ndash; Returns the resource row identified by the given id.
- [ResourceApiInterface::updateResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/updateResourceById.md) &ndash; Updates the resource row identified by the given id.
- [ResourceApiInterface::insertResource](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/insertResource.md) &ndash; Inserts the given resource in the database.
- [ResourceApiInterface::deleteResourceById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApiInterface/deleteResourceById.md) &ndash; Deletes the resource identified by the given id.





Location
=============
Ling\Light_UserData\Api\ResourceApiInterface<br>
See the source code of [Ling\Light_UserData\Api\ResourceApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/Api/ResourceApiInterface.php)



SeeAlso
==============
Previous class: [ResourceApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceApi.md)<br>Next class: [ResourceHasTagApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApi.md)<br>
