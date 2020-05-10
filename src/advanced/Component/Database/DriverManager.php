<?php
namespace Jan\Component\Database;


use Exception;
use Jan\Component\Database\Contracts\DatabaseInterface;


/**
 * Class DriverManager
 * @package Jan\Component\Database
 *
 * Factory driver manager
*/
class DriverManager
{

     /**
      * @var string
      * [ Current driver ]
     */
     private $driver;


     /**
      * @var array
     */
     private $connections = [];


     /**
      * DriverManager constructor.
      * @param string $driver
     */
     public function __construct(string $driver)
     {
           $this->driver = $driver;
     }


    /**
     * @param array $connections
     */
    public function addConnections(array $connections)
    {
         $this->connections = $connections;
    }


    /**
     * @return array
     */
     public function getAvailableConnections()
     {
          return $this->connections;
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
         return ($connection->getDriver() === $this->driver);
     }

}