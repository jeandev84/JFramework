<?php 

// $GLOBALS['config'] = [];

return [
  'mysql' => [
     'host' => '127.0.0.1',
     'username' => 'root',
     'password' => '',
     'db' => 'your-database-name', //'oopregistration',
     // 'charset' => 'utf8',
     // 'port' => 3306,
     'options' => [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
     ]
  ],
  'remember' => [
      'cookie_name' => 'hash',
      'cookie_expiry' => 604800
  ],
  'session' => [
      'session_name' => 'user',
      'token_name'   => 'token' , // _csrf
  ],
  'hash' => [
     'salt' =>  md5('QwYhswY&HyuijWOpbTgdz$YpsgbrvckUl'),
     // 'QwYhswY&HyuijWOpbTgdz$YpsgbrvckUl',
     //'secret_pass' => 'qwertyuiop084'
  ]
];


use Project\Cookie;
use Project\Config; 
use Project\Session; 
use Project\DB;
use app\models\User;



if(Cookie::exists(Config::get('remember/cookie_name')) 
  && !Session::exists(Config::get('session/session_name')))
{
   
   // echo 'User asked to be remembered';

   $hash = Cookie::get(Config::get('remember/cookie_name'));
   $hashCheck = DB::getInstance()->get('users_session', ['hash', '=', $hash]);

     // dump($hashCheck->count());
     
   if($hashCheck->count())
   {
       // echo 'Hash matches, log user in.';
       $user = new User($hashCheck->first()->user_id);
       $user->login();
   }
}
