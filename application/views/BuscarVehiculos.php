<?php if (isset($vehiculos)) { ?>

    <table class="table table-bordered">
        <thead>
        <td>Placa</td>
        <td>Marca</td>
        <td>Modelo</td>
        <td>Color</td>
        <td>Cilindraje (c.c.)</td>
    </thead>
    <tbody><?php foreach ($vehiculos as $vehiculo) { ?>
            <tr>
                <td><a href="<?= base_url() ?>index.php/gestionVehiculos/ver/<?= $vehiculo->placa ?>"><?= $vehiculo->placa ?></a></td>
                <td><?= $vehiculo->marca ?></td>
                <td><?= $vehiculo->modelo ?></td>
                <td><?= $vehiculo->color ?></td>
                <td align="center"><?= $vehiculo->cilindraje ?></td>
            </tr>
        <?php }
        ?> </tbody>
    </table>


<?php } else {
    ?>

    <form method="post">
        <br/><br/><label>Marca:</label>
        <input type="text" name="marca">
        <br/><br/><label>Modelo:</label>
        <input type="text" name="modelo">
        <br/><br/><label> Color</label>
        <input type="text" name="color">
        <br/><br/><label>Cilindraje (c.c.):</label>
        <input type="number" name="cilindraje">
        <br/><br/><label>Frenos:</label>
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
        <br/><br/><label>Direccion:<br/><br/>
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
        <br/><br/><label>Numero de Pasajeros:</label>
        <input type="number" name="pasajeros" min="0">
        <br/><br/><label>Tarifa:</label>
        <input type="number" name="tarifa" min="0">
        <br/><br/><label>Garantia:</label>
        <input type="number" name="garantia" min="0">
        <input type="submit" value="Buscar" name="buscar">
    </form>
<?php }
?>