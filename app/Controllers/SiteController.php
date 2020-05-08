<?php
namespace App\Controllers;


use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use Jan\Component\Database\ORM\EntityManager;
use Jan\Component\Http\Response;


/**
 * Class SiteController
 * @package App\Controllers
*/
class SiteController extends BaseController
{

    /**
     * action index
     * @param UserRepository $userRepository
     * @return Response
     *
     * @throws Exception
    */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('site/home.php', compact('users'));
    }


    /**
     * Action about
     *
     * @throws Exception
    */
    public function about(): Response
    {
        return $this->render('site/about.php');
    }


    /**
     * Action contact
     * @return Response
     */
    public function contact()
    {
        return $this->render('site/contact.php');
    }

}