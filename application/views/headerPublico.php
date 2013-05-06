<!DOCTYPE HTML>
<html>
    <head>
        <title>YourCar :D</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>media/css/bootstrap.css" />
        <script type="text/javascript" src="<?= base_url(); ?>media/js/bootstrap.js" ></script>
        <script type="text/javascript" src="<?= base_url(); ?>media/js/jquery-1.9.1.js" ></script>
    
        </head>
    <body>
        
        <div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="<?= base_url(); ?>">YOURCAR</a>
                <ul class="nav">
                    <?php
                    if (isset($linksmenu)) {
                        foreach ($linksmenu as $link) {
                            ?>
                            <li><a href="<?= $link->url ?>"><?= $link->nombre ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </di>