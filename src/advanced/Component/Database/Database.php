<?php
namespace Jan\Component\Database;


use Jan\Component\Database\Exceptions\ConnectionException;

/**
 * Class Database
 * @package Jan\Component\Database
*/
class Database
{

     /** @var mixed */
     protected static $connection;


     /**
      * @param array $config
      * @throws \Exception
     */
     public static function connect(array $config)
     {
         self::$connection = Connection::make($config);
     }


     /**
      * @return mixed
      * @throws ConnectionException
     */
     public static function instance()
     {
         if(is_null(self::$connection))
         {
             throw new ConnectionException('Can not get connection!');
         }

         return self::$connection;
     }


     /**
      * Disconnect
      * @return void
     */
     public static function disconnect()
     {
         self::$connection = null;
     }
}