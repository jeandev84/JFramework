<h1>Edit article</h1>

<form action="<?= route('article.edit', ['slug' => 'mes-nouveaux-articles', 'id' => 1]) ?>" method="POST">
    <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Somebody">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="somebody@site.com">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="**!@_A&">
    </div>
    <button type="submit" class="btn btn-success">Send</button>
</form>

<div class="mt-4">
    <a href="<?= route('article.list') ?>" class="btn btn-info">Go to articles</a>
</div>