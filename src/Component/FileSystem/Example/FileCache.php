<?php
namespace Jan\Component\FileSystem\Example;


use Jan\Component\FileSystem\Exception\FileStorageException;
use Jan\Component\FileSystem\Support\FileStorage;
use Jan\Contracts\Cache\CacheInterface;


/**
 * Class FileCache
 * @package Jan\Component\FileSystem\Example
 */

class FileCache extends FileStorage implements CacheInterface
{

    /** @var string */
    protected $storageKey = 'cache';

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
     * @param $data
     * @param int $duration
     * @return mixed
     * @throws \Exception
     */
    public function set($key, $data, $duration = 3600)
    {
        $content = ['data' => $data, 'end_time' => time() + $duration];

        return parent::set($this->hashFile($key), serialize($content));
    }


    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if($this->exists($key))
        {
            $cacheFile = $this->getStoragePath($this->hashFile($key));
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
     * @throws FileStorageException
     */
    public function delete($key)
    {
        if($this->exists($key))
        {
            unlink($this->getStoragePath($this->hashFile($key)));
        }
    }


    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return parent::exists($this->hashFile($key));
    }


    /**
     * @param $key
     * @return string
     */
    private function hashFile($key)
    {
        return md5($key).'.txt';
    }

}