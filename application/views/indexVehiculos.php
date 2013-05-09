<ul>
    <br /> <br /> <li><a href="<?= base_url() ?>index.php/gestionVehiculos/crearVehiculo">Crear vehiculo</a></li> <br /> 
    <li><a href="<?= base_url() ?>index.php/gestionVehiculos/modificarVehiculo">Modificar vehiculo</a></li><br /> 
    <li><a href="<?= base_url() ?>index.php/gestionVehiculos/eliminarVehiculo">Borrar vehiculo</a></li> <br /> 
    <li><a href="<?= base_url() ?>index.php/gestionVehiculos/vehiculosDisponibles">Vehiculos Disponibles</a></li> <br /> 
    <li><a href="<?= base_url() ?>index.php/gestionVehiculos/vehiculosReservados">Vehiculos Reservados</a></li> <br /> 
    <li><a href="<?= base_url() ?>index.php/gestionVehiculos/vehiculosAlquilados">Vehiculos Alquilados</a></li> <br /> 
    <li><a href="<?= base_url() ?>index.php/gestionVehiculos/vehiculosPorAtributos">Según Atributos del Vehiculo</a></li> <br /> 
</ul>
<?php
echo validation_errors();

if (isset($res)) {
    ?>
    <b>Placa no Valida</b>
<?php }
?>
<form method="post">
    <label>Buscar por Placa:</label>
    <input type="search" name="texto">
    <input type="submit" name="buscar" value="Buscar">
</form>