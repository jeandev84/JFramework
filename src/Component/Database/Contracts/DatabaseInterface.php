<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface DatabaseInterface
 * @package Jan\Component\Database\Contracts
*/
interface DatabaseInterface
{

    /**
     * @return string
    */
    public function getDriver(): string ;


    /**
     * Connection to Database
     * @return mixed
    */
    public function connect();


    /**
     * Disconnect
     * @return mixed
    */
    public function disconnect();
}