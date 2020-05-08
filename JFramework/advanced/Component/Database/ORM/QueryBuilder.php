<?php
namespace Jan\Component\Database\ORM;


/**
 * Class QueryBuilder
 * @package Jan\Component\Database\ORM
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