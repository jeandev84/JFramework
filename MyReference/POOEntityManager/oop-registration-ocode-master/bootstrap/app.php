<?php 

session_start();


# INCLUDES FILES
require_once realpath(__DIR__ . '/../app/functions/debug.php');
require_once realpath(__DIR__ . '/../app/config/define.php');
// require_once realpath(__DIR__.'/../app/config/config.php');
require_once realpath(__DIR__ . '/../app/functions/sanitize.php');
require_once realpath(__DIR__.'/../vendor/autoload.php');


# ERROR REPORTING 
(DEBUG) ? error_reporting(-1) : error_reporting(0);


# ADD ALIAS
class_alias('\\Project\\Route', 'Route');
class_alias('\\Project\\Config', 'Config');
class_alias('\\Project\\Input', 'Input');
class_alias('\\Project\\Token', 'Token');
class_alias('\\Project\\Session', 'Session');
class_alias('\\Project\\Cookie', 'Cookie');


# ADD FILE FOR ROUTES
# require_once realpath(__DIR__.'/../routes/app.php');


/**
spl_autoload_register(function($class){
   require_once 'classes/'. $class .'.php';
});
**/


