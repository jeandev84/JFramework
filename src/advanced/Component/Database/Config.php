<?php
namespace Jan\Component\Database;


use Jan\Component\Database\Exceptions\ConfigException;


/**
 * Class Config
 * @package Jan\Component\Database
 *
 * Database configuration manager
*/
class Config implements \ArrayAccess
{

      /** @var array */
      protected $params = [
          'driver'    => '',
          'database'  => '',
          'host'      => '',
          'port'      => '',
          'charset'   => '',
          'username'  => '',
          'password'  => '',
          'collation' => '',
          'options'   => '',
          'prefix'    => '',
          'engine'    => ''
      ];


      /**
       * Config constructor.
       * @param array $params
      */
      public function __construct(array $params)
      {
          foreach($params as $key => $value)
          {
              $this->set($key, $value);
          }
      }


      /**
       * @param $key
       * @param $value
      */
      public function set($key, $value)
      {
          if(array_key_exists($key, $this->params))
          {
              $this->params[$key] = $value;
          }
      }


      /**
       * @param $key
       * @return mixed
       * @throws \Exception
      */
      public function get($key)
      {
           if(! $this->has($key))
           {
               throw new ConfigException(
                   sprintf('config param (%s) is not available !', $key)
               );
           }

           return $this->params[$key];
      }


     /**
      * @param $key
      * @return bool
     */
     private function has($key)
     {
        return isset($this->params[$key]);
     }


     /**
      * @param $key
      * @return mixed|string
      * @throws \Exception
     */
     public function __get($key)
     {
         return $this->get($key);
     }


     /**
      * @param mixed $offset
      * @return bool
     */
     public function offsetExists($offset)
     {
         return $this->has($offset);
     }


    /**
     * @param mixed $offset
     * @return mixed
     * @throws \Exception
    */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }


    /**
     * @param mixed $offset
     * @param mixed $value
    */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }


    /**
     * @param mixed $offset
    */
    public function offsetUnset($offset)
    {
        if($this->has($offset))
        {
            unset($this->params[$offset]);
        }
    }
}

