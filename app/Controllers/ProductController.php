<?php
namespace App\Controllers;


/**
 * Class ProductController
 * @package App\Controllers
*/
class ProductController extends BaseController
{

    /**
     * @return \Jan\Component\Http\Response
     */
    public function index()
    {
        return $this->render('product/index.php');
    }
}