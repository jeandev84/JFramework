<?php
namespace Jan\Component\Database\Extensions\PDO\Drivers;


use Jan\Component\Database\Extensions\PDO\AbstractPdoConnection;

/**
 * Class OracleConnection
 * @package Jan\Component\Database\Extensions\PDO\Drivers
 *
 * Oracle connection via PDO
*/
class OracleConnection extends AbstractPdoConnection
{

    public function getDriver(): string
    {
        return 'oci';
    }
}