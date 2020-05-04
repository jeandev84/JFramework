<?php
namespace App\Controllers\Auth;


use App\Controllers\BaseController;
use Jan\Component\Http\Response;


/**
 * Class RegisterController
 * @package App\Controllers\Auth
*/
class RegisterController extends BaseController
{

     /**
      * @return Response
     */
     public function index()
     {
         return $this->render('auth/register.php');
     }
}