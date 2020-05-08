<?php
namespace App\Repository;


use App\Entity\User;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\ORM\EntityRepository;


/**
 * Class UserRepository
 * @package App\Repository
*/
class UserRepository extends EntityRepository
{
    /**
     * UserRepository constructor.
     * @param QueryManagerInterface $manager
    */
    public function __construct(QueryManagerInterface $manager)
    {
        parent::__construct($manager, User::class);
    }
}