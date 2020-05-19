<?php
namespace App\Fixtures;


use App\Models\Book;
use Jan\Component\Database\Contracts\EntityManagerInterface;



/**
 * Class BookSeeder
 * @package App\Fixtures
*/
class BookSeeder
{


    /** @var EntityManagerInterface  */
    private $entityManager;



    /**
     * UserSeeder constructor.
     * @param EntityManagerInterface $entityManager
    */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * Load data fixtures
    */
    public function load()
    {
        for ($i = 1; $i <= 5; $i++)
        {
        }
    }
}