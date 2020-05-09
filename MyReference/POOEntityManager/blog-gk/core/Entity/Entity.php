<?php 
namespace Core\Entity;


class Entity
{

       /**
        * $key = url / extrait ...
        * $method = getURL() / getExtrait()
        * Cette fonction va appeler systematiquement 
        * les methodes getURL() et getExtrait()
       */
  	   public function __get($key)
  	   {
  	   	   $method = 'get' . ucfirst($key);
  	   	   $this->{$key} = $this->{$method}();
           return $this->{$key};
  	   }
}