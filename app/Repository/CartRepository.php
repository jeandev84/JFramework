<?php
namespace App\Repository;


use App\Entity\Cart;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\ORM\EntityRepository;



/**
 * Class CartRepository
 * @package App\Repository
*/
class CartRepository extends EntityRepository
{

    /**
     * BrandRepository constructor.
    */
   public function __construct(QueryManagerInterface $manager)
   {
       parent::__construct($manager, Cart::class);
   }

}



