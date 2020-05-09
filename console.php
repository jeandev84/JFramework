#!/usr/bin/env php
<?php


require(__DIR__.'/vendor/autoload.php');
$app = require(__DIR__.'/bootstrap/app.php');


/*
|------------------------------------------------------------------
|   Framework console
|   Ex: $ php console --help or --h
|   Ex: $ php console make:controller HomeController
|   Ex: $ php console make:model User
|   Ex: $ php console server
|------------------------------------------------------------------
*/



# Console
$console = new \Jan\Component\Console\Console();

$commands = require __DIR__.'/config/command.php';

$resolved = [];
foreach ($commands as $commandClass)
{
    $resolved[] = $app->make($commandClass);
}

$console->addCommands($resolved);

$status = $console->handle(
    $input = new \Jan\Component\Console\Input\Type\ArgvInput(),
    new \Jan\Component\Console\Output\Output()
);

exit($status);