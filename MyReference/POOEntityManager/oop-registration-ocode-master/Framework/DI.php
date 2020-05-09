<?php 
namespace Project;


class DI 
{

	  private $container = [];

      private $instance;


	  public function set($key, $value)
	  {
	  	  $this->container[$key] = $value;
	  }

	  public function get($key)
	  {
	  	 return $this->has($key);
	  }


	  public function has($key)
	  {
	  	 return isset($this->container[$key]) ? $this->container[$key] : null;
	  }


	  public function push($datas = [])
	  {
	  	   return array_merge($this->container, $datas);
	  }


	  public function singleton($key, $object)
	  {
	  	   if!isset(self::$instance[$key]))
	  	   {
	  	   	  self::$instance[$key] = $object;
	  	   }

	  	   return self::$instance[$key];
	  }
}