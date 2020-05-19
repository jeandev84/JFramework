<div class="mt-4 text-center">
    <h1>
        Welcome to <a href="<?= route('app.home') ?>" style="text-decoration: none;"><?= env('APP_NAME')?></a>
    </h1>
</div>

<div>
    <?php foreach ($users as $user): ?>
      <ul style="border: 1px solid #ccc;list-style: none;">
          <li><?= ucfirst($user->getName()) ?></li>
          <li><?= $user->getEmail() ?></li>
          <li><?= $user->getAddress() ?></li>
          <li><?= $user->getRole() ?></li>
      </ul>
    <?php endforeach; ?>
</div>


