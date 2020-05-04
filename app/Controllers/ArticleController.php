<?php
namespace App\Controllers;


use App\Repository\ArticleRepository;
use Jan\Component\Http\Request;

/**
 * Class ArticleController
 * @package App\Controllers
*/
class ArticleController
{


    /**
     * ArticleController constructor.
    */
    public function __construct(ArticleRepository $articleRepository)
    {
        echo "Article::run <br>";
        $this->articleRepository = $articleRepository;
    }

    /**
     * action index
     * @param ArticleRepository $userRepository
     */
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->getLasted();

        return json_encode($articles);
        // return 'index';
    }

    /**
     * action about
     * @param Request $request
    */
    public function show(Request $request)
    {
         //
    }

    /**
     * action contact
     */
    public function contact()
    {
        echo __METHOD__.'<br>';
    }
}