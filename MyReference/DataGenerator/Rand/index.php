<?php 

require_once 'autoload.php';


include_once('functions/rand.php');

//20 is the amount of random characters to be generated
echo randStrGen(20); 
//Or
$random = randStrGen(35);
echo $random;