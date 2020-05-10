<?php
namespace Jan\Component\Console\Output;


/**
 * Interface OutputInterface
 * @package Jan\Component\Console\Output
 */
interface OutputInterface
{

    /**
     * @param string $message
     * @return OutputInterface
    */
    public function write(string $message);


    /**
     * @param string $message
     * @return mixed
    */
    public function writeln(string $message);


    /**
     * @return mixed
    */
    public function getMessage();


    /**
     * @return mixed
    */
    public function getFormater();
}