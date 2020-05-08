<?php
namespace App\Controllers;


use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Exception;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;


/**
 * Class HomeController
 * @package App\Controllers
*/
class HomeController extends BaseController
{

    /**
     * action index
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(Request $request, CategoryRepository $categoryRepository): Response
    {
        /*
        if($category = $request->post('category'))
        {
            dd($category);
        }

        $categories = $categoryRepository->findAll();

        dd($categories);
        */

        return $this->render('home/index.php');
    }

}