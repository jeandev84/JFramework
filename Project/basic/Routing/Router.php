<?php
namespace Jan\Routing;


/**
 * Class Router
 * @package Jan\Routing
*/
class Router
{

    /** @var array [Current route] */
    protected $route;


    /** @var array  */
    protected $routes = [];


    /** @var array  */
    protected $patterns = [];


    /** @var array  */
    protected $namedRoutes = [];


    /** @var array  */
    protected $middlewares = [];


    /**
     * Router constructor.
    */
    public function __construct() {}


    /**
     * @param array|string $methods
     * @param string $path
     * @param $handler
     * @param string|null $name
     * @return Router
    */
    public function map($methods, string $path, $handler, string $name = null)
    {
          $route = compact('methods', 'path', 'handler');
          $this->routes[] = $route;
          $this->route = $route;

         $this->routeName($name, $path);
          return $this;
    }

    /**
     * @param array $middlewares
     * @return Router
     */
    public function middleware(array $middlewares)
    {
         $this->middlewares[$this->route['path']] = $middlewares;

         return $this;
    }


    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name)
    {
        $this->namedRoutes[$name] = $this->route['path'];

        return $this;
    }


    /**
     * @param string $requestMethod
     * @param string $requestUri
     * @return bool|mixed
     */
    public function match(string $requestMethod, string $requestUri)
    {
        foreach ($this->routes as $route)
        {
            list($methods, $path, $handler, $name) =  array_values($route);

            if(\in_array($requestMethod, $this->resolvedMethods($methods)))
            {
                   // TODO prepare part path and URI
                  if(preg_match($this->compile($path), $this->resolvedPath($requestUri), $matches))
                  {
                       return $route;
                  }
            }
        }

        return false;
    }


    /**
     * @param string $path
     * @return string
    */
    public function compile(string $path)
    {
        return '#^' . trim($path, '/') . '$#i';
    }


    /**
     * Generate route
     * @param string $name
     * @param array $params
     * @return string
    */
    public function generate(string $name, array $params = [])
    {
         $path = $this->namedRoutes[$name] ?? null;

         if($params)
         {
             $path = str_replace(['something'], ['anything'], $path);
         }

         return '/' . ltrim($path, '/');
    }


    /**
     * @param string $path
    */
    private function convertorParam(string $path)
    {
           //
    }


    /**
     * @param string $uri
     * @return string
    */
    private function resolvedPath(string $uri)
    {
        return trim(parse_url($uri, PHP_URL_PATH), '/');
    }


    /**
     * @param $methods
     * @return false|string[]
    */
    private function resolvedMethods($methods)
    {
        if(is_string($methods))
        {
            return explode('|', $methods);
        }

        return (array) $methods;
    }


    /**
     * @param $name
     * @param $path
     * @throws RouterException
    */
    private function routeName($name, $path)
    {
        if($name)
        {
            if(isset($this->namedRoutes[$name]))
            {
                throw new RouterException('This name (%s) already taken!');
            }

            $this->namedRoutes[$name] = $path;
        }
    }
}