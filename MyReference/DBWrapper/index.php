<?php 

require_once 'DB.php';

function dnd($arr, $type=false, $die=false)
{
   echo '<pre>';
   if($type) print_r($arr);
   else var_dump($arr);
   echo '</pre>'; 
   if($die) die();
}

$db = DB::get_instance();

?>
<html>
<head>
  <title>Contacts</title>
</head>
<body style="margin-top:50px;">
<?php 

$contact = $db->findFirst('contacts', ['conditions' => ['lname = ?','fname = ?'], 'bind' => ['Yao', 'Michelle J.K']]);

// dnd($contacts);

echo $contact->fname .' | '. $contact->lname .' | ' . $contact->email;

?>
</body>
</html>
