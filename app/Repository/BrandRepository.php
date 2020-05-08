<?php
namespace App\Repository;


use App\Entity\Brand;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\ORM\EntityRepository;



/**
 * Class BrandRepository
 * @package App\Repository
*/
class BrandRepository extends EntityRepository
{

    /**
     * BrandRepository constructor.
    */
   public function __construct(QueryManagerInterface $manager)
   {
       parent::__construct($manager, Brand::class);
   }

}



