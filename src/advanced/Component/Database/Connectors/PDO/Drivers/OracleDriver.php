<?php
namespace Jan\Component\Database\Connectors\PDO\Drivers;


use Jan\Component\Database\Connectors\PDO\Connection;


/**
 * Class Oracle
 * @package Jan\Component\Database\Connectors\PDO\Drivers
 *
 * Oracle connection via PDO
*/
class OracleDriver extends Connection
{

    public function getDriver(): string
    {
        return 'oci';
    }
}