<?php
namespace Jan\Component\Database\Extensions\PDO\Drivers;


use Jan\Component\Database\Extensions\PDO\PdoConnection;


/**
 * Class Pgsql
 * @package Jan\Component\Database\Extensions\PDO\Drivers
 *
 * Postgre SQL connection via PDO
 */
class Pgsql extends PdoConnection
{

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return 'pgsql';
    }
}