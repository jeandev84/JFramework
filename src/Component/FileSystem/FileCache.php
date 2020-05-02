<?php
namespace Jan\Component\FileSystem;


use Jan\Contract\Cache\CacheInterface;

/**
 * Class FileCache
 * @package Jan\Component\FileSystem
*/
class FileCache extends FileSystem implements CacheInterface
{

      protected $cache;

      /**
       * FileCache constructor.
       * @param string $resource
      */
      public function __construct(string $resource)
      {
          parent::__construct($resource);
      }

     /**
      * @param $key
      * @param $value
      * @return mixed
     */
     public function set($key, $value)
     {
        // TODO: Implement set() method.
     }


    /**
     * @param $key
     * @return mixed
    */
    public function get($key)
    {
        // TODO: Implement get() method.
    }


    /**
     * @param $key
     * @return mixed
    */
    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return mixed
     */
    public function destroy()
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @return mixed
     */
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function has($key)
    {
        // TODO: Implement has() method.
    }
}