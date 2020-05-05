<h1>Registration</h1>
<form action="<?= route('auth.register') ?>" method="POST">
    <div class="form-group">
        <input type="text" name="pseudo" class="form-control" placeholder="pseudo">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="somebody@site.com">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="secret123">
    </div>
    <div class="form-group">
        <input type="password" name="confirm_password" class="form-control" placeholder="confirm your password">
    </div>
    <div class="form-group">
        <input type="text" name="address" placeholder="Moscou, street 45" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Send</button>
</form>