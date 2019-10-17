[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)<br>
[Back to the Ling\Light_UserData\Controller\LightUserDataController class](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Controller/LightUserDataController.md)


LightUserDataController::render
================



LightUserDataController::render — or throws an exception.




Description
================


public [LightUserDataController::render](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Controller/LightUserDataController/render.md)(string $file, string $id) : string




Returns the file identified by the given file and id,
or throws an exception.

The file is the relative path from the user directory to the desired file.

The id is the obfuscated user directory name.

If the file is private and the visitor (asking for the file) isn't the owner,
then an exception will be thrown also.




Parameters
================


- file

    


Return values
================

Returns string.


Exceptions thrown
================

- [Exception](http://php.net/manual/en/class.exception.php).&nbsp;







Source Code
===========
See the source code for method [LightUserDataController::render](https://github.com/lingtalfi/Light_UserData/blob/master/Controller/LightUserDataController.php#L40-L98)


See Also
================

The [LightUserDataController](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Controller/LightUserDataController.md) class.



