<?php
namespace App\Controllers\Api;

use Jan\Component\Routing\Controller;


/**
 * Class PostController
 * @package App\Controllers\Api
*/
class PostController extends Controller
{

      public function index()
      {
           $data = [
               'status' => 'OK',
               'data' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, nisi!'
           ];

           return $this->json($data);
      }
}