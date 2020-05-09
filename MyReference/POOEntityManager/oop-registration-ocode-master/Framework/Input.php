<?php 
namespace Project;


class Input 
{
	  
	   public static function exists($type = 'post')
	   {
		   	  switch($type)
		   	  {
		   	  	  case 'post';
		   	  	     return (!empty($_POST)) ? true : false;
		   	  	  break;
		   	  	  case 'get';
		   	  	    return (!empty($_GET)) ? true : false;
		   	  	  break;
		   	  	  default:
		   	  	   return false;
		   	  	  break;
		   	  }
	   }


	   public static function get($item)
	   {
	   	     if(isset($_POST[$item]))
	   	     {
	   	     	return $_POST[$item];

	   	     }else if(isset($_GET[$item])){
 
                return $_GET[$item];
	   	     }

	   	     return '';
	   }

       
       /**
	   public static function group($item, $array = [])
	   {
           $array = array_merge($array, [$_POST, $_GET, $_COOKIE, $_FILES, $_SERVER]);
           
           return isset($array[$item]) ? $array[$item] : null;
	   } 
	   **/
}