<?php 
namespace Project;


abstract class Controller 
{
       public function model($model)
       {
       	     // echo $model;
       	    require_once realpath(ROOT . 'app/models/' . $model . '.php');
       	    $model = "app\models\\" . $model;
       	    return new $model();
       }


       public function view($view, $data = [])
       {
       	 // extract($data);
             require_once ROOT.'app/views/templates/header.php';
             require_once ROOT.'app/views/' . $view . '.php';
             require_once ROOT.'app/views/templates/footer.php';
       }

       public function error($code = '404')
       {
           require_once ROOT.'app/views/errors/' . $code . '.php';
       }
}