
 <h1>Welcome</h1>

 <?php if(Session::exists('home')): ?>
   <ul class="success">
       <li><?= Session::flash('home') ?></li>
   </ul>
<?php endif; ?>
<?php 
$user = new \app\models\User();

if($user->isLoggedIn())
{

?>
  <p>Hello <a href="/user/profile?user=<?= escape($user->data()->username); ?>" 
              style="color:green;font-size: 17px;"
              title="Go to your profile ?..">
  	  <?= ucfirst(escape($user->data()->username)); ?></a>
  </p>

  <ul>
  	<li style="padding: 4px 0;"><a href="/user/logout">Logout</a></li>
  </ul>
<?php

  if($user->hasPermission('admin')) // $user->hasPermission('moderator')
  {
      echo '<p>You are an administrator</p>';
      // echo '<p>You are an Moderator</p>';
  }

}else {

  echo '<p>You need to <a href="/user/login">login</a> or <a href="/user/register">register</a></p>';
}
