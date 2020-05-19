<?php
namespace App\Fixtures;


use App\Entity\Post;
use App\Entity\User;
use App\Services\EncoderPassword;
use Jan\Component\Database\Contracts\EntityManagerInterface;



/**
 * Class AppSeeder
 * @package App\Fixtures
*/
class AppSeeder
{


    /** @var EntityManagerInterface  */
    private $entityManager;


    /** @var EncoderPassword  */
    private $encoder;



    /**
     * UserSeeder constructor.
     * @param EntityManagerInterface $entityManager
     * @param EncoderPassword $encoder
    */
    public function __construct(EntityManagerInterface $entityManager, EncoderPassword $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
    }


    /**
     * Load data fixtures
    */
    public function load()
    {
        for ($i = 1; $i <= 5; $i++)
        {
            $user = new User();
            $name = 'user'. $i;
            $user->setName($name)
                 ->setEmail($name.'@gmail.com')
                 ->setAddress('Kurgan, ulitsa volodarskovo dom '. $i)
                 ->setPassword($this->encoder->encode($name));


            $this->entityManager->persist($user);

            $post = new Post();
            $post->setTitle('post-'. $i)
                 ->setBody('lorem ipsum some content from post -'. $i);

            $this->entityManager->persist($post);
        }

        $this->entityManager->flush();

    }
}