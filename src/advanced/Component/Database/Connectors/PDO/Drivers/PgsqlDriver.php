<?php
namespace Jan\Component\Database\Connectors\PDO\Drivers;


use Jan\Component\Database\Connectors\PDO\Connection;


/**
 * Class PgsqlDriver
 * @package Jan\Component\Database\Connectors\PDO\Drivers
 *
 * Postgre SQL connection via PDO
 */
class PgsqlDriver extends Connection
{

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return 'pgsql';
    }
}