<?php
namespace Jan\Component\Database\Connectors\PDO\Drivers;

use Jan\Component\Database\Connectors\PDO\PdoConnection;


/**
 * Class MysqlDriver
 * @package Jan\Component\Database\Connectors\PDO\Drivers
 *
 * MysqlDriver connection via PDO
*/
class MysqlDriver extends PdoConnection
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