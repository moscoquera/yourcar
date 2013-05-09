<?php
echo validation_errors('<b>', '</b>');
if (isset($resultado)) {
    if ($resultado == 'errfecha') {
        ?>
        <b>El rango de fechas no es valido</b>
    <?php
    }
}
?>
<form method="post"> <br /><br />
    <?php if (isset($vehiculo)) { ?> <br /><br /><br />
    <input type="hidden" value="<?= $vehiculo->placa ?>" name="placa"> 
<?php }
?>
   <label>Fecha y Hora de inicio:</label>
    <div id="horainicio" class="input-append date">
        <input data-format="dd/MM/yyyy hh:mm" type="text" name="horainicio" value="<?= set_value('horainicio') ?>">
        <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
        </span>
    </div>
    <label>Fecha y Hora de Fin: </label>
    <div id="horafin" class="input-append date">
        <input data-format="dd/MM/yyyy hh:mm" type="text" name="horafin" value="<?= set_value('horafin') ?>">
        <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
        </span>
    </div>
    <label>Ciudad o Lugar de la Entrega:</label>
    <select name="lugarentrega">
        <?php
        if (isset($lugares)) {
            foreach ($lugares as $lugar) {
                ?>
                <option value="<?= $lugar->id ?>"<?= set_select('lugarentrega', $lugar->id) ?>><?= $lugar->nombre ?></option>
            <?php
            }
        }
        ?>
    </select>

    <label>Ciudad o Lugar de la Recepción:</label>
    <select name="lugarrecepcion">
        <?php
        if (isset($lugares)) {
            foreach ($lugares as $lugar) {
                ?>
                <option value="<?= $lugar->id ?>"<?= set_select('lugarrecepcion', $lugar->id) ?>><?= $lugar->nombre ?></option>
    <?php
    }
}
?>
    </select>

    <label>Email:</label>
    <input type="email" name="email" value="<?= set_value('email') ?>">
<?php if (isset($costo)) { ?>
        <label><b>Costo: <?= $costo ?></b></label>
    <?php }
    ?>
    <input type="submit" value="cotizar" name="btncotizar">
</form>
        <form method="post" action="<?= base_url() ?>index.php/GestorReservas/reservar">
<?php if (isset($vehiculo)) { ?>
        <input type="hidden" value="<?= $vehiculo->placa ?>" name="placa"> 
<?php }
?>
    <input type="hidden" name="horainicio" value="<?= set_value('horainicio') ?>">
    <input type="hidden" name="horafin" value="<?= set_value('horafin') ?>">
    <input type="hidden" name="lugarentrega" value="<?= set_value('lugarentrega') ?>">
    <input type="hidden" name="lugarrecepcion" value="<?= set_value('lugarrecepcion') ?>">
    
<?php if (isset($costo)) { ?>
    <input  type="hidden" name="costo" value="<?= $costo ?>">
        <input type="submit" value="Reservar" name="btnreservar">
<?php } ?>
</form>

<script type="text/javascript">
    $(function() {
        $('#horainicio').datetimepicker();
        $('#horafin').datetimepicker();
    });
</script>