<?php


namespace Ling\Light_UserData\Api;

use Ling\SimplePdoWrapper\SimplePdoWrapper;


/**
 * The DirectoryMapApi class.
 */
class DirectoryMapApi extends LightUserDataBaseApi implements DirectoryMapApiInterface
{


    /**
     * Builds the DirectoryMapApi instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "luda_directory_map";
    }




    /**
     * @implementation
     */
    public function insertDirectoryMap(array $directoryMap, bool $ignoreDuplicate = true, bool $returnRic = false)
    { 
        try {

            $lastInsertId = $this->pdoWrapper->insert($this->table, $directoryMap);
            if (false === $returnRic) {
                return $lastInsertId;
            }
            $ric = [
                'obfuscated_name' => $directoryMap["obfuscated_name"],

            ];
            return $ric;

        } catch (\PDOException $e) {
            if ('23000' === $e->errorInfo[0]) {
                if (false === $ignoreDuplicate) {
                    throw $e;
                }

                $query = "select obfuscated_name from `$this->table`";
                $allMarkers = [];
                SimplePdoWrapper::addWhereSubStmt($query, $allMarkers, $directoryMap);
                $res = $this->pdoWrapper->fetch($query, $allMarkers);
                if (false === $res) {
                    throw new \LogicException("A duplicate entry has been found, but yet I cannot fetch it, why?");
                }
                if (false === $returnRic) {
                    return "0";
                }
                return [
                    'obfuscated_name' => $res["obfuscated_name"],

                ];
            }
        }
        return false;
    }

    /**
     * @implementation
     */
    public function getDirectoryMapByObfuscatedName(string $obfuscated_name, $default = null, bool $throwNotFoundEx = false)
    { 
        $ret = $this->pdoWrapper->fetch("select * from `$this->table` where obfuscated_name=:obfuscated_name", [
            "obfuscated_name" => $obfuscated_name,

        ]);
        if (false === $ret) {
            if (true === $throwNotFoundEx) {
                throw new \RuntimeException("Row not found with obfuscated_name=$obfuscated_name.");
            } else {
                $ret = $default;
            }
        }
        return $ret;
    }




    /**
     * @implementation
     */
    public function getAllObfuscatedNames(): array
    { 
         return $this->pdoWrapper->fetchAll("select obfuscated_name from `$this->table`", [], \PDO::FETCH_COLUMN);
    }

    /**
     * @implementation
     */
    public function updateDirectoryMapByObfuscatedName(string $obfuscated_name, array $directoryMap)
    { 
        $this->pdoWrapper->update($this->table, $directoryMap, [
            "obfuscated_name" => $obfuscated_name,

        ]);
    }



    /**
     * @implementation
     */
    public function deleteDirectoryMapByObfuscatedName(string $obfuscated_name)
    { 
        $this->pdoWrapper->delete($this->table, [
            "obfuscated_name" => $obfuscated_name,

        ]);
    }






}
