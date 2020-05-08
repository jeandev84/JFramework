<?php
namespace App\Controllers\Admin;


use App\Controllers\BaseController;


/**
 * Class DashboardController
 * @package App\Controllers\Admin
*/
class DashboardController extends BaseController
{

     /**
      * Action index
     */
      public function index()
      {
          return $this->render('admin/dashboard/index.php');
      }
}