<?php
namespace Jan\Component\Database\Extensions\PDO\Drivers;

use Jan\Component\Database\Extensions\PDO\AbstractPdoConnection;


/**
 * Class MysqlConnection
 * @package Jan\Component\Database\Extensions\PDO\Drivers
 *
 * Mysql connection via PDO
*/
class MysqlConnection extends AbstractPdoConnection
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