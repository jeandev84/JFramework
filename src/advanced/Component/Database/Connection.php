<?php
namespace Jan\Component\Database;


use Exception;
use Jan\Component\Database\Connectors\ConnectionStack;
use Jan\Component\Database\Contracts\ConnectionInterface;
use Jan\Component\Database\Exceptions\ConnectionException;


/**
 * Class Connection
 * @package Jan\Component\Database
 *
 * Connection maker (factory)
 */
class Connection
{

     /** @var mixed */
     protected static $instance;


     /** @var mixed */
     protected static $connection;



     /** @var bool */
     protected static $status = false;


     /**
      * prevent instance from being cloned
      *
      * @return void
     */
     private function __clone(){}



     /**
      * prevent instance from being unserialized
      *
      * @return void
     */
     private function __wakeup(){}




     /**
      * @param array $config
      * @return mixed
      * @throws Exception
     */
     public static function make(array $config)
     {
          $config = new Config($config);
          $driver = $config['driver'];

          try {

              foreach (ConnectionStack::storage($config) as $connection)
              {
                  if(self::isActiveDriver($connection, $driver))
                  {
                      self::setConnectionInstance($connection);
                      break;
                  }
              }

          } catch (Exception $e) {

              throw $e;
          }

          return self::$instance;
      }



     /**
      * @param ConnectionInterface $connection
      * @param string $driver
      * @return bool
     */
     public static function isActiveDriver(ConnectionInterface $connection, string $driver)
     {
           return ($connection->getDriver() === $driver);
     }


     /**
      * Get connection status
      * @return mixed
     */
     public static function getStatus()
     {
          return self::$status;
     }


     /**
      * @param array $config
      * @throws Exception
     */
     public static function open(array $config)
     {
          if(is_null(self::$connection))
          {
              self::$connection = static::make($config);
          }
     }


     /**
      * @return mixed
      * @throws ConnectionException
     */
     public static function instance()
     {
         if(is_null(self::$connection))
         {
             throw new ConnectionException('Connection is not opened');
         }

         return self::$connection;
     }


    /**
     * Disconnect
     * @return void
    */
    public static function close()
    {
        self::$connection = null;
    }


    /**
     * @param $connection
    */
    private static function setConnectionInstance($connection)
    {
        if(is_null(self::$instance))
        {
            if(self::$instance = $connection->connect())
            {
                self::$status = true;
            }
        }
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

* First Connect to database like this:

Connection::open([
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

* And can run next :

$stmt = Connection::instance()->prepare('SELECT * FROM users');
if($stmt->execute())
{
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    dd($users);
}
*/