<?php 
namespace app\controllers;


class HomeController  extends AppController
{

    public function index($name = '')
	{
         $this->view('home/index');
	}

}

   

