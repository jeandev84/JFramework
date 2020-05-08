<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= asset("assets/bootstrap/css/bootstrap.min.css") ?>">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="--><?//= asset("assets/bootstrap/fonts/font-awesome.min.css") ?><!--">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= env('APP_NAME')?> | default</title>
</head>
<body>
<div class="container mt-4">
    <div class="">
        <?php

        // TODO Implement Error Handler
        echo '<div class=""><h2>Fatal error</h2>';
        echo '<b>Message</b> : '. $e->getMessage().'<br>';
        echo '<b>Code</b> : '. $e->getCode().'<br>';
        echo '<b>Line</b> : '. $e->getLine().'<br>';
        echo '<b>File path</b> : '. $e->getFile().'<br>';
        echo '<b>Trace String</b> : '. $e->getTraceAsString().'<br>';
        ///echo 'Trace : '. implode('<br>', $e->getTrace());
        echo 'Details';
        $i = 1;
        foreach ($e->getTrace() as $trace)
        {
            echo '<ul>Trace '. $i++;
            echo '<li>File : <a href="#">'. $trace['file'] .'</a></li>';
            echo '<li>Line : <a href="#">'. $trace['line'] .'</a></li>';
            echo '<li>Function : <a href="#">'. $trace['function'] .'</a></li>';
            echo '<li>Class : <a href="#">'. $trace['class'] .'</a></li>';
            echo '<li>Type : <a href="#">'. $trace['type'] .'</a></li>';
            echo '<li>Args : </li>';
            dump($trace['args']);
            echo '</ul>';
        }
        echo '</div>';
        exit('Something want wrong!');

        ?>
    </div>
</div>

<!-- scripts -->
<script src="<?= asset("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
<script src="<?= asset("assets/bootstrap/js/jquery-3.4.1.slim.min.js")?>"></script>
<script src="<?= asset("assets/bootstrap/js/popper.min.js")?>"></script>
</body>
</html>
