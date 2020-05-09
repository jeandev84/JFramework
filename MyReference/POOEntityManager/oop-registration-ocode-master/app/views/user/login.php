<h1>Login</h1>


<?= isset($data['error']) ? $data['error'] : ''; ?>
<? // isset($data['success']) ? $data['success'] : ''; ?>

<form action="" method="POST">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?= escape(Input::get('username')); ?>" autocomplete="off">
	</div>
	<div class="field">
		 <label for="password">Password</label>
		 <input type="password" name="password" id="password" value="<?= Input::get('password') ?>">
	</div>

	<div class="field">
		 <label for="remember">
 	 		 <input type="checkbox" name="remember" id="remember"> Remember me 
		 </label>
	</div>

    <!-- _csrf Token -->
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
	<input type="submit" value="Login">
</form>
