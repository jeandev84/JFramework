<?php
namespace Jan\Component\Database;


use Jan\Component\Database\Connectors\PDO\Drivers\MysqlDriver;
use Jan\Component\Database\Connectors\PDO\Drivers\OracleDriver;
use Jan\Component\Database\Connectors\PDO\Drivers\PgsqlDriver;
use Jan\Component\Database\Connectors\PDO\Drivers\SqliteDriver;


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
     public static function collections($config)
     {
         return [
             new MysqlDriver($config),
             new SqliteDriver($config),
             new PgsqlDriver($config),
             new OracleDriver($config)
         ];
     }

}