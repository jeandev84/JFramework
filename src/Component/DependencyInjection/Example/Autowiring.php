<?php

$container = new \Jan\Component\DependencyInjection\Container();

$container->singleton(\App\Entity\User::class, function () {
    return new App\Entity\User();
});

$container->bind('app.path', __DIR__.'/../');

$container->bind(\Jan\Component\FileSystem\FileSystem::class, function () use ($container){
    return new \Jan\Component\FileSystem\FileSystem($container->get('app.path'));
});



# Binds

/*
$container->bind('app.name', function () {
    return 'JFramework';
});

echo $container->get('app.name');


$container->bind('app.path', __DIR__.'/../');
echo $container->get('app.path');

$container->bind(\Jan\Component\FileSystem\FileSystem::class, function () use ($container){
   return new \Jan\Component\FileSystem\FileSystem($container->get('app.path'));
});

dump($container[\Jan\Component\FileSystem\FileSystem::class]);

$container['test'] = 'Something';
echo $container['test'];

# Share
$container->singleton(\App\Entity\User::class, function () {
    return new App\Entity\User();
});

dump($container->get(\App\Entity\User::class));

$container->get(Foo::class);
$container->get(\App\Singleton::class);
$container->instance(App\Singleton::class, \App\Singleton::instance());
dump($container->get(App\Singleton::class));
*/

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


// $container->get(\App\Bar::class);

dump($container->get(App\Controllers\HomeController::class, [
    'id' => 1,
    'slug' => 'salut-les-amis',
    3
]));