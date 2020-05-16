<?php
namespace Jan\Services\Session;


/**
 * Class Session
 * @package App\Services\Session
*/
class Session
{

    /**
     * start session
    */
    public static function start()
    {
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }


    /**
     * @param $key
     * @param $value
    */
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    /**
     * @param $key
     * @return bool
    */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }


    /**
     * @param $key
     * @return mixed|null
    */
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }


    /**
     * @param $key
    */
    public static function remove($key)
    {
        if(self::has($key))
        {
            unset($_SESSION[$key]);
        }
    }


    /**
     * @return array
    */
    public static function all()
    {
        return $_SESSION ?? [];
    }


    /**
     * Remove all session data
    */
    public static function clear()
    {
        if(! empty($_SESSION))
        {
            session_destroy();
        }
    }
}