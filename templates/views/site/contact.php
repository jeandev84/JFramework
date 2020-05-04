<h1>Contact</h1>

<form action="<?= route('app.contact') ?>" method="POST">
    <div>
        <input type="text" name="username" placeholder="Somebody">
    </div>
    <div>
        <input type="password" name="password" placeholder="***-****-***">
    </div>
    <div>
        <input type="email" name="email" placeholder="somebody@site.com">
    </div>
    <button type="submit">Send</button>
</form>
