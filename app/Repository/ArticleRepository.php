<?php
namespace App\Repository;


/**
 * Class ArticleRepository
 * @package App\Repository
*/
class ArticleRepository
{

    /**
    * ArticleRepository constructor.
    */
    public function __construct()
    {
        // DO something
    }


    /**
     * @return array
     */
    public function getLasted()
    {
        return [
            'id' => 1,
            'title' => 'Article 1',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, facere.',
            'published_at' => '15-02-2020',
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
}