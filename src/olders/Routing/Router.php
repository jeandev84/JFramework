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


    /** @var array  */
    private $namedRoutes = [];



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
     * @param array $namedRoutes
     * @return Router
    */
    public function addNamedRoutes(array $namedRoutes)
    {
        $this->namedRoutes = $namedRoutes;

        return $this;
    }

    /**
     * @return array
    */
    public function getNamedRoutes()
    {
        return $this->namedRoutes;
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
    public function middlewares()
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
     * @param $path
     * @return mixed|null
    */
    public function getRouteName($path)
    {
          //
    }


    /**
     * Return the current matched route if founded
     * otherwise return false
     *
     * @param string $requestMethod
     * @param string $requestUri
     * @return array
     * @throws RouteException
    */
    public function match(string $requestMethod, string $requestUri)
    {
          if(! empty($this->routes))
          {
              foreach ($this->routes as $route)
              {
                  list($methods, $path) = array_values($route);

                  if(\in_array($requestMethod, (array) $methods))
                  {
                      if($parses = $this->isMatch($path, $requestUri))
                      {
                          return array_merge($route, $parses);
                      }
                  }
              }

              throw new RouteException('Route not found!', 404);

          }
    }


    /**
     * Determine if route match current URL
     *
     * @param $path
     * @param $requestUri
     * @return mixed
    */
    private function isMatch($path, $requestUri)
    {
        $pattern = $this->compile($path);
        $uri = $this->resolveUrl($requestUri);

        if(preg_match($pattern, $uri, $matches))
        {
            $matches = $this->filteredParams($matches);
            $middlewares = $this->getMiddleware($path);
            return compact('matches', 'pattern', 'middlewares');
        }

        return false;
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
       /*
        $path = htmlentities($path, ENT_QUOTES, 'UTF-8');
        urldecode($path);
       */

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
        return $this->resolvePath(parse_url($uri, PHP_URL_PATH));
    }
}