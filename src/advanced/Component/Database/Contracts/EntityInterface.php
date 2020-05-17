<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface EntityInterface
 * @package Jan\Component\Database\Contracts
*/
interface EntityInterface
{
     /**
      * Get name of table
      * @return string
     */
     public function getTable();
}