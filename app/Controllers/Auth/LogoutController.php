<?php
namespace App\Controllers\Auth;


use App\Controllers\BaseController;


/**
 * Class LogoutController
 * @package App\Controllers\Auth
*/
class LogoutController extends BaseController
{

     /**
      * Action index
     */
     public function index()
     {
         exit('Your are Log out!');
         // header('Location : '. route('app.home'));
     }
}