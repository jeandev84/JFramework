<?php
namespace App\Repository;


use App\Entity\User;
use Jan\Component\Database\Contracts\QueryInterface;
use Jan\Component\Database\ORM\EntityRepository;


/**
 * Class UserRepository
 * @package App\Repository
*/
class UserRepository extends EntityRepository
{

    /**
     * UserRepository constructor.
     * @param QueryInterface $manager
     * @throws \ReflectionException
    */
    public function __construct(QueryInterface $manager)
    {
        parent::__construct($manager, User::class);
    }
}