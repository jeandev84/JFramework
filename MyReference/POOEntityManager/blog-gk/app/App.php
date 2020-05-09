<?php 


use Core\Database\MysqlDatabase;
use Core\Config;

/**
 * App or AppFactory
 * Classe dedie au Factory de notre application
**/
class App 
{
      
     public $title = 'Blog';
     private $db_instance;
     private static $_instance;

    
     // Singleton
     public static function getInstance()
     {
         if(is_null(self::$_instance))
         {
            self::$_instance = new App();
         }

         return self::$_instance;
     }


     public static function load()
     {
        session_start();
        require ROOT . '/app/Autoloader.php';
        \App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        \Core\Autoloader::register();
     }


     // Factory for get name table
     public function getTable($name)
     {
         $class_name = '\\App\\Table\\'. ucfirst($name) .'Table';
         return new $class_name($this->getDb());
     }
     

     // Factory for get Db
     public function getDb()
     {

          $config = Config::getInstance(ROOT .'/config/config.php');
          
          if(is_null($this->db_instance))
          {
              $this->db_instance = new MysqlDatabase(
                          $config->get('db_name'),
                          $config->get('db_user'),
                          $config->get('db_pass'),
                          $config->get('db_host')
                       );
          }

          return $this->db_instance;
     }

     
}