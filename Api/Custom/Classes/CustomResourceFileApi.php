<?php


namespace Ling\Light_UserData\Api\Custom\Classes;

use Ling\Light_UserData\Api\Generated\Classes\ResourceFileApi;
use Ling\Light_UserData\Api\Custom\Interfaces\CustomResourceFileApiInterface;



/**
 * The CustomResourceFileApi class.
 */
class CustomResourceFileApi extends ResourceFileApi implements CustomResourceFileApiInterface
{


    /**
     * Builds the CustomResourceFileApi instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

}
