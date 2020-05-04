<?php

use Jan\Component\DependencyInjection\Container;


if(! function_exists('app'))
{

     /**
      * @param null $abstract
      * @param array $parameters
      * @return object
      * @throws ReflectionException
     */
     function app($abstract = null, array $parameters = [])
     {
//         if(is_null($abstract))
//         {
//             return Container::getInstance();
//         }
//         return Container::getInstance()->make($abstract, $parameters);
     }
}


if(! function_exists('base_path'))
{
    /**
     * Base Path
     * @param string $path
     * @return string
     */
    function base_path($path = '')
    {
        return __DIR__.'/..//'. ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}




if(! function_exists('env'))
{
    /**
     * Get item from environement or default value
     *
     * @param $key
     * @param null $default
     * @return array|bool|false|string|null
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if($value === false)
        {
            return $default;
        }

        switch (strtolower($value))
        {
            case $value === 'true';
                return true;
            case $value === 'false';
                return false;
            default:
                return $value;
        }
    }
}


if(! function_exists('route'))
{
    /**
     * @param $name
     * @param array $params
     * @return bool|mixed
    */
    function route($name, $params = [])
    {
         // base_url(). Route::generate($name, $params);
         return \Jan\Component\Routing\Route::generate($name, $params);
    }
}


if(! function_exists('asset'))
{
    /**
     * @param $name
     * @param array $params
     * @return bool|mixed
     */
    function asset($path)
    {
        // for moment
        return "/$path";
    }
}



if(! function_exists('view'))
{
    /**
     * @param string $path
     * @param array $data
     * @return bool|mixed
     */
    function view(string $path, array $data = [])
    {
        // View(__DIR__.'/templates/views/');
    }
}



if(! function_exists('response'))
{
    /**
     * @param null $content
     * @param int $status
     * @param array $headers
     * @return bool|mixed
     */
    function response($content = null, $status = 200, array $headers = [])
    {
         //
    }
}


if(! function_exists('redirect'))
{
    /**
     * @param null $http
     * @return bool|mixed
     */
    function redirect($http = null)
    {
         //
    }
}


