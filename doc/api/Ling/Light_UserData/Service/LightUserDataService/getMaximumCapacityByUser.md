[Back to the Ling/Light_UserData api](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData.md)<br>
[Back to the Ling\Light_UserData\Service\LightUserDataService class](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService.md)


LightUserDataService::getMaximumCapacityByUser
================



LightUserDataService::getMaximumCapacityByUser — Returns the maximum number of bytes that the given user is allowed to use.




Description
================


public [LightUserDataService::getMaximumCapacityByUser](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getMaximumCapacityByUser.md)([Ling\Light_User\LightUserInterface](https://github.com/lingtalfi/Light_User/blob/master/doc/api/Ling/Light_User/LightUserInterface.md) $user) : int




Returns the maximum number of bytes that the given user is allowed to use.
Meaning, if the user tries to upload a file that would go beyond that number, the file would be rejected.




Parameters
================


- user

    


Return values
================

Returns int.








Source Code
===========
See the source code for method [LightUserDataService::getMaximumCapacityByUser](https://github.com/lingtalfi/Light_UserData/blob/master/Service/LightUserDataService.php#L623-L627)


See Also
================

The [LightUserDataService](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService.md) class.

Previous method: [rename](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/rename.md)<br>Next method: [getCurrentCapacityByUser](https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/Service/LightUserDataService/getCurrentCapacityByUser.md)<br>

