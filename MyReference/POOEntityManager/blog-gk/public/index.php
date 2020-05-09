<?php 
/**
 * http://blog.loc/
 * http://blog.loc/public/index.php
*/

# constantes
define('ROOT', dirname(__DIR__));

require ROOT . '/debug.php';
require ROOT . '/app/App.php';
App::load();


# URL [ blog.loc/index.php?p = controller_name.method ]
# get page
$page = isset($_GET['p']) ? $_GET['p'] : 'posts.index';


$page = explode('.', $page);

if($page[0] == 'admin')
{
	$controller = '\App\Controller\Admin\\'. ucfirst($page[1]) .'Controller';
	$action = $page[2];

}else{
    $controller = '\App\Controller\\'. ucfirst($page[0]) .'Controller';
    $action = $page[1];
}


$controller = new $controller;
$controller->{$action}();
