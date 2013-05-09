<?php
echo validation_errors('<p><b>', '</b></p>');
if (isset($resultado)) {
    if ($resultado == 'nove') {
        ?>
        <p><b>Vehiculo no encontrado</b></p>
        <?php } else if ($resultado == 'si') {
        ?>
        <p><b>Informacion Actualizada</b></p>
        
    <?php } else {
        ?>
        <p><b>Vehiculo no Actualizado</b></p>
        
    <?php
    }
}
if (isset($vehiculo)) {
    ?>
    <form method="post">
        <br /><br /> <label>Placa:</label>
        <input type="text" name="placa" maxlength="7" value="<?= $vehiculo->placa ?>" readonly="true">
        <br /><br /><label>Marca:</label>
        <input type="text" name="marca" value="<?= $vehiculo->marca ?>">
        <br /><br /><label>Modelo:</label>
        <input type="text" name="modelo" value="<?= $vehiculo->modelo ?>">
        <br /><br /><label> Color</label>
        <input type="text" name="color" value="<?= $vehiculo->color ?>">
        <br /><br /><label>Cilindraje (c.c.):</label>
        <input type="number" name="cilindraje" value="<?= $vehiculo->cilindraje ?>">
        <br /><br /><label>Frenos:</label>
        <select name="frenos">
            <?php
            if (isset($frenos)) {
                foreach ($frenos as $freno) {
                    ?>
                    <option value="<?= $freno->id ?>" <?php if ($freno->id == $vehiculo->frenos) {
                echo 'selected="selected"';
            } ?>><?= $freno->nombre ?></option>
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
                    <option value="<?= $dir->id ?>" <?php if ($dir->id == $vehiculo->direccion) {
                echo 'selected="selected"';
            } ?>><?= $dir->nombre ?></option>
            <?php
        }
    }
    ?>
        </select>
        <br /><br /> <label>Descripcion:</label> <br />
        <textarea name="descripcion"><?= $vehiculo->descripcion ?></textarea>
        <br /><br /><label>Numero de Pasajeros:</label>
        <input type="number" name="pasajeros" min="0" value="<?= $vehiculo->npasajeros ?>">
        <br /><br /><label>Fecha del Soat:</label>
        <input type="date" name="fechasoat" value="<?= $vehiculo->fechasoat ?>">
        <br /><br /><label>Fecha del Seguro:</label>
        <input type="date" name="fechaseg" value="<?= $vehiculo->fechaseguro ?>">
        <br /><br /><label>Fecha revision tecnicomecanica: </label>
        <input type="date" name="fechatec" value="<?= $vehiculo->fecharevision ?>">
        <br /><br /><label>Tarifa:</label>
        <input type="number" name="tarifa" min="0" value="<?= $vehiculo->tarifa ?>">
        <br /><br /><label>Garantia:</label>
        <input type="number" name="garantia" min="0" value="<?= $vehiculo->garantia ?>">
        <input type="submit" value="Modificar" name="modificar">
    </form>
<?php } else {
    ?>
    <form method="post" action="<?= base_url() ?>index.php/gestionVehiculos/modificarVehiculo">
        <br /><br /><br /><label>Placa</label>
        <input type="search" name="busqueda"><br /><br />
        <input type="submit" value="buscar" name="buscar">
    </form>
    <?php
}
?>