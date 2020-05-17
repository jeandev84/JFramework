<?php
namespace App\Controllers;


use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;
use Jan\Component\Templating\Exceptions\ViewException;



/**
 * Class SiteController
 * @package App\Controllers
*/
class SiteController extends BaseController
{

    /**
     * action index
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     *
     * @throws ViewException
     */
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        if($request->isAjax())
        {
            print_r($users);
            exit;
        }

        // dd($users);
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
     * @throws ViewException
    */
    public function contact()
    {
        return $this->render('site/contact.php');
    }

    /**
     * @param UserRepository $userRepository
     * @return Response
    */
    public function send(UserRepository $userRepository): Response
    {
        $response = $this->container->get(ResponseInterface::class);

        if(! $users = $userRepository->findAll())
        {
            return $response->redirect('/contact');
        }
    }

}