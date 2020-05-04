<?php
namespace App\Controllers\Auth;


use App\Controllers\BaseController;


/**
 * Class LoginController
 * @package App\Controllers\Auth
 */
class LoginController extends BaseController
{

     /**
      * @return \Jan\Component\Http\Response
     */
     public function index()
     {
         return $this->render('auth/login.php');
     }
}