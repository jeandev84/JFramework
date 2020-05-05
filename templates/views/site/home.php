<h1>Welcome to <a href="<?= route('app.home') ?>" style="text-decoration: none;"><?= env('APP_NAME')?></a></h1>
<div class="mt-4">
    <a href="<?= route('article.list')?>" class="btn btn-secondary">Articles</a>
</div>

<ul class="mt-5">
    <?php /*foreach ($users as $user): ?>
      <li><?= $user->getId() ?></li>
      <li><?= $user->getName() ?></li>
      <li><?= $user->getEmail() ?></li>
      <li><?= $user->getAddress() ?></li>
      <li><?= $user->getRole() ?></li>
    <?php endforeach;*/ ?>
</ul>
