<?php
namespace Jan\Component\Console\Input;


use InvalidArgumentException;

/**
 * Class Input
 * @package Jan\Component\Console\Input
*/
abstract class Input implements InputInterface
{

    /** @var  [ for stream ] */
    // protected $stream;


    /** @var bool  */
    protected $interactive = true;


    /** @var  */
    protected $inputBag;


    /** @var array  */
    protected $arguments = [];


    /** @var array  */
    protected $options = [];


    /**
     * Input constructor.
     * @param InputBag|null $inputBag
    */
    public function __construct(InputBag $inputBag = null)
    {
           if(! $inputBag)
           {
               $this->inputBag = new InputBag();
           }else{
               $this->initialize($inputBag);
               $this->runValidationHandle();
           }
    }


    /**
     * @param InputBag $inputBag
    */
    public function initialize(InputBag $inputBag)
    {
          $this->arguments = [];
          $this->options = [];
          $this->inputBag = $inputBag;

          $this->parse();
    }


    /**
     * @return bool
    */
    public function isInteractive()
    {
        return $this->interactive;
    }


    /**
     * @param string $name
     * @return mixed|null
    */
    public function getArgument(string $name)
    {
        if(! $this->inputBag->hasArgument($name))
        {
            throw new InvalidArgumentException(
                sprintf('The %s argument does not exist.', $name)
            );
        }

        $default = $this->inputBag->getArgument($name)->getDefault();
        return $this->arguments[$name] ?? $default;
    }


    /**
     * @param string $name
     * @param $value
    */
    public function setArgument(string $name, $value)
    {
         if(! $this->inputBag->hasArgument($name))
         {
             throw new InvalidArgumentException(
                 sprintf('The "%s" argument does not exist.', $name)
             );
         }

         $this->arguments[$name] = $value;
    }


    /**
     * @param string $name
     * @return bool
    */
    public function hasArgument(string $name)
    {
        return $this->inputBag->hasArgument($name);
    }


    /**
     * Validation parses
     */
    public function runValidationHandle()
    {
        //
    }


    /**
     * @return mixed
    */
    abstract public function process();
}