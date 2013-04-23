<!DOCTYPE HTML>
<html>
    <head>
        <title>YourCar :D</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>media/css/bootstrap.css" />
        
        <link type="text/javascript" href="<?= base_url(); ?>media/js/bootstrap.js" />
    </head>
    <body>
    <ul>
        <?php
            if (isset($linksmenu)){
                foreach ($linksmenu as $link){
                  ?>
            <li><a href="<?= $link->url?>"><?= $link->nombre ?></a></li>
                  <?php
                }
                
            }
        ?>
    </ul>
    