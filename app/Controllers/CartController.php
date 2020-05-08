<?php
namespace App\Controllers;


/**
 * Class CartController
 * @package App\Controllers
*/
class CartController extends BaseController
{

      /**
       * @return \Jan\Component\Http\Response
      */
      public function index()
      {
          return $this->render('cart/index.php');
      }
}