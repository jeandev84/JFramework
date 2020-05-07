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
     * password_hash('secret123', PASSWORD_BCRYPT)
     * @throws Exception
    */
    public function index(UserRepository $userRepository): Response
    {
        // dump($userRepository->findAll());
        // dump(User::findAll());

        return $this->render('site/home.php', compact('users'));
    }


    /**x`
     * Action about
     * @param EntityManager $entityManager
     * @return Response
     * @throws Exception
    */
    public function about(EntityManager $entityManager, UserRepository $repository): Response
    {
        $user = $repository->find(['id' => 10]);
        $user->setName('expert10-updated!')
            ->setEmail('expert10-updated@web.com');

        $entityManager->persist($user);
        $entityManager->flush();

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


    /**
     * @param EntityManager $entityManager
     * @param UserRepository $repository
     * @return Response
     * @throws \ReflectionException
     */
    public function createOrUpdateUser(EntityManager $entityManager, UserRepository $repository): Response
    {

        //CREATE :
        for($i = 1; $i <= 10; $i++)
        {
            $user = new User();
            $user
                ->setName('expert'. $i)
                ->setEmail('expert'. $i .'@site.com')
                ->setPassword(password_hash('secret123', PASSWORD_BCRYPT))
                ->setAddress('Moscou , golovinskoe dom 8 2a')
                ->setRole('expert-' . $i);

            $entityManager->persist($user);
        }

        $entityManager->flush();

        return $this->render('site/about.php');

    }


    /**
     * @param EntityManager $entityManager
     * @param UserRepository $repository
     * @return Response
     * @throws \ReflectionException
    */
    public function updateUser(EntityManager $entityManager, UserRepository $repository): Response
    {
        $user = $repository->find(['id' => 10]);
        $user->setName('expert10-updated!')
             ->setEmail('expert10-updated@web.com');

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('site/about.php');

    }


    /**
     * @param UserRepository $userRepository
     * @return Response
     * @throws \ReflectionException
   */
    public function getUser(UserRepository $userRepository): Response
    {
        $users = $userRepository->find(['name' => 'brown1', 'address' => 'street 345']);

        if(! $users)
        {
            throw new Exception('No user setted!', 400);
        }

        $users = $userRepository->find(['name' => 'brown1', 'address' => 'street 345']);
        dump($users);

        $users = $userRepository->findAll();
        dump($users);

         $userRepository->delete(23);
         dump($users);

         return $this->render('site/home.php', compact('users'));
    }

}