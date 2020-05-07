<?php
namespace Jan\Component\Database\ORM;


/**
 * Class Record
 * @package Jan\Component\Database\ORM
 *
 * PDO Record
*/
class Record
{

      /** @var \PDOStatement  */
      protected $statement;

      /**
       * Record constructor.
       * @param \PDOStatement $statement
      */
      public function __construct(\PDOStatement $statement)
      {
          $this->statement = $statement;
      }


      public function findAll()
      {

      }


      public function findOne()
      {

      }

      public function findBy()
      {

      }

      public function findById()
      {

      }

}