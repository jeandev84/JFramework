<?php
namespace App\Controllers;


use App\Entity\User;
use App\Foo;
use App\Repository\UserRepository;
use Jan\Component\FileSystem\FileSystem;
use Jan\Component\Http\Response;

/**
 * Class HomeController
 * @package App\Controllers
*/
class HomeController extends BaseController
{

     /**
      * action index
      * @param UserRepository $userRepository
      * @return Response
     */
     public function index(UserRepository $userRepository): Response
     {
          return $this->render('index.php');
     }


     /**
      * Action about
      * @return Response
     */
     public function about(): Response
     {
         return $this->render('about.php');
     }


     /**
      * Action contact
      * @return Response
     */
     public function contact()
     {
         return $this->render('contact.php');
     }
}