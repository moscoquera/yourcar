<div id="menunavegacionpublico">
    <ul>
        <?php if (!isset($usuario)) { ?>
            <li id="linkcuenta"><a href="<?= base_url() ?>index.php/login">Ingresar</a></li>

        <?php } else { ?>

            <li id="linkcuenta"><?= $usuario->nombres ?></li>
            <li id="linksalir"><a href="<?= base_url() ?>/index.php/login/salir">Salir</a></li>
                <?php
            }
            
            ?>        
    </ul>  


</div>