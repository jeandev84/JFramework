<?php
namespace Jan\Component\Database\ORM\Relation;


/**
 * Class QueryBuilder
 * @package Jan\Component\Database\ORM\Relation
*/
class QueryBuilder
{

      /** @var array  */
      private $sqlParts = [
          'select' => [],
          'from'   => [],
          'where'  => [],
          'limit'  => [],
          'join'   => [],
          'insert' => [],
          'update' => []
      ];
}