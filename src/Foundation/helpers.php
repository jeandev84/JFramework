<?php


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
    */
    function route($name, $params = [])
    {
         //
    }
}