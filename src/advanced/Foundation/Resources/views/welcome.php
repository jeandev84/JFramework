<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= asset("assets/bootstrap/css/bootstrap.min.css") ?>">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="--><?//= asset("assets/bootstrap/fonts/font-awesome.min.css") ?><!--">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= env('APP_NAME')?></title>
</head>
<body>

<?php include('partials/nav.php'); ?>
<div class="container mt-5 mb-auto text-center">
    <h1>
        Welcome to <a href="https://github.com/jeandev84/JFramework" style="text-decoration: none;" target="_blank">
            <?= env('APP_NAME')?> :)
        </a>
    </h1>
    <p>You are ready for bulding your <code>web site ...</code></p>
</div>

<!-- scripts -->
</body>
</html>