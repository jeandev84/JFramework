<h1>Show article</h1>
<?= route('article.edit', ['slug' => $slug, 'id' => $id]) ?>
<br>
<a href="<?= route('article.edit', ['slug' => $slug, 'id' => $id])?>">Edit</a>