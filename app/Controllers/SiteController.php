<?php
namespace App\Controllers;


use App\Entity\User;
use App\Repository\UserRepository;
use Jan\Component\DependencyInjection\Container;
use Jan\Component\Http\Response;
use Jan\Component\Routing\Route;

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
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('site/home.php');
    }


    /**x`
     * Action about
     * @return Response
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