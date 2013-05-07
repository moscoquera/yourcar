<?php
echo validation_errors('<b>', '</b>');
?>
<form method="post">
    <?php if (isset($vehiculo)) { ?>
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
    <input type="text" maxlength="100" name="lugarentrega" value="<?= set_value('lugarentrega') ?>">

    <label>Ciudad o Lugar de la Recepción:</label>
    <input type="text" maxlength="100" name="lugarrecepcion" value="<?= set_value('lugarrecepcion') ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?= set_value('email') ?>">
    <?php if (isset($costo)) { ?>
        <label><b>Costo: <?= $costo ?></b></label>
    <?php }
    ?>
    <input type="submit" value="cotizar" name="btncotizar">
</form>

<script type="text/javascript">
    $(function() {
        $('#horainicio').datetimepicker();
        $('#horafin').datetimepicker();
    });
</script>