<?php
/*
|----------------------------------------------------------------------
|   Stimulate Server Internal
|   Run command : php -S localhost:<port[ex : 8000 ]> -t public -d display_errors=1 server.php
|   Test application in your browser
|----------------------------------------------------------------------
*/

require_once __DIR__.'/vendor/autoload.php';

$server = new \Jan\Foundation\Server(__DIR__.'/public/index.php');
$server->run($_SERVER['REQUEST_URI']);

