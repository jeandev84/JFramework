<?php 


function dd($arr, $die = false)
{
	echo '<pre style="font-size:17px;color:#84a;">';
        print_r($arr);
        echo '</pre>'; 
        if($die) die;
}


function dump($arr, $die = false)
{
	echo '<pre style="font-size:17px;color:#84a;">';
        var_dump($arr);
        echo '</pre>'; 
        if($die) die;
}