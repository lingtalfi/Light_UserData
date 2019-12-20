<?php


namespace Ling\Light_UserData\Api;

use Ling\SimplePdoWrapper\SimplePdoWrapper;


/**
 * The ResourceApi class.
 */
class ResourceApi extends LightUserDataBaseApi implements ResourceApiInterface
{


    /**
     * Builds the ResourceApi instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "luda_resource";
    }




    /**
     * @implementation
     */
    public function insertResource(array $resource, bool $ignoreDuplicate = true, bool $returnRic = false)
    { 
        try {

            $lastInsertId = $this->pdoWrapper->insert($this->table, $resource);
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

                $query = "select id from `$this->table`";
                $allMarkers = [];
                SimplePdoWrapper::addWhereSubStmt($query, $allMarkers, $resource);
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
    public function getResourceById(int $id, $default = null, bool $throwNotFoundEx = false)
    { 
        $ret = $this->pdoWrapper->fetch("select * from `$this->table` where id=:id", [
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
    public function getResourceByRealPath(string $real_path, $default = null, bool $throwNotFoundEx = false)
    { 
        $ret = $this->pdoWrapper->fetch("select * from `$this->table` where real_path=:real_path", [
            "real_path" => $real_path,

        ]);
        if (false === $ret) {
            if (true === $throwNotFoundEx) {
                throw new \RuntimeException("Row not found with real_path=$real_path.");
            } else {
                $ret = $default;
            }
        }
        return $ret;
    }




    /**
     * @implementation
     */
    public function getAllIds(): array
    { 
         return $this->pdoWrapper->fetchAll("select id from `$this->table`", [], \PDO::FETCH_COLUMN);
    }

    /**
     * @implementation
     */
    public function updateResourceById(int $id, array $resource)
    { 
        $this->pdoWrapper->update($this->table, $resource, [
            "id" => $id,

        ]);
    }

    /**
     * @implementation
     */
    public function updateResourceByRealPath(string $real_path, array $resource)
    { 
        $this->pdoWrapper->update($this->table, $resource, [
            "real_path" => $real_path,

        ]);
    }



    /**
     * @implementation
     */
    public function deleteResourceById(int $id)
    { 
        $this->pdoWrapper->delete($this->table, [
            "id" => $id,

        ]);
    }

    /**
     * @implementation
     */
    public function deleteResourceByRealPath(string $real_path)
    { 
        $this->pdoWrapper->delete($this->table, [
            "real_path" => $real_path,

        ]);
    }






}
