<?php
namespace Jan\Component\FileSystem;


use Jan\Component\FileSystem\Exception\FileSystemException;


/**
 * Class File
 * @package Jan\Component\File
*/
class File
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
     * Make File
     * @param string $path
     * @return bool
     * @throws \Exception
     *
     * $fileSystem = (new FileSystem(__DIR));
     * $fileSystem->make('.env')
     * $fileSystem->make('error.log')
     * $fileSystem->make('database/migrations/2020120876464_users_table.php')
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
     * Path resolver
     * @param string $source
     * @return string
     */
    protected function resolvedPath(string $source = null)
    {
        if($source)
        {
            return str_replace(['\\', '/'],
                DIRECTORY_SEPARATOR,
                trim($source, '\/')
            );
        }

        return '';
    }


    /**
     * Base path resolver
     * @return string
    */
    protected function resolvedBasePath()
    {
        return rtrim($this->resource, '\/');
    }
}