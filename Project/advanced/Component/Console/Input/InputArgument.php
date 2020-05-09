<?php
namespace Jan\Component\Console\Input;


/**
 * Class InputArgument
 * @package Jan\Component\Console\Input
*/
class InputArgument
{

    /**
     * @var array
    */
    protected $arguments = [];


    /**
     * InputArgument constructor.
     * @param array $arguments
    */
    public function __construct(array $arguments)
    {
          $this->arguments = $arguments;
    }


    /**
     * @param $name
     * @param array $params
    */
    public function setArgument($name, $params = [])
    {
          $this->arguments[$name] = $params;
    }


    /**
     * @param $name
     * @return string|null
    */
    public function getArgument($name)
    {
        return trim($this->arguments[$name]) ?? null;
    }


    /**
     * @return array
    */
    public function getArguments()
    {
        return $this->arguments;
    }


    public function validates() {}
}