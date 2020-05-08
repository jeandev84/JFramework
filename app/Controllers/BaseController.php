<?php
namespace App\Controllers;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Routing\Controller;


/**
 * Class BaseController
 * @package App\Controllers
*/
class BaseController extends Controller
{

     /**
      * @var QueryManagerInterface
     */
     protected $manager;


     /**
      * BaseController constructor.
      * @param QueryManagerInterface $manager
     */
     public function __construct(QueryManagerInterface $manager)
     {
          parent::__construct();
          $this->manager = $manager; /* execute(), getConnection() */
     }

     /**
      * @param array $data
      * @return \Jan\Component\Http\Response
     */
     protected function json($data = [])
     {
         // add the headers Content-Type : application/json
         // bad pratice header logic will be removed to Middleware
         header('Content-Type : application/json');
         return $this->render(json_encode($data));
     }
}