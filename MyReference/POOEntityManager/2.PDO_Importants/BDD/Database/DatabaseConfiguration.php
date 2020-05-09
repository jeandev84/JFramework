<?php 
namespace Framework\Database;


class DatabaseConfiguration 
{
        
        private $config;


	    public function __construct($config = [])
	    {
              if(!empty($config))
              {
              	  $this->config = $config;
              }
	    }

        public function set(array $config)
		{
			$this->config = $config;
			
			return $this;
		}
		
	    public function getItem(string $key)
	    {
	    	 return $this->config[$key];
	    }
}