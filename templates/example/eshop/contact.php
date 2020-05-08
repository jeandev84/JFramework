<h1>Contact</h1>

<form action="<?= route('app.contact') ?>" method="POST">
    <div class="form-group">
        <input type="text" name="username" placeholder="Somebody" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="***-****-***" class="form-control">
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="somebody@site.com" class="form-control">
    </div>
    <button type="submit" class="btn btn-secondary">Send</button>
</form>
