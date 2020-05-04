<?php
namespace App\Controllers;


use App\Entity\User;
use App\Foo;
use App\Repository\UserRepository;
use Jan\Component\FileSystem\FileSystem;

/**
 * Class HomeController
 * @package App\Controllers
*/
class HomeController
{

     /**
      * HomeController constructor.
      * @param FileSystem $fileSystem
     */
     public function __construct(FileSystem $fileSystem)
     {
         $this->fileSystem = $fileSystem;
     }

     /**
      * action index
      * @param UserRepository $userRepository
     */
     public function index(UserRepository $userRepository)
     {
         dump($userRepository);
     }

     /**
      * action about
     */
     public function about()
     {
         echo __METHOD__.'<br>';
     }

     /**
      * action contact
     */
     public function contact()
     {
         echo __METHOD__.'<br>';
     }
}