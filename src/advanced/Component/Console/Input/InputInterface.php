<?php
namespace Jan\Component\Console\Input;


/**
 * Interface InputInterface
 * @package Jan\Component\Console\Input
 *
 * /TODO more advanced
*/
interface InputInterface
{
    /**
     * Get parse argument
     * @return string
    */
    public function getArgument();
}