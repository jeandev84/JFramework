<?php

return [

    /*
    |------------------------------------------------------------------
    |   Microtime
    |------------------------------------------------------------------
    */
    'microtime' => microtime(true),


    /*
    |------------------------------------------------------------------
    |   Application Name
    |------------------------------------------------------------------
    */

    'name' => env('APP_NAME', 'JFramework'),


    /*
    |------------------------------------------------------------------
    |   [ development: dev or production: prod ]
    |------------------------------------------------------------------
    */

    'mode' => env('APP_ENV', 'dev'),



    /*
    |------------------------------------------------------------------
    |   Application Debogger [set it true or false ]
    |------------------------------------------------------------------
    */

    'debug' => true, //true or false



    /*
    |------------------------------------------------------------------
    |   Application Timezone
    |------------------------------------------------------------------
    */

    'timezone' => 'UTC', // Asia/Yekaterinburg



    /*
    |------------------------------------------------------------------
    |   Current language of Application
    |   Availables languages russian, french, english
    |------------------------------------------------------------------
    */

    'language' => 'ru', // ru, fr, en


    /*
    |------------------------------------------------------------------
    |   Application base URL
    |   Set base_url to false if you don't need it
    |   If base_url is false we'll not used base url
    |    But if base_url contain value it's will be base url
    |   like this : http://project.loc/ [ http://project.loc/css/app.css ]
    |   But if you assign value like '/' so it'll be base url [ /css/app.css ]
    |------------------------------------------------------------------
    */

    'base_url' => '', // false


    /*
    |------------------------------------------------------------------
    |  Add alias
    |------------------------------------------------------------------
    */

    'alias' => [
        // 'Test' => 'app\\controllers\\Test',
        // 'Form' => 'app\\library\\Bootstrap'
    ],

    /*
    |------------------------------------------------------------------
    |  Add services providers
    |------------------------------------------------------------------
    */

    'providers' => [
      // example: \App\Providers\FileSystemServiceProvider::class
    ]


];