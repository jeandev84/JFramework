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

}