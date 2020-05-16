<?php
namespace App\Controllers;


use Jan\Component\DI\Contracts\ContainerInterface;
use Jan\Component\Routing\Controller;
use Jan\Services\Session\Session;


/**
 * Class BaseController
 * @package App\Controllers
*/
class BaseController extends Controller
{

     public function __construct(ContainerInterface $container)
     {
         parent::__construct($container);
         // start session here just for testing something
         Session::start();
     }
}