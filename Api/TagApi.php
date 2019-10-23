<?php


namespace Ling\Light_UserData\Api;


use Ling\SimplePdoWrapper\SimplePdoWrapperInterface;
use Ling\SimplePdoWrapper\SimplePdoWrapper;

/**
 * The TagApi class.
 */
class TagApi implements TagApiInterface
{

    /**
     * This property holds the pdoWrapper for this instance.
     * @var SimplePdoWrapperInterface
     */
    protected $pdoWrapper;

    /**
     * Builds the TagApi instance.
     */
    public function __construct()
    {
        $this->pdoWrapper = null;
    }




    /**
     * @implementation
     */
    public function insertTag(array $tag, bool $ignoreDuplicate = true, bool $returnRic = false)
    {
        try {

            $lastInsertId = $this->pdoWrapper->insert("luda_tag", $tag);
            if (false === $returnRic) {
                return $lastInsertId;
            }
            $ric = [
                'id' => $lastInsertId,

            ];
            return $ric;

        } catch (\PDOException $e) {
            if ('23000' === $e->errorInfo[0]) {
                if (false === $ignoreDuplicate) {
                    throw $e;
                }

                $query = "select id from `luda_tag`";
                $allMarkers = [];
                SimplePdoWrapper::addWhereSubStmt($query, $allMarkers, $tag);
                $res = $this->pdoWrapper->fetch($query, $allMarkers);
                if (false === $res) {
                    throw new \LogicException("A duplicate entry has been found, but yet I cannot fetch it, why?");
                }
                if (false === $returnRic) {
                    return $res['id'];
                }
                return [
                    'id' => $res["id"],

                ];
            }
        }
        return false;
    }

    /**
     * @implementation
     */
    public function getTagById(int $id, $default = null, bool $throwNotFoundEx = false)
    {
        $ret = $this->pdoWrapper->fetch("select * from `luda_tag` where id=:id", [
            "id" => $id,

        ]);
        if (false === $ret) {
            if (true === $throwNotFoundEx) {
                throw new \RuntimeException("Row not found with id=$id.");
            } else {
                $ret = $default;
            }
        }
        return $ret;
    }


    /**
     * @implementation
     */
    public function getTagByName(string $name, $default = null, bool $throwNotFoundEx = false)
    {
        $ret = $this->pdoWrapper->fetch("select * from `luda_tag` where name=:name", [
            "name" => $name,

        ]);
        if (false === $ret) {
            if (true === $throwNotFoundEx) {
                throw new \RuntimeException("Row not found with name=$name.");
            } else {
                $ret = $default;
            }
        }
        return $ret;
    }




    /**
     * @implementation
     */
    public function updateTagById(int $id, array $tag)
    {
        $this->pdoWrapper->update("luda_tag", $tag, [
            "id" => $id,

        ]);
    }

    /**
     * @implementation
     */
    public function updateTagByName(string $name, array $tag)
    {
        $this->pdoWrapper->update("luda_tag", $tag, [
            "name" => $name,

        ]);
    }



    /**
     * @implementation
     */
    public function deleteTagById(int $id)
    {
        $this->pdoWrapper->delete("luda_tag", [
            "id" => $id,

        ]);
    }

    /**
     * @implementation
     */
    public function deleteTagByName(string $name)
    {
        $this->pdoWrapper->delete("luda_tag", [
            "name" => $name,

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
