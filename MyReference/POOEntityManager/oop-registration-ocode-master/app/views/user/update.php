<?= isset($data['error']) ? $data['error'] : ''; ?>

<h1>Update Details</h1>
<form action="" method="POST">
	<div class="field">
		<label for="name">Name</label>
		<input type="text" name="name" value="<?= escape($data['user']->data()->name) ?>">
	</div>

	<div class="field">
		<input type="submit" value="Update">
		<input type="hidden" name="token" value="<?= Token::generate(); ?>">
	</div>
</form>
