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
      * @param string $sql
      * @return mixed
     */
     public function addSql(string $sql);


     /**
      * @param array $params
      * @return mixed
     */
     public function addValues(array $params = []);


     /**
      * @param string|null $classMap
      * @return mixed
     */
     public function registerClassMap(?string $classMap);


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


     /**
      * @return mixed
     */
     public function getFirstResult();
}