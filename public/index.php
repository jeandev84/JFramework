<?php

/*
|----------------------------------------------------------------------
|   Load classes and dependencies of application
|----------------------------------------------------------------------
*/


require_once realpath(__DIR__ .'/../vendor/autoload.php');


$container = new \Jan\Component\DependencyInjection\Container();

# Binds

$container->bind('app.name', function () {
    return 'JFramework';
});

$container->bind('app.path', __DIR__.'/../');
$container->bind(\Jan\Component\FileSystem\FileSystem::class, function () {
   new \Jan\Component\FileSystem\FileSystem(__DIR__.'/../');
});



# Share
$container->share('user', function () {
    new App\Entity\User();
});

# Container
dump($container);