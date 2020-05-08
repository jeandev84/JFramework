<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= route('app.home') ?>">
        <?= env('APP_NAME')?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= route('app.home')?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= route('app.about')?>">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= route('app.contact')?>">Contact</a>
            </li>
            <li class="nav-item">
                <a href="https://github.com/jeandev84/JFramework" class="nav-link" target="_blank">
                    Github <i class="fa fa-github"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav"">

         <!-- momently it will be implement after authentication functonnalities -->
          <?php if(false): ?>
            <!-- if user login -->
            <li class="nav-item">
               <a class="nav-link" href="<?= route('user.profile') ?>">Profile [ Hi!, Yao ]</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= route('auth.logout') ?>">Logout</a>
            </li>
          <?php endif; ?>
            <!-- / end user login -->

            <!-- if ! user does not login -->
            <li class="nav-item">
               <a class="nav-link" href="<?= route('auth.login')?>">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= route('auth.register') ?>">Register</a>
            </li>
            <!-- /end not login -->
        </ul>
    </div>
</nav>