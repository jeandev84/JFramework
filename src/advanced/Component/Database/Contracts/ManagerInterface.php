<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface ManagerInterface
 * @package Jan\Component\Database\Contracts
*/
interface ManagerInterface
{

     /**
      * @return mixed
     */
     public function getConnection();


     /**
      * Entity class to map
      * @param string|null $classname
      * @return mixed
     */
     public function classMap(?string $classname);



     /**
      * @param mixed ...$args
      * @return mixed
     */
     // public function bindings(...$args);



     /**
      * Execute query with params
      * @param string $sql
      * @param array $params
      * @return mixed
     */
     public function execute(string $sql, array $params = []);



     /**
      * Execute simple query
      * @param string $sql
      * @return mixed
     */
     public function exec(string $sql);



     /**
      * Fetch all record
      * @return array
     */
     public function get();



     /**
      * Find first record
      * @return mixed
     */
     public function one();



     /**
      * Begin transaction
      * @return mixed
     */
     public function beginTransaction();


     /**
      * Commit
      * @return mixed
     */
     public function commit();


     /**
      * Rollback
      * @return mixed
     */
     public function rollback();


     /**
      * Get row count
      * @return int
     */
     public function count();


     /**
      * Get last inserted id
      * @return int
     */
     public function lastId();


     /**
      * Close cursor
      * @return void
     */
     public function closeCursor();
}