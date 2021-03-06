<?php
namespace App\Controllers;



use App\Repository\ArticleRepository;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;



/**
 * Class ArticleController
 * @package App\Controllers
*/
class ArticleController extends BaseController
{

    // protected  $layout = false;

    /**
     * action index
     * @param ArticleRepository $articleRepository
     * @return Response
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
         /*
         echo 'Slug article : '. $slug .' and ID : '. $id .'<br>';
         echo '<b>URI :</b> '. $request->getUri() .' <b>Method :</b> '. $request->getMethod() . ' ';
         */
         return $this->render('articles/show.php', compact('slug', 'id'));
    }


    /**
     * @param int $id [example id = 3]
     * @return Response
    */
    public function edit(int $id = 3)
    {
        /*
        echo Route::generate('article.edit', ['id' => $id]);
        echo '<br>';
        echo 'Article number : ' . $id .'<br>';
        return new Response('Articles edit test', 200, []);
        */
        return $this->render('articles/edit.php', compact('id'));
    }
}