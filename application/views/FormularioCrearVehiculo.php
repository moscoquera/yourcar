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
    <br /><br /> <label>Placa:</label>
    <input type="text" name="placa" maxlength="7">
    <br /><br /><label>Marca:</label>
    <input type="text" name="marca">
    <br /><br /><label>Modelo:</label>
    <input type="text" name="modelo">
    <br /><br /><label> Color</label>
    <input type="text" name="color">
    <br /><br /><label>Cilindraje (c.c.):</label>
    <input type="number" name="cilindraje">
    <br /><br /><label>Frenos:</label>
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
    <br /><br /><label>Direccion:</label>
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
    <br /><br /><label>Descripcion:</label>
    <textarea name="descripcion"></textarea>
    <br /><br /><label>Numero de Pasajeros:</label>
    <input type="number" name="pasajeros" min="0">
    <br /><br /><label>Fecha del Soat:</label>
    <input type="date" name="fechasoat">
    <br /><br /><label>Fecha del Seguro:</label>
    <input type="date" name="fechaseg">
    <br /><br /><label>Fecha revision tecnicomecanica: </label>
    <input type="date" name="fechatec">
    <br /><br /><label>Tarifa:</label>
    <input type="number" name="tarifa" min="0">
    <br /><br /><label>Garantia(Meses):</label> 
    <input type="number" name="garantia" min="0">  <br /> <br />
    <input type="submit" value="Agregar"> 
</form>