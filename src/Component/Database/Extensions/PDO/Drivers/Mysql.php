<?php
namespace Jan\Component\Database\Extensions\PDO\Drivers;

use Jan\Component\Database\Extensions\PDO\PdoConnection;


/**
 * Class Mysql
 * @package Jan\Component\Database\Extensions\PDO\Drivers
 *
 * Mysql connection via PDO
*/
class Mysql extends PdoConnection
{

    /**
     * Driver name
     * @return string
    */
    public function getDriver(): string
    {
        return 'mysql';
    }
}