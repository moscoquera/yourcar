<ul>
   <br /> <br /><li><a href="<?= base_url() ?>index.php/GestorReservas/reservar">RESERVAR</a></li><br />
</ul>
<?php
echo validation_errors();
if (isset($resultado)){
    if ($resultado=='si'){ ?>
<b>Reserva Actualizada</b>
   <?php }else{ ?>
<b>Error Actualizando Reserva</b>
   <?php }
    
}
?>
<form method="post" action="<?= base_url() ?>index.php/GestorReservas">
    <label>Buscar Por ID:</label>
    <input type="text" name="id">
    <input type="submit" value="Buscar" name="buscar">
</form>
<?php
if (isset($resultado)) {
    if ($resultado == 'no') {
        ?>
        <b>Id no Valido</b>

    <?php } else if ($resultado == 'si') { ?>

        <label>ID: <?= $reserva->id ?></label>
        <label>Usuario: <?= $reserva->usuarioid ?></label>
        <label>Placa Vehiculo: <?= $reserva->placavehiculo ?></label>
        <label>Valor de la Reserva: <?= $reserva->precio ?></label>
        <label>Lugar de Inicio: <?= $reserva->lugarinicio ?></label>
        <label>Lugar de Fin: <?= $reserva->lugarfin ?></label>
        <label>Fecha de Inicio: <?= $reserva->fechainicio ?></label>
        <label>Fecha de Fin: <?= $reserva->fechafin ?></label>
        <?php if ($reserva->prueba != null) { ?>
            <label>Comprobante de Pago:</label>
            <img src="<?= base_url() ?>uploads/<?= $reserva->prueba ?>">
            <?php 
                if ($reserva->pagada != '1'){ ?>
            <a href="<?= base_url()?>index.php/GestorReservas/aprobarPago/<?= $reserva->id ?>">Aprobar</a>
            <a href="<?= base_url()?>index.php/GestorReservas/negarPago/<?= $reserva->id ?>">Denegar</a>
              <?php  }
            ?>
            
        <?php }
        ?>

    <?php
    }
}
?>
<table class="table table-bordered">
    <thead>
    <td>Id</td>
    <td>Placa</td>
    <td>Precio</td>
    <td>Fecha inicio</td>
    <td>Fecha fin</td>
    <td>Lugar inicio</td>
    <td>Lugar fin</td>
    <td>Pagada</td>
</thead>
<tbody> 
    <?php
    if (isset($reservas)) {
        foreach ($reservas as $reserva) {
            ?>
            <tr>
                <td><?= $reserva->id ?></td>
                <td><?= $reserva->placavehiculo ?></td>
                <td><?= $reserva->precio ?></td>
                <td><?= $reserva->fechainicio ?></td>
                <td><?= $reserva->fechafin ?></td>
                <td><?= $reserva->lugarinicio ?></td>
                <td><?= $reserva->lugarfin ?></td>
                <td><?php if ($reserva->pagada == null) { ?>
                        <a href="<?= base_url() ?>index.php/GestorReservas/ingresarPagos/<?= $reserva->id ?>">Pagar</a>
                    <?php } else { ?>
                        SI  
                    <?php } ?></td>

            </tr>
            <?php
        }
    }
    ?>
</tbody>

</table>