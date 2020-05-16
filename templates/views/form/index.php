<div>
    <?php if(\Jan\Services\Session\Session::has('errors')): ?>
      <div class="alert alert-danger">
          <?= implode('<br>', \Jan\Services\Session\Session::get('errors'))?>
      </div>
    <?php endif; ?>

    <?php if(\Jan\Services\Session\Session::has('success')): ?>
        <div class="alert alert-success">
           Votre mail nous a bien ete envoye!
        </div>
    <?php endif; ?>

    <form action="<?= route('gk.service.form')?>" method="POST">
        <div class="row">
            <div class="col-md-4">
                <?= $form->text('name', 'Name') ?>
            </div>
            <div class="col-md-4">
                <?= $form->email('email', 'Email') ?>
            </div>
            <div class="col-md-4">
                <?= $form->select('service', 'Service', ['Contact', 'Depannage', 'Shell']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->textarea('message', 'Message') ?>
                <!-- Example contre spam / Akismet anti-spam(https://akismet.com/), or use Captcha -->
                <?= $form->hidden('check', '') ?>
                <!--/-- end Captcha -->
                <?= $form->submit('Envoyer') ?>
            </div>
        </div>
    </form>
    <h2>Debug: </h2>
    <?php dump(\Jan\Services\Session\Session::all()); ?>
    <?php
    \Jan\Services\Session\Session::remove('errors');
    \Jan\Services\Session\Session::remove('success');
    \Jan\Services\Session\Session::remove('inputs');
    ?>
</div>