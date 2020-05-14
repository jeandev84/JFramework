<?php
namespace Jan\Utils;


use Jan\Component\Database\Connection;


/**
 * Class Status
 * @package Jan\Utils
*/
class Status
{

    /**
     * Get status connection to database
    */
    public static function isConnectedToDb()
    {
        return Connection::getStatus() == true ? 'Connected' : 'Disconnected';
    }
}