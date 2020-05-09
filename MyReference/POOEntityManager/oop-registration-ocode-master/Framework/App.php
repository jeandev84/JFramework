<?php 
namespace Project;


class App 
{
	
      protected $controller = DEFAULT_CONTROLLER;
      protected $method = 'index';
      protected $params = [];

	  public function __construct()
	  {
             // dd($this->parseUrl());

	  	     $url = $this->parseUrl();
	  	     $default = (DEFAULT_CONTROLLER) ? DEFAULT_CONTROLLER : 'home';

	  	     $url[0] = isset($url[0]) ? $url[0] : $default;
	  	     
             $this->controller = 'app\\controllers\\' . ucfirst($url[0]) .'Controller';

	  	     if(class_exists($this->controller))
	  	     {   
	  	             $this->controller = new $this->controller;
                     unset($url[0]);

	  	     }


	         if(isset($url[1]))
	  	     {
	  	     	  if(method_exists($this->controller, $url[1]))
	  	     	  {
	  	     	  	  // echo 'OK';
	  	     	  	  $this->method = ($url[1]) ? $url[1] : 'index';
                      unset($url[1]);
	  	     	  }
	  	     }


	  	     $this->params = $url ? array_values($url) : [];
                      
             // dd($this->params);

     	  	 call_user_func_array([$this->controller, $this->method], $this->params);
	  	   
	  }


	  public function parseUrl()
	  {
	  	    if(isset($_GET['url']))
	  	    {
	  	    	  return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
	  	    }
	  }
}