<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface QueryManagerInterface
 * @package Jan\Component\Database\Contracts
*/
interface QueryManagerInterface
{


     /** @param mixed */
     public function addConnection($connection);


     /**
      * @return mixed
     */
     public function getConnection();


    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
     public function execute(string $sql = null, array $params = []);


     /**
      * @return mixed
     */
     public function getResults();


     /** @return int */
     public function count();


     /** @return int */
     public function lastId();

}