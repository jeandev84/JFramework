<?php
namespace Jan\Component\Console\Input;


/**
 * Class Input
 * @package Jan\Component\Console\Input
*/
class Input implements InputInterface
{

    /** @var array */
    protected $tokens;


    /** @var array  */
    protected $arguments = [];


    /** @var array  */
    protected $options = [];


    /**
     * Input constructor.
     * @param array $argv
    */
    public function __construct(array $argv = [])
    {
         if(! $argv)
         {
             $argv = $_SERVER['argv'] ?? [];
         }

         $this->tokens = $argv;

         $this->arguments = new InputArgument([]);
         $this->options = new InputOption([]);
    }



    /**
     * @return string
    */
    public function parse()
    {

    }


    /**
     * @return mixed
    */
    public function getArguments()
    {
       // return $this->arguments->getArguments();
    }


    /**
     * @param string $name
     * @return mixed
    */
    public function getOption(string $name)
    {
        // TODO: Implement getOption() method.
    }


    /**
     * @return mixed
    */
    public function getOptions()
    {
        // TODO: Implement getOptions() method.
    }


    /**
     * @return string
    */
    public function getArgument(string $name)
    {
        // TODO: Implement getArgument() method.
    }
}