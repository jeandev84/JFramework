<?php 
namespace App;


/**
 * Class Autoloader
 * @package App
**/
class Autoloader
{  
       

       const DS = DIRECTORY_SEPARATOR;


       static function register()
       {
             spl_autoload_register([__CLASS__, 'autoload']);
       }


	     static function autoload($class)
	     {
            if(strpos($class, __NAMESPACE__.'\\') === 0)
            {
                $class = str_replace(__NAMESPACE__.'\\', '', $class);
                $class = str_replace('\\', self::DS, $class);
                require __DIR__.self::DS . $class . '.php';     
            }
	     }
}

// \App\Autoloader::register();