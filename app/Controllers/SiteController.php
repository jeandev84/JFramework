<?php
namespace App\Controllers;


use App\Entity\User;
use App\Entity\Post;
use App\Models\Book;
use App\Repository\UserRepository;
use App\Services\EncoderPassword;
use Exception;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;
use Jan\Component\Templating\Exceptions\ViewException;
use Jan\Foundation\Database;
use JanKlod\Database\DB;


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
        /* $users = $userRepository->findAll(); */

        $users = [];
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
     * @param EncoderPassword $encoder
     * @return Response
     * @throws ViewException
    */
    public function about(EncoderPassword $encoder): Response
    {
        // dump(Database::instance());
        // dd(Book::where('id = :id', ['id' => 2])->get());
        // dd(Book::where('id = ?', 2)->get());
        // dd(new Book());
        /*
        $book = new Book();
        //$book->id = 7;
        $book->name = 'AwesomeBook';
        $book->cost = '124';
        $book->description = 'some description book jc';

        $book->save();

        echo $book->id; Last inserted ID
        */

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
     * @throws \ReflectionException
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