<?php
namespace App\Controllers\Admin;


use Jan\Component\Routing\Controller;


/**
 * Class BaseController
 * @package App\Controllers\Admin
*/
class BaseController extends Controller
{
     /** @var string  */
     protected $layout = 'admin';
}