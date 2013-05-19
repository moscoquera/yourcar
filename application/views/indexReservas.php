<div class="row">
<div class="span3">
    <ul class="nav nav-list">
        <li class="active"><a href="<?= base_url() ?>index.php/gestorReservas/reservar">RESERVAR</a></li><br />
    </ul>
</div>
<?php
echo validation_errors();
if (isset($resultado)) {
    if ($resultado == 'siact') {
        ?>
    <div class="alert alert-success"><p>Reserva Actualizada</p></div>
    <?php } else if ($resultado == 'noact'){ ?>
    <div  class="alert alert-error">   <p>Error Actualizando Reserva</p></div>
    <?php
    }
}
?>
<form method="post" action="<?= base_url() ?>index.php/gestorReservas">
    <label>Buscar Por ID:</label>
    <input type="text" name="id">
    <input type="submit" value="Buscar" name="buscar">
</form>
</div>
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
            <br>
            <?php if ($reserva->pagada != '1') { ?>
            <a class="btn btn-success" href="<?= base_url() ?>index.php/gestorReservas/aprobarPago/<?= $reserva->id ?>">Aprobar</a>
            <a class="btn btn-danger" href="<?= base_url() ?>index.php/gestorReservas/negarPago/<?= $reserva->id ?>">Denegar</a>
            <?php }
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
                        NO <a href="<?= base_url() ?>index.php/gestorReservas/ingresarPagos/<?= $reserva->id ?>">(Pagar)</a>
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