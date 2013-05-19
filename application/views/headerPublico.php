<!DOCTYPE HTML>
<html>
    <head>
        
        <title>YourCar :D</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>media/css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>media/css/bootstrap-datetimepicker.min.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>media/css/datepicker.css" />
        
        <script type="text/javascript" src="<?= base_url(); ?>media/js/jquery-1.9.1.js" ></script>
        <script type="text/javascript" src="<?= base_url(); ?>media/js/bootstrap.js" ></script>
        <script type="text/javascript" src="<?= base_url(); ?>media/js/bootstrap-datetimepicker.min.js" ></script>
        <script type="text/javascript" src="<?= base_url(); ?>media/js/bootstrap-datepicker.js" ></script>
       
        </head>
    <body>
        <div class="span2">
            <img src="<?= base_url()?>images/logo.png">
        </div>
        </div>
        <div class="container row">
            <div class="span12"> 
            <div class="navbar" style="margin-top: 32px !important">
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
            </div>