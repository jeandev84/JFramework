<?php
namespace App\Controllers;


use App\Repository\ArticleRepository;
use Jan\Component\Http\Request;



/**
 * Class ArticleController
 * @package App\Controllers
*/
class ArticleController extends BaseController
{

    // protected  $layout = 'admin';

    /**
     * action index
     * @param ArticleRepository $articleRepository
     */
    public function index(ArticleRepository $articleRepository)
    {
        // $this->layout = 'admin';

        $articles = $articleRepository->getLasted();

        $jsonBody = json_encode($articles);

        return $this->render('articles/index.php', compact('articles'));
        // return 'index';
    }

    /**
     * action about
     * @param Request $request
     * @return
    */
    public function show(Request $request, $slug, $id)
    {
         echo 'Slug article : '. $slug .' and ID : '. $id .'<br>';
         echo '<b>URI :</b> '. $request->getUri() .' <b>Method :</b> '. $request->getMethod() . ' ';
         return $this->render('articles/show.php');
    }
}