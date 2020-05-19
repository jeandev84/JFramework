<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface EntityRepositoryInterface
 * @package Jan\Component\Database\Contracts
*/
interface EntityRepositoryInterface
{

    /**
     * Find all record
     * @return array
    */
    public function findAll();


    /**
     * Find all record by criteria
     * @param array $criteria
     * @return array
    */
    public function find(array $criteria);


    /**
     * Find one record by column
     * @param array $criteria
     * @return array
    */
    public function findBy(array $criteria);


    /**
     * Find one record by id
     * @param int $id
     * @return array
    */
    public function findOne(int $id);


    /**
     * Find one record by criteria
     * @param array $criteria
     * @return array
    */
    public function findOneBy(array $criteria);

}