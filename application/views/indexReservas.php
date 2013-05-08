<ul>
    <li><a href="<?= base_url() ?>index.php/GestorReservas/reservar">Reservar</a></li>
</ul>
<?php
echo validation_errors();
?>
<form method="post">
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
<table>
    <thead>
    <td>id</td>
    <td>placa</td>
    <td>precio</td>
    <td>fecha inicio</td>
    <td>fecha fin</td>
    <td>lugar inicio</td>
    <td>lugar fin</td>
    <td>pagada</td>
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