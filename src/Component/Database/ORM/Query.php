<?php
namespace Jan\Component\Database\ORM;


/**
 * Class Query
 * @package Jan\Component\Database\ORM
*/
class Query
{


     /** @var QueryBuilder */
     private $queryBuilder;


     public function __construct()
     {
         $this->queryBuilder = new QueryBuilder();
     }

     /**
      * @return QueryBuilder
     */
     public function createQueryBuilder()
     {
         // return new QueryBuilder();
     }
}