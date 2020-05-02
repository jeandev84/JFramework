<?php
namespace App\Controllers;


use App\Entity\User;
use App\Foo;
use Jan\Component\FileSystem\FileSystem;

/**
 * Class HomeController
 * @package App\Controllers
*/
class HomeController
{

     /** @var FileSystem  */
     protected $fileSystem;


     /** @var User */
     protected $user;


     /**
      * HomeController constructor.
      * @param FileSystem $fileSystem
      * @param User $user
      * @param null $id
     */
     public function __construct(FileSystem $fileSystem, User $user, $id, $slug, $test)
     {
         $this->fileSystem = $fileSystem;
         $this->user = $user;

         echo __METHOD__."<br>";
     }

    /**
      * action index
     */
     public function index()
     {
         echo __METHOD__.'<br>';
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