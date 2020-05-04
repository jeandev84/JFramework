<?php
namespace Jan\Component\Routing;


use Jan\Component\Routing\Exception\RouteException;


/**
 * Class Router
 * @package Jan\Component\Routing
 *
 * Author Jean-Claude
 * Email jeanyao@ymail.com
*/
class Router
{

    const MASK_PARAM = [
        '#{([\w]+)}#',
        '#:([\w]+)#'
    ];


    /** @var string */
    private $baseUrl;


    /** @var array  */
    private $routes = [];


    /** @var array  */
    private $patterns = [];


    /** @var array  */
    private $middlewares = [];


    /**
     * Router constructor.
     *
     * @param array $routes
    */
    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }


    /**
     * Add base url
     *
     * @param string $baseUrl
     * @return Router
    */
    public function addBaseUrl(string $baseUrl): Router
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }


    /**
     * Add routes
     *
     * @param array $routes
     * @return Router
    */
    public function addRoutes(array $routes): Router
    {
        $this->routes = $routes;
        return $this;
    }


    /**
     * Add regular expressions
     *
     * @param array $patterns
     * @return Router
    */
    public function addPatterns(array $patterns): Router
    {
        $this->patterns = array_merge($this->patterns, $patterns);
        return $this;
    }


    /**
     * Add stack route middlewares
     *
     * @param array $middlewares
     * @return Router
    */
    public function addMiddlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
        return $this;
    }


    /**
     * Return all routes middlewares
     *
     * @return array
    */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }


    /**
     * @param $path
     * @return array|mixed
    */
    public function getMiddleware($path)
    {
        return $this->middlewares[$path] ?? [];
    }


    /**
     * Return the current matched route if founded
     * otherwise return false
     *
     * @param string $requestMethod
     * @param string $requestUri
     * @return bool|array
     * @throws \Exception
     *
     * Example :
     *
     * $route = $this->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])
     *
     * it' will be return next collection if route founded
     *
     * $route =  [
     *    "methods" => array:1 [
     *       0 => "GET"
     *     ]
     *     "path" => "/"
     *     "target" => "App\Controllers\HomeController@index"
     *     "matches" => []
     *     "pattern" => "#^$#i"
     *  ]
    */
    public function match(string $requestMethod, string $requestUri)
    {
          foreach ($this->routes as $route)
          {
               list($methods, $path, $target) = array_values($route);

               if(\in_array($requestMethod, (array) $methods))
               {
                   if(preg_match($pattern = $this->compile($path), $this->resolveUrl($requestUri), $matches))
                   {
                       $matches = $this->filteredParams($matches);
                       $middlewares = $this->getMiddleware($path);

                       return array_merge(
                           $route,
                           compact('matches', 'pattern', 'middlewares')
                       );
                   }
               }
          }

          throw new RouteException('Route not found!', 404);
          /* return false; */
    }



    /**
     * @param $matches
     * @return array
    */
    private function filteredParams($matches)
    {
        return array_filter($matches, function ($key) {
            return ! is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Path compiler
     * @param string $path
     * @return string
    */
    private function compile(string $path)
    {
         return '#^'. $this->convertParam($path) . '$#i';
    }


    /**
     * Convert route param
     *
     * @param $path
     * @return string|string[]|null
    */
    private function convertParam($path)
    {
        return preg_replace_callback(self::MASK_PARAM,
            [$this, 'paramMatch'],
            $this->resolvePath($path)
        );
    }


    /**
     * @param $match
     * @return string
    */
    private function paramMatch($match)
    {
        if($this->hasPattern($match[1]))
        {
            return '(?P<'. $match[1] .'>'. $this->resolveMatch($match[1]) . ')';
            // return '(' .  $this->resolveMatch($match[1]). ')';
        }
        return '([^/]+)';
    }

    /**
     * @param $key
     * @return string|string[]
    */
    private function resolveMatch($key)
    {
        return str_replace( '(', '(?:', $this->patterns[$key]);
    }

    /**
     * Determine if has pattern
     * @param $key
     * @return bool
    */
    private function hasPattern($key)
    {
        return isset($this->patterns[$key]);
    }


    /**
     * Path resolver
     * @param $path
     * @return string
    */
    private function resolvePath($path)
    {
       return trim($path, '/');
    }

    /**
     * Resolve parse URI
     * Checking only path from URL
     *
     * @param string $uri
     * @return string
    */
    private function resolveUrl(string $uri)
    {
        return $this->resolvePath(
            parse_url($uri, PHP_URL_PATH)
        );
    }
}