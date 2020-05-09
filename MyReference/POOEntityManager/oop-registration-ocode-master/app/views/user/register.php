<h1>Register</h1>

<?= isset($data['error']) ? $data['error'] : ''; ?>
<? // isset($data['success']) ? $data['success'] : ''; ?>

<form action="" method="POST">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?= escape(Input::get('username')); ?>" autocomplete="off">
	</div>
	<div class="field">
		 <label for="password">Choose a password</label>
		 <input type="password" name="password" id="password" value="<?= Input::get('password') ?>">
	</div>
	<div class="field">
		 <label for="password">Enter your password again</label>
		 <input type="password" name="password_again" id="password" value="<?= Input::get('password_again') ?>">
	</div>
	<div class="field">
		 <label for="name">Your name</label>
		 <input type="text" name="name" id="name" value="<?= escape(Input::get('name')); ?>">
	</div>
    <!-- _csrf Token -->
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
	<input type="submit" value="Register">
</form>