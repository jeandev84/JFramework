<?php
namespace App\Controllers;


use App\Repository\UserRepository;
use Exception;
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
     * password_hash('secret123', PASSWORD_BCRYPT)
     * @throws Exception
    */
    public function index(UserRepository $userRepository): Response
    {
        /*
        $users = $userRepository->find(['name' => 'brown1', 'address' => 'street 345']);

        if(! $users)
        {
            throw new Exception('No user setted!', 400);
        }

        */
        $users = $userRepository->findAll();
        dump($users);

        $userRepository->delete(23);
        dump($users);

        return $this->render('site/home.php', compact('users'));
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