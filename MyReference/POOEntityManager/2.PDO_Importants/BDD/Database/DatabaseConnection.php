<?php 
namespace Framework\Database;


class DatabaseConnection
{
        
         const DSN = '%s:host=%s;dbname=%s;charset=utf8';


         private $config;
  

	     public function __construct(DatabaseConfiguration $config)
	     {
	     	    $this->config = $config->set(require_once __DIR__.'/config.php');
	     }

         
         public function make()
         {
              try
              {
                  return new PDO($this->getDSN(), $this->getUser(), $this->getPassword());
                  
                  // if driver est mysql => Mysql
                  // $objConnection = ucfirst($this->config->getDriver());
                  // return new $objConnection($this->config); 
                 
              } catch (PDOException $e) {

                   die($e->getMessage());
              }
         	  
         }


         // ICI A DEPLACER DANS LES DRIVERS
         private function getDSN()
         {
             return sprintf(self::DSN, $this->getDriver(), $this->getHost(), $this->getDb());
         }


         private function getDriver()
         {
             $this->config->getItem('driver');
         }

         private function getHost()
         {
             $this->config->getItem('host');
         }


         private function getDb()
         {
             $this->config->getItem('db');
         }


         private function getUser()
         {
              $this->config->getItem('user');
         }


         private function getPassword()
         {
             $this->config->getItem('password');
         }


}