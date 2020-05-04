<h1>Article index</h1>
<div>
    <a href="<?= route('article.show', ['slug' => 'mes-nouveaux-articles', 'id' => 1]) ?>" class="btn btn-primary">Show</a>
    <a href="<?= route('article.edit', ['id' => 1])?>" class="btn btn-success">
        Edit
    </a>
    <a href="#" class="btn btn-danger">Delete</a>
</div>

<div class="mt-4">
    <a href="<?= route('article.list') ?>" class="btn btn-info">Go to articles</a>
</div>