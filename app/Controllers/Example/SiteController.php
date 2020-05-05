<?php
namespace App\Controllers\Example;


use App\Controllers\BaseController;
use App\Repository\UserRepository;
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
    */
    public function index(UserRepository $userRepository): Response
    {
        /* $users = $userRepository->findAll(); */
        // $users = [];
//        $user = $userRepository->query('SELECT * FROM users WHERE id = :id', ['id' => 15])
//                               ->getFirstResult();
//        dump($user);

//        $userRepository->getManager()
//             ->execute("INSERT INTO users (name, email, password, address, role) VALUES ('brown23', 'brown23@site.com', 'secret123', 'street 345', 'user')");
//        $lastId = $userRepository->getManager()->lastId();
//        dump($lastId);

        $users = $userRepository->findAll();
        dump($users);

        return $this->render('site/home.php', compact('users', 'user'));
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