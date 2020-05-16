<?php
namespace Jan\Component\Database\ORM\Relation;


/**
 * Class Query
 * @package Jan\Component\Database\ORM\Relation
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