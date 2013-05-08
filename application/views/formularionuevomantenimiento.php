<?php
echo validation_errors();

if (isset($resultado)) {
    if ($resultado == 'si') {
        ?>
        <b>Mantenimiento Ingresado</b>
    <?php } else { ?>
        <b>Rango de fechas no Valido</b>
    <?php
    }
}
?>
<form method="post">
    <label>Vehiculo:</label>
    <select name="placa">
        <?php
        if (isset($vehiculos)) {
            foreach ($vehiculos as $vehiculo) {
                ?>
                <option value="<?= $vehiculo->placa ?>" <?= set_select('placa', $vehiculo->placa) ?>><?= $vehiculo->placa ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label>Fecha de Inicio:</label>
    <input type="text" name="fechai" id="fechai" <?= set_value('fechai') ?>>
    <label>Fecha de Fin:</label>
    <input type="text" name="fechaf" id="fechaf" <?= set_value('fechaf') ?>>
    <label>Descripcíon:</label>
    <textarea name="descripcion"><?= set_value('descripcion') ?>
    </textarea>
    <label>Tipo</label>
    <select name="tipo">
        <?php
        if (isset($tipos)) {
            foreach ($tipos as $tipo) {
                ?>
                <option value="<?= $tipo->id ?>" <?= set_select('tipo', $tipo->id) ?>><?= $tipo->nombre ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label>Valor:</label>
    <input type="number" name="valor" min="0" <?= set_value('valor') ?>>
    <input type="submit" value="Agregar" name="btnagregar">
</form>
<script>
    $('#fechai').datepicker({format: 'yyyy-mm-dd'});
    $('#fechaf').datepicker({format: 'yyyy-mm-dd'});
</script>