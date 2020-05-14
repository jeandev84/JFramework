<?php
namespace Jan\Component\Database\Connectors\PDO\Drivers;


use Jan\Component\Database\Connectors\PDO\PdoConnection;


/**
 * Class PgsqlDriver
 * @package Jan\Component\Database\Connectors\PDO\Drivers
 *
 * Postgre SQL connection via PDO
 */
class PgsqlDriver extends PdoConnection
{

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return 'pgsql';
    }
}