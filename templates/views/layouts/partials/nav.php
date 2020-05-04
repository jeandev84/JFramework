<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">JFramework</a>
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
        </ul>
        <ul class="navbar-nav"">
            <!-- if user login -->
            <li class="nav-item">
               <a class="nav-link" href="#">Profile [ Hi!, Yao ]</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Logout</a>
            </li>
            <!-- / end user login -->

            <!-- if ! user does not login -->
            <li class="nav-item">
               <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
            <!-- /end not login -->
        </ul>
    </div>
</nav>