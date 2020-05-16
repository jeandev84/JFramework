<?php
namespace Jan\Component\Database\Connectors;


use Jan\Component\Database\Config;
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
      * @param Config $config
      * @return array
      * @throws \Exception
     */
     public static function storage(Config $config)
     {
         return [
             new MysqlDriver($config),
             new SqliteDriver($config),
             new PgsqlDriver($config),
             new OracleDriver($config)
         ];
     }

}