<?php 

$slice = new \PHPixie\Slice();
$database = new \PHPixie\Database($slice->arrayData(array(
    'default' => array(
        'database' => 'phpixie',
        'user'     => 'phpixie',
        'password' => 'phpixie',
        'adapter'  => 'mysql', // one of: mysql, pgsql, sqlite
        'driver'   => 'pdo'
    )
)));

$filesystem = new \PHPixie\Filesystem();
$migrate = new \PHPixie\Migrate(
    $filesystem->root(__DIR__.'/assets/migrate'),
    $database,
    $slice->arrayData(array(
    'migrations' => array(
        'default' => array(
            'connection' => 'default',
            'path'       => 'migrations',
        )
    ),
    'seeds' => array(
        'default' => array(
            'connection' => 'default',
            'path' => 'seeds'
        )
    )
)));

$cli = new \PHPixie\CLI();
$console = new \PHPixie\Console($slice, $cli, $migrate->consoleCommands());
$console->runCommand();