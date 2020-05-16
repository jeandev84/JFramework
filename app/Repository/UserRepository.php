<?php
namespace App\Repository;


use App\Entity\User;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\ORM\EntityRepository;


/**
 * Class UserRepository
 * @package App\Repository
*/
class UserRepository extends EntityRepository
{

    /**
     * UserRepository constructor.
     * @param ManagerInterface $manager
    */
    public function __construct(ManagerInterface $manager)
    {
        parent::__construct($manager, User::class);
    }
}