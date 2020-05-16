<?php
namespace Jan\Component\Database\Contracts;


/**
 * Interface ConnectionInterface
 * @package Jan\Component\Database\Contracts
*/
interface ConnectionInterface
{

    /**
     * Get driver name or type database
     * @return string
    */
    public function getDriver(): string ;


    /**
     * Get connection or connect to database
     * @return mixed
    */
    public function connect();


    /**
     * Disconnect to database
     * @return void
    */
    public function disconnect();
}