<?php
echo validation_errors();
if (isset($resultado)) {
    if ($resultado == 'nove') {
        ?>
        <b>el vehiculo no existe</b>
    <?php } else if ($resultado == 'si') { ?> 
        <b>Vehiculo eliminado</b>
    <?php } else if ($resultado == 'no') { ?>
        <b>Error eliminando el vehiculo</b>   
        <?php
    }
}

if (isset($vehiculo)) {
    ?>
    <form method="post">
        <label>Placa: <?= $vehiculo->placa ?></label>
        <label>Marca: <?= $vehiculo->marca ?></label>
        <label>Modelo: <?= $vehiculo->modelo ?></label>
        <label>Color: <?= $vehiculo->color ?></label>
        <input type="hidden" value="<?= $vehiculo->placa ?>" name="placa">
        <input type="submit" value="Eliminar" name="eliminar">

    </form>
<?php } else {
    ?>
    <form method="post">
        <br /><br /><br /><br /><label>Placa</label>
        <input type="search" name="busqueda"><br /><br />
        <input type="submit" value="Buscar" name="Buscar">
    </form>
    <?php
}
?>