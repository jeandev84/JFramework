<?php
namespace Jan\Component\Database\Migration;


/**
 * Class Migrator
 * @package Jan\Component\Database\Migration
*/
class Migrator
{

      /** @var \PDO  */
      protected $connection;


      /**
       * Migrator constructor.
       * @param \PDO $connection
      */
      public function __construct(\PDO $connection)
      {
          $this->connection = $connection;
      }
}