<?php
namespace Jan\Component\Database;


/**
 * Class Configuration
 * @package Jan\Component\Database
 *
 * Database configuration manager
 *
 * TODO remove this configuration file !
*/
class Configuration
{

      /** @var array */
      private $config;


      /**
       * DatabaseConfiguration constructor.
       * @param array $config
      */
      public function __construct(array $config)
      {
          $this->config = $config;
      }

      /**
       * @param $key
       * @return bool
      */
      private function has($key)
      {
          return isset($this->config[$key]);
      }


      /**
       * @param $key
       * @return mixed
       * @throws \Exception
      */
      private function get($key)
      {
           if(! $this->has($key))
           {
               throw new \Exception(
                   sprintf('config param (%s) is not available !', $key)
               );
           }

           return $this->config[$key];
      }


     /**
      * @param $name
      * @param $arguments
      * @return mixed
      * @throws \Exception
     */
      public function __call($name, $arguments)
      {
            $name = strtolower(
                str_replace('get', '', $name)
            );
            return $this->get($name);
      }

}

