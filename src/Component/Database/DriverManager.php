<?php
namespace Jan\Component\Database;


use Exception;
use Jan\Component\Database\Contracts\DatabaseInterface;
use Jan\Component\Database\Extensions\PDO\Drivers\MysqlConnection;
use Jan\Component\Database\Extensions\PDO\Drivers\SqliteConnection;


/**
 * Class DriverManager
 * @package Jan\Component\Database
 *
 * Factory driver manager
*/
class DriverManager
{

     /** @var Configuration  */
     private $config;



    /**
     * DriverManager constructor.
     * @param Configuration $config
     * @throws Exception
     */
     public function __construct(Configuration $config)
     {
           $this->config = $config;
     }


     /**
      * @return mixed
      *
      * @throws Exception
     */
     public function getConnection()
     {
         foreach ($this->getAvailableConnections() as $connection)
         {
              if($this->isActiveDriver($connection))
              {
                  return $connection->connect();
              }
         }

         return false;
     }


     /**
      * @param DatabaseInterface $connection
      * @return bool
     */
     public function isActiveDriver(DatabaseInterface $connection)
     {
         return ($connection->getDriver() === $this->config->getDriver());
     }


     /**
      * @return array
      * @throws Exception
     */
     public function getAvailableConnections()
     {
         return [
             new MysqlConnection($this->config),
             new SqliteConnection($this->config),
         ];
     }
}