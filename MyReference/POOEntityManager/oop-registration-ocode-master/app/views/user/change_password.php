
<h1>Change Password</h1>

<?= isset($data['error']) ? $data['error'] : ''; ?>

<form action="" method="POST">
	<div class="field">
		 <label for="password_current">Current password</label>
		 <input type="password" name="password_current" id="password_current" value="<?= Input::get('password_current') ?>">
	</div>
	<div class="field">
		 <label for="password_new">New password</label>
		 <input type="password" name="password_new" id="password_new" value="<?= Input::get('password_new') ?>">
	</div>
	<div class="field">
		 <label for="password_new_again">New password again</label>
		 <input type="password" name="password_new_again" id="password_new_again" value="<?= Input::get('password_new_again') ?>">
	</div>
	
	<input type="submit" value="Register">
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
</form>


