<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface QueryManagerInterface
 * @package Jan\Component\Database\Contracts
*/
interface QueryManagerInterface
{

     /**
      * @param $connection
      * @return mixed
     */
     public function addConnection($connection);


     /**
      * @return mixed
     */
     public function getConnection();
}