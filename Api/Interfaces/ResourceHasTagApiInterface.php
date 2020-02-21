<?php


namespace Ling\Light_UserData\Api\Interfaces;


/**
 * The ResourceHasTagApiInterface interface.
 * It implements the @page(ling standard object methods) concept.
 */
interface ResourceHasTagApiInterface
{

    /**
     * Inserts the given resourceHasTag in the database.
     * By default, it returns the result of the PDO::lastInsertId method.
     * If the returnRic flag is set to true, the method will return the ric array instead of the lastInsertId.
     *
     *
     * If the row you're trying to insert triggers a duplicate error, the behaviour of this method depends on
     * the ignoreDuplicate flag:
     * - if true, the error will be caught internally, the return of the method is not affected
     * - if false, the error will not be caught, and depending on your configuration, it might either
     *          trigger an exception, or fail silently in which case this method returns false.
     *
     *
     *
     * @param array $resourceHasTag
     * @param bool $ignoreDuplicate
     * @param bool $returnRic
     * @return mixed
     * @throws \Exception
     */
    public function insertResourceHasTag(array $resourceHasTag, bool $ignoreDuplicate = true, bool $returnRic = false);

    /**
     * Returns the resourceHasTag row identified by the given resource_id and tag_id.
     *
     * If the row is not found, this method's return depends on the throwNotFoundEx flag:
     * - if true, the method throws an exception
     * - if false, the method returns the given default value
     *
     *
     * @param int $resource_id
	 * @param int $tag_id
     * @param mixed $default = null
     * @param bool $throwNotFoundEx = false
     * @return mixed
     * @throws \Exception
     */
    public function getResourceHasTagByResourceIdAndTagId(int $resource_id, int $tag_id, $default = null, bool $throwNotFoundEx = false);



    /**
     * Returns the resourceHasTag row identified by the given [where conditions](https://github.com/lingtalfi/SimplePdoWrapper#the-where-conditions).
     *
     * If the row is not found, this method's return depends on the throwNotFoundEx flag:
     * - if true, the method throws an exception
     * - if false, the method returns the given default value
     *
     *
     * @param $where
     * @param array $markers
     * @param null $default
     * @param bool $throwNotFoundEx
     * @return mixed
     * @throws \Exception
     */
    public function getResourceHasTag($where, array $markers = [], $default = null, bool $throwNotFoundEx = false);


    /**
     * Returns the resourceHasTag rows identified by the given [where conditions](https://github.com/lingtalfi/SimplePdoWrapper#the-where-conditions).
     *
     *
     * @param $where
     * @param array $markers
     * @return array
     * @throws \Exception
     */
    public function getResourceHasTags($where, array $markers = []);







    /**
     * Updates the resourceHasTag row identified by the given resource_id and tag_id.
     *
     * @param int $resource_id
	 * @param int $tag_id
     * @param array $resourceHasTag
     * @return void
     * @throws \Exception
     */
    public function updateResourceHasTagByResourceIdAndTagId(int $resource_id, int $tag_id, array $resourceHasTag);



    /**
     * Deletes the resourceHasTag identified by the given resource_id and tag_id.
     *
     * @param int $resource_id
	 * @param int $tag_id
     * @return void
     * @throws \Exception
     */
    public function deleteResourceHasTagByResourceIdAndTagId(int $resource_id, int $tag_id);

    /**
     * Deletes the resourceHasTag identified by the given resource_id.
     *
     * @param int $resource_id
     * @return void
     * @throws \Exception
     */
    public function deleteResourceHasTagByResourceId(int $resource_id);

    /**
     * Deletes the resourceHasTag identified by the given tag_id.
     *
     * @param int $tag_id
     * @return void
     * @throws \Exception
     */
    public function deleteResourceHasTagByTagId(int $tag_id);



}