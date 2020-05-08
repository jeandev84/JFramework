<?php
namespace Jan\Component\Console\Output;


/**
 * Interface OutputInterface
 * @package Jan\Component\Console\Output
 *
 * /TODO more advanced
 */
interface OutputInterface
{
    /**
     * @param string $message
     * @return OutputInterface
    */
    public function write(string $message);



    /**
     * @return mixed
    */
    public function getMessage();
}