[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)



The TagApiInterface class
================
2019-09-27 --> 2019-10-17






Introduction
============

The TagApiInterface interface.



Class synopsis
==============


abstract class <span class="pl-k">TagApiInterface</span>  {

- Methods
    - abstract public [getTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/getTagById.md)(int $id, ?$default = null, ?bool $throwNotFoundEx = false) : mixed
    - abstract public [updateTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/updateTagById.md)(int $id, array $tag) : void
    - abstract public [insertTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/insertTag.md)(array $tag, ?bool $ignoreDuplicate = true, ?bool $returnRic = false) : mixed
    - abstract public [deleteTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/deleteTagById.md)(int $id) : void

}






Methods
==============

- [TagApiInterface::getTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/getTagById.md) &ndash; Returns the tag row identified by the given id.
- [TagApiInterface::updateTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/updateTagById.md) &ndash; Updates the tag row identified by the given id.
- [TagApiInterface::insertTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/insertTag.md) &ndash; Inserts the given tag in the database.
- [TagApiInterface::deleteTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface/deleteTagById.md) &ndash; Deletes the tag identified by the given id.





Location
=============
Ling\Light_UserData\Api\TagApiInterface<br>
See the source code of [Ling\Light_UserData\Api\TagApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/Api/TagApiInterface.php)



SeeAlso
==============
Previous class: [TagApi](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi.md)<br>Next class: [LightUserDataController](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Controller/LightUserDataController.md)<br>
