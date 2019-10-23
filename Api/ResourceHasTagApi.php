<?php


namespace Ling\Light_UserData\Api;


use Ling\SimplePdoWrapper\SimplePdoWrapperInterface;
use Ling\SimplePdoWrapper\SimplePdoWrapper;

/**
 * The ResourceHasTagApi class.
 */
class ResourceHasTagApi implements ResourceHasTagApiInterface
{

    /**
     * This property holds the pdoWrapper for this instance.
     * @var SimplePdoWrapperInterface
     */
    protected $pdoWrapper;

    /**
     * Builds the ResourceHasTagApi instance.
     */
    public function __construct()
    {
        $this->pdoWrapper = null;
    }




    /**
     * @implementation
     */
    public function insertResourceHasTag(array $resourceHasTag, bool $ignoreDuplicate = true, bool $returnRic = false)
    {
        try {

            $lastInsertId = $this->pdoWrapper->insert("luda_resource_has_tag", $resourceHasTag);
            if (false === $returnRic) {
                return $lastInsertId;
            }
            $ric = [
                'resource_id' => $resourceHasTag["resource_id"],
				'tag_id' => $resourceHasTag["tag_id"],

            ];
            return $ric;

        } catch (\PDOException $e) {
            if ('23000' === $e->errorInfo[0]) {
                if (false === $ignoreDuplicate) {
                    throw $e;
                }

                $query = "select resource_id, tag_id from `luda_resource_has_tag`";
                $allMarkers = [];
                SimplePdoWrapper::addWhereSubStmt($query, $allMarkers, $resourceHasTag);
                $res = $this->pdoWrapper->fetch($query, $allMarkers);
                if (false === $res) {
                    throw new \LogicException("A duplicate entry has been found, but yet I cannot fetch it, why?");
                }
                if (false === $returnRic) {
                    return "0";
                }
                return [
                    'resource_id' => $res["resource_id"],
				'tag_id' => $res["tag_id"],

                ];
            }
        }
        return false;
    }

    /**
     * @implementation
     */
    public function getResourceHasTagByResourceIdAndTagId(int $resource_id, int $tag_id, $default = null, bool $throwNotFoundEx = false)
    {
        $ret = $this->pdoWrapper->fetch("select * from `luda_resource_has_tag` where resource_id=:resource_id and tag_id=:tag_id", [
            "resource_id" => $resource_id,
				"tag_id" => $tag_id,

        ]);
        if (false === $ret) {
            if (true === $throwNotFoundEx) {
                throw new \RuntimeException("Row not found with resource_id=$resource_id, tag_id=$tag_id.");
            } else {
                $ret = $default;
            }
        }
        return $ret;
    }




    /**
     * @implementation
     */
    public function updateResourceHasTagByResourceIdAndTagId(int $resource_id, int $tag_id, array $resourceHasTag)
    {
        $this->pdoWrapper->update("luda_resource_has_tag", $resourceHasTag, [
            "resource_id" => $resource_id,
			"tag_id" => $tag_id,

        ]);
    }



    /**
     * @implementation
     */
    public function deleteResourceHasTagByResourceIdAndTagId(int $resource_id, int $tag_id)
    {
        $this->pdoWrapper->delete("luda_resource_has_tag", [
            "resource_id" => $resource_id,
			"tag_id" => $tag_id,

        ]);
    }








    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Sets the pdoWrapper.
     *
     * @param SimplePdoWrapperInterface $pdoWrapper
     */
    public function setPdoWrapper(SimplePdoWrapperInterface $pdoWrapper)
    {
        $this->pdoWrapper = $pdoWrapper;
    }
}
