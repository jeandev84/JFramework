<?php
namespace Jan\Component\Database\Extensions\PDO\Drivers;


use Jan\Component\Database\Extensions\PDO\AbstractPdoConnection;


/**
 * Class PgsqlConnection
 * @package Jan\Component\Database\Extensions\PDO\Drivers
 *
 * Postgre SQL connection via PDO
 */
class PgsqlConnection extends AbstractPdoConnection
{

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return 'pgsql';
    }
}