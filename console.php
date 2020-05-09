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

$console = new \Jan\Component\Console\Console();

$console->addCommands(require __DIR__.'/config/command.php');

$console->handle(
    $input = new \Jan\Component\Console\Input\Input(),
    new \Jan\Component\Console\Output\Output()
);