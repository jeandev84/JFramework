<?php
namespace Jan\Component\Database\ORM\Builder\Contract;


/**
 * Class SqlQueryBuilder
 * @package Jan\Component\Database\ORM\Builder
*/
abstract class SqlBuilder
{
      /** @var array  */
      protected $arguments = [];


     /**
       * SqlBuilder constructor.
       * @param array $arguments
      */
      public function __construct(array $arguments)
      {
          $this->arguments = $arguments;
      }


      /**
       * @param $key
       * @return mixed|null
      */
      protected function getArgument($key)
      {
          return $this->arguments[$key] ?? null;
      }
}