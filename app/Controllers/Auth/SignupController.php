<?php
namespace App\Controllers\Auth;



use App\Controllers\BaseController;

/**
 * Class SignupController
 * @package App\Controllers\Auth
 */
class SignupController extends BaseController
{

    /**
     * @return \Jan\Component\Http\Response
    */
    public function index()
    {
        return $this->render('auth/signup.php');
    }

}