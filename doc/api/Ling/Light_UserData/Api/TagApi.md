[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)



The TagApi class
================
2019-09-27 --> 2019-10-17






Introduction
============

The TagApi class.



Class synopsis
==============


class <span class="pl-k">TagApi</span> implements [TagApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface.md) {

- Properties
    - protected Ling\SimplePdoWrapper\SimplePdoWrapperInterface [$pdoWrapper](#property-pdoWrapper) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/__construct.md)() : void
    - public [insertTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/insertTag.md)(array $tag, ?bool $ignoreDuplicate = true, ?bool $returnRic = false) : mixed
    - public [getTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/getTagById.md)(int $id, ?$default = null, ?bool $throwNotFoundEx = false) : mixed
    - public [updateTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/updateTagById.md)(int $id, array $tag) : void
    - public [deleteTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/deleteTagById.md)(int $id) : void
    - public [setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/setPdoWrapper.md)(Ling\SimplePdoWrapper\SimplePdoWrapperInterface $pdoWrapper) : void

}




Properties
=============

- <span id="property-pdoWrapper"><b>pdoWrapper</b></span>

    This property holds the pdoWrapper for this instance.
    
    



Methods
==============

- [TagApi::__construct](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/__construct.md) &ndash; Builds the TagApi instance.
- [TagApi::insertTag](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/insertTag.md) &ndash; Inserts the given tag in the database.
- [TagApi::getTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/getTagById.md) &ndash; Returns the tag row identified by the given id.
- [TagApi::updateTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/updateTagById.md) &ndash; Updates the tag row identified by the given id.
- [TagApi::deleteTagById](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/deleteTagById.md) &ndash; Deletes the tag identified by the given id.
- [TagApi::setPdoWrapper](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApi/setPdoWrapper.md) &ndash; Sets the pdoWrapper.





Location
=============
Ling\Light_UserData\Api\TagApi<br>
See the source code of [Ling\Light_UserData\Api\TagApi](https://github.com/lingtalfi/Light_UserData/blob/master/Api/TagApi.php)



SeeAlso
==============
Previous class: [ResourceHasTagApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/ResourceHasTagApiInterface.md)<br>Next class: [TagApiInterface](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Api/TagApiInterface.md)<br>
