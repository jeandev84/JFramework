<?php
namespace Jan\Component\FileSystem;


use Jan\Component\FileSystem\Exception\FileStorageException;
use Jan\Contract\Storage\StorageInterface;


/**
 * Class FileStorage
 * @package Jan\Component\FileSystem
*/
class FileStorage extends FileSystem implements StorageInterface
{

    /** @var string  */
    protected $storageKey = '__cache';


    /**
     * FileStorage constructor.
     * @param string $resource
    */
    public function __construct(string $resource)
    {
        parent::__construct($resource);
    }

    /**
     * @param $storageKey
     * @return $this
    */
    public function withStorageKey(string $storageKey)
    {
        $this->storageKey = $storageKey;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @throws \Exception
    */
    public function set($key, $value)
    {
        file_put_contents($this->generateStoragePath($key), $value);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if($this->exists($key))
        {
            return file_get_contents($this->getStoragePath($key));
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws FileStorageException
     */
    public function delete($key)
    {
       if(! $this->exists($key))
       {
           throw new FileStorageException(
               sprintf('Sorry file (%s) does not exist', $this->getStoragePath($key))
           );
       }

       unlink($this->getStoragePath($key));
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
     * @return string
     * @throws \Exception
    */
    public function generateStoragePath(string $key)
    {
        return $this->make($this->storageKey. '/'. trim($key, '/'));
    }


    /**
     * @param $key
     * @return string
    */
    public function getStoragePath($key)
    {
        return parent::resource(sprintf('%s/%s', $this->storageKey, $key));
    }

    /**
     * @param string $key
     * @return bool
    */
    public function exists($key)
    {
        return parent::exists(sprintf('%s/%s', $this->storageKey, $key));
    }
}