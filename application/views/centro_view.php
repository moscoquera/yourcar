
<div>
   
<div id="menunavegacionpublico">
    <ul>
        <?php if (!isset($usuario)) { ?>
           <br /> <br />  <li id="linkcuenta"><a href="<?= base_url() ?>index.php/login">INGRESAR</a></li><br /> 
          
           
            <li id="linkcrearcuenta"><a href="<?= base_url() ?>index.php/login/crearCuenta">SOLICITAR LA CUENTA </a></li><br /> 
        <?php } else { ?>

            <li id="linkcuenta"><?= $usuario->nombres ?></li>
            <li id="linksalir"><a href="<?= base_url() ?>/index.php/login/salir">Salir</a></li>
                <?php
            }
            ?>        
    </ul>  


</div>
    
    
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
            <a href="<?= base_url() ?>index.php/centro/cotizacion/<?= $vehiculo->placa?>">Cotizar</a>
            <a href="<?= base_url() ?>index.php/GestorReservas/index/<?= $vehiculo->placa ?>">Reservar</a>
        </td>
    <?php
    }
}
?>
     
</table>  
</div>
