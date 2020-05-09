<?php 
namespace App\Table;


use App\App;


/**
 * self fait recourt a la classe directement dans laquelle il se trouve 
 * static fait recourt a une classe qui est appelee
 * La portee de static est plus grande que celle de self
**/
class Table
{
       
        // protected static $table;

        
        /**
         * Late Static Binding
        private static function getTable()
        {
        	 if(static::$table === null)
        	 {
        	 	 $class_name = explode('\\', get_called_class());
        	 	 // on recupere le dernier element du tableau
                 static::$table = strtolower(end($class_name)) .'s';  
        	 }
             
             // dd(static::$table, true);

        	 return static::$table;
        }
        **/


        public static function find($id)
        {
            $sql = "SELECT * FROM ". static::$table ." WHERE id = ?";
            return static::query($sql, [$id], true);
        }


        public static function query($statement, $attributes = null, $one = false)
        {
              if($attributes)
              {
                  return App::getDb()->prepare($statement, $attributes, get_called_class(), $one);

              }else{

                   return App::getDb()->query($statement, get_called_class(), $one);
              }
             
        }
       
        public static function all()
        {
        	 $sql = "SELECT * FROM ". static::$table;

             return App::getDb()->query($sql, get_called_class());
        }


       /**
        * $key = url
        * $method = getURL()
       */
  	   public function __get($key)
  	   {
  	   	   $method = 'get' . ucfirst($key);
  	   	   $this->{$key} = $this->{$method}();
             return $this->{$key};
  	   }

}