<?php
namespace Jan\Component\Database\ORM\Relation;


/**
 * Class Record
 * @package Jan\Component\Database\ORM\Relation
 *
 * PDO Record
 *
 * This class will be check all record like find(), findBy(), findOne() ....
 *
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