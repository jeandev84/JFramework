<?php
namespace App\Controllers;


use App\Entity\User;
use Jan\Component\DependencyInjection\Container;
use Jan\Component\Routing\Route;

/**
 * Class SiteController
 * @package App\Controllers
*/
class SiteController extends BaseController
{

      /**
       * @return \Jan\Component\Http\Response
      */
      public function index()
      {
          //echo Route::generate('site');
          return $this->render('site/index.php', []);
      }
}