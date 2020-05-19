<?php
namespace App\Controllers;


use Jan\Component\Database\ORM\EntityManager;
use Jan\Component\DI\Contracts\ContainerInterface;
use Jan\Component\Routing\Controller;
use Jan\Services\Session\Session;



/**
 * Class BaseController
 * @package App\Controllers
*/
class BaseController extends Controller
{

     /** @var EntityManager */
     protected $entityManager;


     public function __construct(ContainerInterface $container, EntityManager $entityManager)
     {
         parent::__construct($container);
         # Start session here just for testing something
         Session::start();
         $this->entityManager = $entityManager;
     }
}