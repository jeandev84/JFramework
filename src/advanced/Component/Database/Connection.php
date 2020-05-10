<?php
namespace Jan\Component\Database;



use Exception;

/**
 * Class Connection
 * @package Jan\Component\Database
 *
 * Connection factory
 */
class Connection
{

     /** @var mixed */
     private static $instance;


     /**
      * @param array $config
      * @return mixed
      * @throws Exception
     */
     public static function make(array $config)
     {
          $config = new Configuration($config);
          $driverManager = new DriverManager($config->driver());
          $driverManager->addConnections(ConnectionStack::storage($config));

          if(is_null(self::$instance))
          {
              self::$instance = call_user_func([$driverManager , 'getConnection']);
          }

          return self::$instance;
      }

}

/*
$connection = \Jan\Component\Database\Connection::make([
    'driver'    => 'mysql',
    'database'  => 'default',
    'host'      => '127.0.0.1',
    'port'      => '3306',
    'charset'   => 'utf8',
    'username'  => 'root',
    'password'  => 'secret',
    'collation' => 'utf8_unicode_ci',
    'options'   => [],
    'prefix'    => '',
    'engine'    => 'innoDB'
]);
*/