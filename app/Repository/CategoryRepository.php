<?php
namespace App\Repository;


use App\Entity\Category;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\ORM\EntityRepository;



/**
 * Class CategoryRepository
 * @package App\Repository
*/
class CategoryRepository extends EntityRepository
{

    /** @var string  */
    protected $table = 'categories';


    /** @var bool  */
    protected $softDelete = false;


    /**
     * CategoryRepository constructor.
    */
    public function __construct(QueryManagerInterface $manager)
    {
       parent::__construct($manager, Category::class);
   }

}



