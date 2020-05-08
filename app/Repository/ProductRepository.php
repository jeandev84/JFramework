<?php
namespace App\Repository;


use App\Entity\Product;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\ORM\EntityRepository;



/**
 * Class ProductRepository
 * @package App\Repository
*/
class ProductRepository extends EntityRepository
{

    /**
     * BrandRepository constructor.
    */
   public function __construct(QueryManagerInterface $manager)
   {
       parent::__construct($manager, Product::class);
   }

}



