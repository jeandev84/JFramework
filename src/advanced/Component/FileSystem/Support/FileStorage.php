<?php
namespace Jan\Component\FileSystem\Support;


use Jan\Component\FileSystem\Exception\FileStorageException;
use Jan\Component\FileSystem\FileSystem;
use Jan\Contracts\Storage\StorageInterface;


/**
 * Class FileStorage
 * @package Jan\Component\FileSystem\Support
*/
class FileStorage extends FileSystem implements StorageInterface
{


    /** @var string  */
    protected $storageKey = '.default';


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
        return file_put_contents($this->generateStoragePath($key), $value);
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
        $dir = opendir($this->getStoragePath());

        while (false !== ($item = readdir($dir)))
        {
            if(! in_array($item, ['.', '..']))
            {
                 @unlink($this->getStoragePath($item));
            }
        }
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $items = [];

        $dir = opendir($this->getStoragePath());

        while (false !== ($item = readdir($dir)))
        {
            if(! in_array($item, ['.', '..']))
            {
                $items[$item] = file_get_contents($this->getStoragePath($item));
            }
        }

        return $items;
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
    public function getStoragePath($key = null)
    {
        return parent::resource($this->storageKey.($key ? '/' . $key : ''));
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