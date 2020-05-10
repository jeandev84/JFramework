<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface EntityManagerInterface
 * @package Jan\Component\Database\Contracts
*/
interface EntityManagerInterface
{

    /**
     * @param object $object
     * @return mixed
    */
    // public function create(object $object);


    /**
     * @param object $object
     * @return mixed
    */
    // public function read(object $object);


    /**
     * assignment
     * @param object $object
    */
    public function persist(object $object);


    /**
     * @param object $object
     * @return mixed
    */
    public function delete(object $object);



    /** save data */
    public function flush();
}