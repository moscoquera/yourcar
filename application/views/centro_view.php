
<div class="row">

    <div id="menunavegacionpublico" class="span2">
        <ul class="nav nav-list">
            <?php if (!isset($usuario)) { ?>
                <li id="linkcuenta">
                    <a href="<?= base_url() ?>index.php/login">INGRESAR</a>
                </li><br /> 


                <br /> <br /> <li id="linkcrearcuenta"><a href="<?= base_url() ?>index.php/login/crearCuenta">SOLICITAR LA CUENTA </a></li><br /> 
            <?php } else { ?>

                <br /> <br /> <li class="active" id="linkcuenta"><?= $usuario->nombres ?></li> <br />
                <br /> <li id="linksalir"><a class="btn btn-warning" href="<?= base_url() ?>/index.php/login/salir">SALIR</a></li><br />
                <?php
            }
            ?>        
        </ul>  


    </div>

    <div class="span3">
        <table class="table table-bordered">
            <thead>
            <td>MARCA:</td> 
            <td>MODELO:</td>
            <td>COLOR:</td>
            <td>CILINDRAJE:</td>
            <td>FRENOS:</td>
            <td>DIRECCION:</td>
            <td>PASAJEROS:</td>
            <td>TARIFA:</td>
            <td>VALOR DEL VOUCHER: </td>
            <td>OPCION</td>
            </thead>
            <?php
            if (isset($vehiculos)) {
                foreach ($vehiculos as $vehiculo) {
                    ?>
                    <tr>
                        <td><?= $vehiculo->marca ?></td>
                        <td><?= $vehiculo->modelo ?></td>
                        <td><?= $vehiculo->color ?></td>
                        <td><?= $vehiculo->cilindraje ?></td>
                        <td><?= $vehiculo->frenos ?></td>
                        <td><?= $vehiculo->direccion ?></td>
                        <td><?= $vehiculo->npasajeros ?></td>
                        <td><?= $vehiculo->tarifa ?></td>
                        <td><?= $vehiculo->garantia ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?= base_url() ?>index.php/centro/cotizacion/<?= $vehiculo->placa ?>">Cotizar</a>
                            <a class="btn btn-success" href="<?= base_url() ?>index.php/GestorReservas/index/<?= $vehiculo->placa ?>">Reservar</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    </div>
</div>
