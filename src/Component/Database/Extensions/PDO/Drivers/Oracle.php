<?php
namespace Jan\Component\Database\Extensions\PDO\Drivers;


use Jan\Component\Database\Extensions\PDO\PdoConnection;

/**
 * Class Oracle
 * @package Jan\Component\Database\Extensions\PDO\Drivers
 *
 * Oracle connection via PDO
*/
class Oracle extends PdoConnection
{

    public function getDriver(): string
    {
        return 'oci';
    }
}