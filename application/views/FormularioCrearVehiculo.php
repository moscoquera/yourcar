<?php
echo validation_errors('<p><b>', '</b></p>');

if (isset($estado)) {
    if ($estado == 'si') {
        ?>
        <p><b>Vehiculo Agregado</b></p>
        <?php } else {
        ?>
        <p><b>Error agregando vehiculo</b></p>
    <?php
    }
}
?>
<form action="<?= base_url() ?>index.php/gestionVehiculos/crearVehiculo" method="post">
    <label>Placa:</label>
    <input type="text" name="placa" maxlength="7">
    <label>Marca:</label>
    <input type="text" name="marca">
    <label>Modelo:</label>
    <input type="text" name="modelo">
    <label> Color</label>
    <input type="text" name="color">
    <label>Cilindraje (c.c.):</label>
    <input type="number" name="cilindraje">
    <label>Frenos:</label>
    <select name="frenos">
        <?php
        if (isset($frenos)) {
            foreach ($frenos as $freno) {
                ?>
                <option value="<?= $freno->id ?>"><?= $freno->nombre ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label>Direccion:</label>
    <select name="direccion">
        <?php
        if (isset($direccion)) {
            foreach ($direccion as $dir) {
                ?>
                <option value="<?= $dir->id ?>"><?= $dir->nombre ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label>Descripcion:</label>
    <textarea name="descripcion"></textarea>
    <label>Numero de Pasajeros:</label>
    <input type="number" name="pasajeros" min="0">
    <label>Fecha del Soat:</label>
    <input type="date" name="fechasoat">
    <label>Fecha del Seguro:</label>
    <input type="date" name="fechaseg">
    <label>Fecha revision tecnicomecanica: </label>
    <input type="date" name="fechatec">
    <label>Tarifa:</label>
    <input type="number" name="tarifa" min="0">
    <label>Garantia:</label>
    <input type="number" name="garantia" min="0">
    <input type="submit" value="Agregar">
</form>