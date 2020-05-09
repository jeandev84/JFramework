<?php 

function loader($class)
{
	require_once('libs/'. $class.'.php');
}

spl_autoload_register('loader');