<?php 

/**
 * Facade
 * __callStatic() php >= v.5.3
*/

class Query 
{

       public static function __callStatic($method, $arguments)
       {
              // dd([$name, $arguments]);
              $query = new \Core\Database\QueryBuilder();
              return call_user_func_array([$query, $method], $arguments);
       }

}