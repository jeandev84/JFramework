<?php
namespace Jan\Component\Console\Input;


/**
 * Class Input
 * @package Jan\Component\Console\Input
*/
abstract class Input implements InputInterface
{

    /**
     * @return mixed
    */
    abstract public function parse();
}