<?php

/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/


require_once realpath(__DIR__ .'/../vendor/autoload.php');



$fileStorage = new \Jan\Component\FileSystem\FileStorage(__DIR__.'/../storage');
