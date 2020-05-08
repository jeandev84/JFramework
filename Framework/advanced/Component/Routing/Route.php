<?php
namespace Jan\Component\Routing;


use Jan\Component\Routing\Exception\RouteException;

/**
 * Class Route
 * @package Jan\Component\Routing
 *
 * Route collection
*/
class Route
{

    /**
     * @var array $collections
     * @var array $options
     * @var array $namedRoutes
     * @var array $currentRoute
     * @var array $middlewares
     * @var array $patterns
    */
    private static $collections = [];
    private static $options = [];
    private static $namedRoutes = [];
    private static $currentRoute;
    private static $middlewares = [];
    private static $patterns = [
        'int'  => '\d+',
        'text' => '\w+',
        'id'   => '[0-9]+',
        'slug' => '[a-z\-0-9]+',
        'any'  => '.*', // any
    ];

    /**
     * Map all route by method GET
     * @param $path
     * @param $target
     * @param null $name
     * @return Route
     * @throws \Exception
     */
    public static function get($path, $target, $name = null)
    {
        return self::map(['GET'], $path, $target, $name);
    }


    /**
     * Map all route by method POST
     * @param $path
     * @param $target
     * @param null $name
     * @return Route
     * @throws \Exception
     */
    public static function post($path, $target, $name = null)
    {
        return self::map(['POST'], $path, $target, $name);
    }


    /**
     * Map all route by method PUT
     * @param $path
     * @param $target
     * @param null $name
     * @return Route
     * @throws \Exception
     */
    public static function put($path, $target, $name = null)
    {
        return self::map(['PUT'], $path, $target, $name);
    }


    /**
     * Map all route by method PUT
     * @param $path
     * @param $target
     * @param null $name
     * @return Route
     * @throws \Exception
     */
    public static function delete($path, $target, $name = null)
    {
        return self::map(['DELETE'], $path, $target, $name);
    }


    /**
     * Set route group
     * @param array $options
     * @param callable $callback
     */
    public static function group(array $options, callable $callback)
    {
        self::appends($options);
        call_user_func($callback);
        self::remove();
    }


    /**
     * @param string $prefix
     * @param \Closure $callback
     */
    public static function prefix(string $prefix, \Closure $callback)
    {
        self::group(['prefix' => $prefix], $callback);
    }


    /**
     * @param string $namespace
     * @param \Closure $callback
     */
    public static function namespace(string $namespace, \Closure $callback)
    {
        self::group(['namespace' => $namespace], $callback);
    }


    /**
     * Add new package or resources of routes
     *
     * @param string $path
     * @param string $controller
     * @return void
     * Example (path => 'api/', 'controller' => 'Api\Controllers\PostController')
     */
    public static function resource(string $path, string $controller)
    {
        // TODO FIX
        /*
         Route::group(['prefix' => $path], function () use ($controller, $path) {

            $namePrefix = str_replace('/', '.', $path);

            Route::get('/', $controller.'@list', $namePrefix .'.list');
            Route::get('/new', $controller.'@new', $namePrefix. '.new');
            Route::post('/store', $controller.'@store', $namePrefix.'.store');
            Route::get('/{id}', $controller.'@show', $namePrefix.'.show');
            Route::map('GET|POST', '/{id}/edit', $controller.'@edit', $namePrefix.'.edit');
            Route::delete('/{id}/delete', $controller.'@delete', $namePrefix.'.delete');
            Route::get('/{id}/restore', $controller.'@restore', $namePrefix.'.restore');

         });
        */
    }


    /**
     * @param string|array $methods
     * @param string $path
     * @param $target
     * @param null $name
     * @return Route
     * @throws RouteException
     */
    public static function map($methods, string $path, $target, $name = null)
    {
         self::$currentRoute['methods'] = self::resolvedMethod($methods);
         self::$currentRoute['path']    = self::resolvedPath($path);
         self::$currentRoute['target']  = self::resolvedTarget($target);

         self::addMiddlewareFromOptions(self::$currentRoute['path']);
         self::addName($name, self::$currentRoute['path']);
         self::$collections[] = self::$currentRoute;
         return new self;
    }


    /**
     * Add middleware from options
     *
     * @param $path
    */
    private static function addMiddlewareFromOptions($path)
    {
        if($middlewares = self::getOption('middleware'))
        {
            self::addMiddleware($path, $middlewares);
        }
    }

    /**
     * @param array $middlewares
     * @return Route
    */
    public function middleware(array $middlewares)
    {
        self::addMiddleware(
            self::$currentRoute['path'],
            $middlewares
        );
        return $this;
    }

    /**
     * @param string $path
     * @param array $middlewares
    */
    private static function addMiddleware(string $path, array $middlewares)
    {
         self::$middlewares[$path] = $middlewares;
    }


    /**
     * Get all route middlewares
     * @return mixed
    */
    public static function middlewares()
    {
        return self::$middlewares;
    }


    /**
     * @param $name
     * @return Route
     * @throws RouteException
    */
    public function name($name)
    {
        self::addName($name,
            self::$currentRoute['path']
        );

        return $this;
    }


    /**
     * Set regular expression requirement on the route
     * @param $name
     * @param null $expression
     * @return Route
     *
     * Example:
     *  $this->where('id', '[0-9]+')
     *  $this->where([
     *   'id', '[0-9]+',
     *   'slug' => '[a-z\-0-9]+',
     *   'argument' => '([a-z\-0-9]+)',
     * ])
     * @throws RouteException
    */
    public function where($name, $expression = null)
    {
       foreach ($this->parseWhere($name, $expression) as $name => $expression)
       {
            if(isset(self::$patterns[$name]))
            {
                throw new RouteException(
                    sprintf(
                        'This name (%s) already setted for expression (%s)',
                        $name, self::$patterns[$name]
                    )
                );
            }
            self::$patterns[$name] = $expression;
       }

        return $this;
    }


    /**
     * Determine parses
     * @param $name
     * @param $expression
     * @return array
    */
    private function parseWhere($name, $expression)
    {
        return \is_array($name) ? $name : [$name => $expression];
    }

    /**
     * @param $name
     * @param array $params
     * @return mixed
     */
    public static function generate($name, array $params = [])
    {
        $path = self::$namedRoutes[$name] ?? false;

        if($params)
        {
            foreach($params as $k => $v)
            {
                $path = preg_replace(["#{".$k."}#", "#:". $k ."#"], $v, $path);
            }
        }

        return '/'. trim($path, '/');
    }


    /**
     * @param $methods
     * @return array|false|string[]
    */
    private static function resolvedMethod($methods)
    {
        if(is_string($methods) && strpos($methods, '|') !== false)
        {
            return explode('|', $methods);
        }
        return (array) $methods;
    }

    /**
     * @param string $path
     * @return string
    */
    private static function resolvedPath(string $path)
    {
        if($prefix = self::getOption('prefix'))
        {
            $path = rtrim($prefix, '/') . '/'. ltrim($path, '/');
        }
        return $path;
    }


    /**
     * @param string|\Closure $target
     * @return mixed
    */
    private static function resolvedTarget($target)
    {
        if(is_string($target) && strpos($target, '@') !== false)
        {
            if($namespace = self::getOption('namespace'))
            {
                $target = $namespace .'\\' . $target;
            }

            list($controller, $action) = explode('@', $target);
            $target = compact('controller', 'action');

        }

        return $target;
    }


    /**
     * Get all setted patterns
     * @return array
    */
    public static function patterns()
    {
        return self::$patterns;
    }

    /**
     * @return array
    */
    public static function namedRoutes()
    {
        return self::$namedRoutes;
    }


    /**
     * @return array
    */
    public static function collections()
    {
        return self::$collections;
    }

    /**
     * Determine if has named route
     * @param $name
     * @return bool
    */
    public static function hasNamed($name)
    {
        return isset(self::$namedRoutes[$name]);
    }


    /**
     * Set name of route
     *
     * @param $name
     * @param $path
     * @throws RouteException
    */
    private static function addName($name, $path)
    {
        if($name)
        {
            if(self::hasNamed($name))
            {
                throw new RouteException(
                    sprintf('This name (%s) already taken', $name)
                );
            }
            self::$namedRoutes[$name] = $path;
        }
    }

    /**
     * @param array $options
    */
    public static function appends(array $options)
    {
        self::$options = $options;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function getOption(string $key)
    {
        return self::$options[$key] ?? null;
    }


    /**
     * @param string $key
     */
    private static function removeOption(string $key)
    {
        if(isset(self::$options[$key]))
        {
            unset(self::$options[$key]);
        }
    }

    /**
     * @return void
    */
    private static function remove()
    {
        self::$options = [];
    }
}