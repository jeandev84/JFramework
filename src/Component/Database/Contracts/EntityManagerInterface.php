<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface EntityManagerInterface
 * @package Jan\Component\Database\Contracts
*/
interface EntityManagerInterface
{

    /**
     * assignment
     * @param object $object
    */
    public function persist(object $object);

    /** save data */
    public function flush();
}