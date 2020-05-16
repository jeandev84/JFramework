<?php
namespace Jan\Foundation;


/**
 * Class Server
 * @package Jan\Foundation
*/
class Server
{


     /** @var string */
     private $script;



     /**
      * Server constructor.
      * @param string $script [ ex: script file ./basePath/public/index.php ]
     */
     public function __construct(string $script)
     {
           $this->script = rtrim($script, '/');
           $_SERVER['SCRIPT_NAME'] = '/index.php';
     }


     /**
      * @param string $uri
      * @return bool
     */
     public function run(string $uri)
     {
         $url = parse_url($uri, PHP_URL_PATH);

         if(strpos($url, '/') === false)
         {
             $url .= '/';
         }

         $directory = dirname($this->script);

         if ($url !== '/' && file_exists($directory.$url))
         {
             return false;
         }

         require_once realpath($this->script);
     }
}

/*
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($url !== '/' && file_exists(__DIR__.'/public'.$url)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require_once realpath(__DIR__.'/public/index.php');
*/