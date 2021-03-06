<?php
namespace Jan\Component\FileSystem;


use Jan\Component\FileSystem\Exception\FileSystemException;


/**
 * Class FileSystem
 * @package Jan\Component\FileSystem
 *
 * Author Jean-Claude
 * Email <jeanyao@ymail.com>
*/
class FileSystem
{


    /** @var string */
    protected $resource;



    /**
     * FileSystem constructor.
     * @param string $resource
    */
    public function __construct(string $resource)
    {
        $this->resource = $resource;
    }



    /**
     * Check full path
     *
     * @param string $source
     * @return string
    */
    public function resource(string $source = null)
    {
        return $this->resolvedBasePath() .
            ($source ? DIRECTORY_SEPARATOR. $this->resolvedPath($source) : '');
    }


    /**
     * Require given source
     *
     * @param string $source
     * @return bool|mixed
     */
    public function load(string $source)
    {
        if(! $this->exists($source))
        {
            return false;
        }

        return require $this->resource($source);
    }


    /**
     * Determine if the given path exist
     *
     * @param string $source
     * @return bool
     */
    public function exists(string $source)
    {
        return file_exists($this->resource($source));
    }


    /**
     * @param string $source
     * @return array|false
     *
     * $this->resources('routes/*')
     * $this->resources('routes/*.php')
    */
    public function resources(string $source)
    {
        return glob($this->resource($source));
    }


     /**
      * @param $source
      * @return bool|string
     */
     public function mkdir($source)
     {
         $directory = $this->resource($source);

         if(! is_dir($directory))
         {
             mkdir($directory, 0777, true);
         }

         return $directory ?? false;
     }


    /**
     * Make File
     * @param string $path
     * @return bool
     * @throws \Exception
     *
     * $fileSystem = (new FileSystem(__DIR));
     * $fileSystem->make('.env')
     * $fileSystem->make('error.log')
     * $fileSystem->make('test.txt')
     *
     */
    public function make(string $path)
    {
        $resource = $this->resource($path);
        $fileDirectory = dirname($resource);

        if(! is_dir($fileDirectory))
        {
            if( ! mkdir($fileDirectory, 0777, true))
            {
                throw new FileSystemException(
                    sprintf('Can not create directory (%s)', $fileDirectory)
                );
            }
        }

        return touch($resource) ? $resource : false;
    }


    /**
     * @param string $filename
     * @param string|null $key
     * @return string|string[]
     */
    public function getFileDetails(string $filename, string $key = null)
    {
        $details = pathinfo($this->resource($filename));

        if(!is_null($key))
        {
            return $details[$key] ?? null;
        }

        return $details;
    }


    /**
     * @param $filename
     * @return string|string[]
    */
    public function getDirectoryName($filename)
    {
        return $this->getFileDetails($filename, 'dirname');
    }


    /**
     * @param $filename
     * @return string|string[]
    */
    public function getBaseName($filename)
    {
        return $this->getFileDetails($filename, 'basename');
    }


    /**
     * @param $filename
     * @return string|string[]
    */
    public function getFileExtension($filename)
    {
        return $this->getFileDetails($filename, 'extension');
    }


    /**
     * @param $filename
     * @return string|string[]
     */
    public function getFileName($filename)
    {
        return $this->getFileDetails($filename, 'filename');
    }


    /**
     * @param $path
     * @return false|string
    */
    public function read($path)
    {
        return file_get_contents($this->resource($path));
    }


    /**
     * @param $path
     * @param $data
    */
    public function write($path, $data)
    {
        file_put_contents($this->resource($path), $data);
    }


    /**
     * Path resolver
     * @param string $source
     * @return string
    */
    protected function resolvedPath(string $source = null)
    {
        if($source)
        {
            return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($source, '\/'));
        }
    }


    /**
     * Base path resolver
     * @return string
     */
    protected function resolvedBasePath()
    {
        return rtrim($this->resource, '\/');
    }



    /**
     * @param $filename
     * @param $to
     */
    public function move($filename, $to)
    {
        //
    }



    /**
     * @param $origin
     * @param $destination
     */
    public function copy($origin, $destination)
    {
        //
    }

}