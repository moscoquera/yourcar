<div id="menunavegacionpublico">
    <ul>
        <?php if (!isset($usuario)) { ?>
            <li id="linkcuenta"><a href="<?= base_url() ?>index.php/login">Ingresar</a></li>
            <li id="linkcrearcuenta"><a href="<?= base_url() ?>index.php/login/crearCuenta">solicitar la cuenta</a></li>
        <?php } else { ?>

            <li id="linkcuenta"><?= $usuario->nombres ?></li>
            <li id="linksalir"><a href="<?= base_url() ?>/index.php/login/salir">Salir</a></li>
                <?php
            }
            ?>        
    </ul>  


</div>
<table>
    <thead>
    <td>Marca:</td>
    <td>Modelo:</td>
    <td>Color:</td>
    <td>Cilindraje:</td>
    <td>Frenos:</td>
    <td>Direccion:</td>
    <td>Pasajeros:</td>
    <td>Tarifa:</td>
    <td>Valor del Voucher: </td>
    <td>opcion</td>
</thead>
<?php
if (isset($vehiculos)) {
    foreach ($vehiculos as $vehiculo) {
        ?>
        <td><?= $vehiculo->marca ?></td>
        <td><?= $vehiculo->modelo ?></td>
        <td><?= $vehiculo->color ?></td>
        <td><?= $vehiculo->cilindraje ?></td>
        <td><?= $vehiculo->frenos ?></td>
        <td><?= $vehiculo->direccion ?></td>
        <td><?= $vehiculo->npasajeros ?></td>
        <td><?= $vehiculo->tarifa ?></td>
        <td><?= $vehiculo->garantia ?></td>
        <td><a href="<?= base_url() ?>index.php/centro/cotizacion/<?= $vehiculo->placa?>">Cotizar</a></td>
    <?php
    }
}
?>
</table>