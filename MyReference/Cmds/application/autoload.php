<?php 

function loader($class)
{
	// echo ($class);
	require_once('classes/'. $class.'.php');
}

spl_autoload_register('loader');