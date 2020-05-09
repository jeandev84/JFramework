<?php
namespace Jan\Component\Database;


use Jan\Component\Database\Extensions\PDO\Drivers\Mysql;
use Jan\Component\Database\Extensions\PDO\Drivers\Oracle;
use Jan\Component\Database\Extensions\PDO\Drivers\Pgsql;
use Jan\Component\Database\Extensions\PDO\Drivers\Sqlite;

/**
 * Class ConnectionStack
 * @package Jan\Component\Database
*/
class ConnectionStack
{

     /**
      * @param $config
      * @return array
      * @throws \Exception
     */
     public static function storage($config)
     {
         return [
             new Mysql($config),
             new Sqlite($config),
             new Pgsql($config),
             new Oracle($config)
         ];
     }

}