<h1>Show article</h1>
<div>
    <a href="<?= route('article.edit', ['slug' => $slug, 'id' => $id])?>" class="btn btn-primary">Edit</a>
</div>
<div class="mt-4">
    <a href="<?= route('article.list') ?>" class="btn btn-info">Go to articles</a>
</div