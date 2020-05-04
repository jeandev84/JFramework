<h1>Login</h1>
<form action="<?= route('auth.login') ?>" method="POST">
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="somebody@site.com">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="**!@_A&">
    </div>
    <button type="submit" class="btn btn-success">Send</button>
</form>