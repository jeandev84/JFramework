<?php
namespace Jan\Utils;


/**
 * Class Str
 * @package Jan\Utils
*/
class Str
{

    /**
     * Sanitize input data
     * @param string $input
     * @return
    */
    public static function sanitize($input)
    {
        return htmlentities($input, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Hide password
     *
     * @param string $password
     * @return string
    */
    public static function hidePassword(string $password)
    {
        $passLength = strlen($password);
        return sprintf("%'*-${passLength}s",false);
    }


    /**
     * @param $string
     * @return string
    */
    public static function toAsterisks($string)
    {
        return str_repeat("*", strlen($string));
    }

}