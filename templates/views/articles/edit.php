<h1>Edit article</h1>
<?= route('article.edit', ['id' => $id]) ?>
<br>
<a href="<?= route('article.edit', ['id' => $id])?>">Edit</a>
<form action="<?= route('article.edit', ['id' => $id]) ?>" method="POST">
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