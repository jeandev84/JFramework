<?php
namespace App\Controllers;


use App\Entity\User;

/**
 * Class SiteController
 * @package App\Controllers
*/
class SiteController extends BaseController
{

      public function index()
      {
          return $this->render('site/index.php', []);
      }
}