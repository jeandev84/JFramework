<?php

/*
|----------------------------------------------------------------------
|   Load classes and dependencies of application
|----------------------------------------------------------------------
*/


use App\Foo;

require_once realpath(__DIR__ .'/../vendor/autoload.php');


$container = new \Jan\Component\DependencyInjection\Container();

# Binds

$container->singleton(\App\Entity\User::class, function () {
    return new App\Entity\User();
});

$container->bind('app.path', __DIR__.'/../');

$container->bind(\Jan\Component\FileSystem\FileSystem::class, function () use ($container){
    return new \Jan\Component\FileSystem\FileSystem($container->get('app.path'));
});


// $container->get(\App\Bar::class);

dump($container->get(App\Controllers\HomeController::class, [
    'id' => 1,
    'slug' => 'salut-les-amis',
    3
]));




# Container
dump($container);