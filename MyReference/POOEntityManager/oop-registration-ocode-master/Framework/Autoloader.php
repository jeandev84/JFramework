<?php 
namespace Project;


class Autoloader 
{

	 private $data;

	 private static $instance;

	 private function __construct()
	 {
	 	 $this->data = require($this->buildPath('map.php'));
	 	 spl_autoload_register([$this, 'load']);

	 }

	 protected function load($classname)
	 {
	 	 $classname = $this->converter($this->data, $classname);
	     $path = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
	     $path .= ".php";
         
         $path = $this->buildPath($path);

	     if($path)
	     {
	     	 require_once(realpath($path));
	     }

	     return;
		// include_once sprintf("classes/%s.php", $classname);
	}

    private function buildPath($path = null)
    {
    	return realpath($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . trim($path, '/'));
    }


	protected function converter($data, $classname)
	{
	     foreach($data as $ns => $dir)
	     {
	         return str_replace(trim($ns, '\\'), $dir, $classname);
	     }
	}

	public function assign($namespace, $root)
	{
		 $this->data[$namespace] = $root;
	}

	public static function getInstance()
	{
        if(self::$instance === null)
        {
        	self::$instance = new self();
        }

        return self::$instance;
	}

	public function getData()
	{
	 	 dd($this->data);
	}
}

# (\Project\Autoloader::getInstance())->assign('App', 'app');
# (\Project\Autoloader::getInstance())->getData();

# LOAD ALL CLASSES
\Project\Autoloader::getInstance();