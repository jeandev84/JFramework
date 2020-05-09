<?php 
namespace Project;


class Route 
{

	   private static $routes = [];
       
       private static $params;

	   public static function get($uri, $handler = [])
	   {
              self::add('GET', $uri, $handler);
              return new static;
	   }

	   public static function post($uri, $handler = [])
	   {
             self::add('POST', $uri, $handler);
             return new static;
	   }

       public function with($params)
       {
            self::$params = $params;
            return $this;
       }

	   private static function add($method, $uri, $callback)
	   {
	   	    if(is_string($callback))
	   	    {
                 list($controller, $action) = explode('@', $callback, 2);
                 // $params = isset(self::$params) ? self::$params : null;

	   	    	 self::$routes[$method][$uri] = [
                    'controller' => $controller,
                    'action'     => $action,
                    //'params'     => $params
	   	    	 ];
	   	    }
	   }

	   public static function getRoutes()
	   {
	   	  dd(self::$routes);
	   }
}