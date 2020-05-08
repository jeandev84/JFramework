<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= asset("assets/bootstrap/css/bootstrap.min.css") ?>">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="--><?//= asset("assets/bootstrap/fonts/font-awesome.min.css") ?><!--">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Default layout</title>
</head>
<body>

<?php include('partials/nav.php') ?>
<div class="container mt-4">
    <?= $content ?>
    <div>
        <code><small>layout default</small></code>
    </div>
</div>

<!-- scripts -->
<script src="<?= asset("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
<script src="<?= asset("assets/bootstrap/js/jquery-3.4.1.slim.min.js")?>"></script>
<script src="<?= asset("assets/bootstrap/js/popper.min.js")?>"></script>
</body>
</html>