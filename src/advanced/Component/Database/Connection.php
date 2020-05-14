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


     /** @var bool */
     private static $status = false;



     /**
      * @param array $config
      * @return mixed
      * @throws Exception
     */
     public static function make(array $config)
     {
          try {

              $config = new Configuration($config);
              $driverManager = new DriverManager($config->driver());
              $driverManager->addConnections(ConnectionStack::collections($config));

              if(is_null(self::$instance))
              {
                  self::$instance = call_user_func([$driverManager, 'getConnection']);
              }

              if(! is_null(self::$instance))
              {
                  self::$status = true;
              }

          } catch (Exception $e) {

              throw $e;
          }

          return self::$instance;
      }


      /**
       * Get connection status
       * @return mixed
      */
      public static function getStatus()
      {
          return self::$status;
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