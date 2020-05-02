<?php
namespace App;


/**
 * Class Singleton
 * @package App
*/
class Singleton
{
    private static $instance;

    private function __construct()
    {
          return "I am Singleton::class";
    }

    /**
     * @return $this
    */
    public static function instance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }

        return self::$instance;
    }
}