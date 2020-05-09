<?php

return array(
    // настройки миграций
    'migrations' => array(
        'default' => array(
            
            // имя соединения с database.php
            'connection' => 'default',
            
            // путь в котором хранятся миграции, относительно папки /assets/migrate/
            'path'       => 'migrations',

            // не обязательно:
            
            // имя таблицы в которой хранить миграции
            'migrationTable' => '__migrate',

            // имя поля в таблице миграций
            'lastMigrationField' => 'lastMigration'
        )
    ),

    // настройки сидирования (об этом позже)
    'seeds' => array(
        'default' => array(
            
            // имя соединения с database.php
            'connection' => 'default',
            
            // путь в котором хранятся сиды, относительно папки /assets/migrate/
            'path' => 'seeds'
        )
    )
);