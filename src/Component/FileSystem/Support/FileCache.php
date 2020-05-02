<?php
namespace Jan\Component\FileSystem\Support;


use Jan\Component\FileSystem\Exception\FileStorageException;
use Jan\Contracts\Cache\CacheInterface;


/**
 * Class FileCache
 * @package Jan\Component\FileSystem\Support
 *
 * Available in this class method <destroy, all>
*/
class FileCache extends FileStorage implements CacheInterface
{


      /** @var string */
      protected $storageKey = 'cache';


      /**
       * @var string
      */
      protected $ext = 'txt';


      /**
       * FileCache constructor.
       * @param string $resource
      */
      public function __construct(string $resource)
      {
          parent::__construct($resource);
      }

      /**
       * @param string $ext
       * @return FileCache
      */
      public function withExtension(string $ext)
      {
          $this->ext = $ext;

          return $this;
      }


      /**
       * @param $key
       * @param $data
       * @param int $duration
       * @return mixed
       * @throws \Exception
     */
     public function set($key, $data, $duration = 3600)
     {
         $content = ['data' => $data, 'end_time' => time() + $duration];

         return parent::set($this->hashKey($key), serialize($content));
     }


    /**
     * @param $key
     * @return mixed
    */
    public function get($key)
    {
        if($this->exists($key))
        {
            $cacheFile = $this->cacheFile($key);
            $content = unserialize(file_get_contents($cacheFile));
            if(time() <= $content['end_time'])
            {
                return $content['data'];
            }

            unlink($cacheFile);
        }

        return false;
    }


    /**
     * @param $key
     * @return mixed
    */
    public function delete($key)
    {
        if($this->exists($key))
        {
            unlink($this->cacheFile($key));
        }
    }


    /**
     * @param string $key
     * @return bool
    */
    public function exists($key)
    {
        return parent::exists($this->hashKey($key));
    }


    /**
     * Get cache file
     *
     * @param $key
     * @return string
    */
    protected function cacheFile($key)
    {
       return $this->getStoragePath($this->hashKey($key));
    }


    /**
     * @param $key
     * @return string
    */
    protected function hashKey($key)
    {
        return md5($key).($this->ext ? '.'. $this->ext : '');
    }

}