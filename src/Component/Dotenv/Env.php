<?php
namespace Jan\Component\Dotenv;


use Jan\Component\Dotenv\Exceptions\InvalidPathException;

/**
 * Class Env (Environment)
 * @package Jan\Component\Dotenv
*/
class Env
{

    /** @var string */
    protected $basePath;


    /**
     * Env constructor.
     * @param string $basePath
    */
    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
    }

    /**
     * @return array
     * @throws \Exception
    */
    public function load()
    {
        $environs = [];

        foreach ($this->getEnvironements() as $environment)
        {
            $environment = trim(str_replace("\n", '', $environment));

            if($this->hasAvailableEnvironment($environment))
            {
                 putenv($environment);
                 list($key, $value) = explode('=', $environment);
                 $environs[$key] = $value;
            }
        }

        return $_ENV = array_merge($_ENV, $environs);
    }


    /**
      * Get environment from .env file
      *
      * @return array|false
      * @throws \Exception
    */
    public function getEnvironements()
    {
        $filename = $this->basePath . DIRECTORY_SEPARATOR.'.env';

        if(! file_exists($filename))
        {
            throw new InvalidPathException(sprintf('Can not find file .env'));
        }
        return file($filename);
    }

    /**
     * @param $environment
     * @return bool
    */
    public function hasAvailableEnvironment($environment)
    {
        return strpos($environment, '=') !== false
            && stripos($environment, '#') === false;
    }
}

/*
$saved = getenv("LD_LIBRARY_PATH");        // save old value
$newld = "/extra/library/dir:/another/path/to/lib";  // extra paths to add
if ($saved) { $newld .= ":$saved"; }           // append old paths if any
putenv("LD_LIBRARY_PATH=$newld");        // set new value
system("mycommand -with args");        // do system command;
                        // mycommand is loaded using
                        // libs in the new path list
putenv("LD_LIBRARY_PATH=$saved");        // restore old value
*/