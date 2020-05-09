<?php
namespace Jan\Component\Console\Input;


/**
 * Interface InputInterface
 * @package Jan\Component\Console\Input
*/
interface InputInterface
{

    /**
     * @param string $name
     * @return mixed
    */
    public function getArgument(string $name);


    /** @return mixed */
    public function getArguments();


    /**
     * @param string $name
     * @return mixed
    */
    public function getOption(string $name);


    /** @return mixed */
    public function getOptions();
}