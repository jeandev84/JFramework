<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= asset("assets/bootstrap/css/bootstrap.min.css") ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= env('APP_NAME')?></title>
</head>
<body>

<?php include('partials/nav.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">
         <?php include('partials/sidebar.php') ?>
        </div>
        <div class="col-md-8">
            <?= $content ?>
        </div>
        <div class="col-md-1"></div>
    </div>

</div>

<!-- scripts -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="<?= asset("assets/bootstrap/js/jquery.js") ?>"></script>
<script src="<?= asset("assets/bootstrap/js/bootstrap.min.js") ?>"></script>

<script src="<?= asset("assets/app.js") ?>"></script>

<!--<script src="--><?//= asset("assets/bootstrap/js/jquery-3.4.1.slim.min.js")?><!--"></script>-->
<!--<script src="--><?//= asset("assets/bootstrap/js/popper.min.js")?><!--"></script>-->
</body>
</html>