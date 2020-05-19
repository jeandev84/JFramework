<?php
namespace Jan\Component\Database\ORM\Builder\Contract;


/**
 * Class SqlQueryBuilder
 * @package Jan\Component\Database\ORM\Builder
*/
abstract class SqlBuilder
{

      /** @var array */
      protected $arguments = [];


      /**
       * @param array $arguments
      */
      public function __construct(array $arguments)
      {
          $this->arguments = $arguments;
      }


      /**
       * @return array
      */
      public function getArguments()
      {
          return $this->arguments;
      }


      /**
       * @param $key
       * @return mixed|null
      */
      protected function getArgument($key)
      {
          return $this->arguments[$key] ?? null;
      }


      /** @return string */
      abstract public function getType();


      /** @return string */
      abstract public function getSql();

}