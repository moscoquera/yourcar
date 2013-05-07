<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($vehiculo)) {
    ?>

    <label>Placa: <?= $vehiculo->placa ?></label>
    <label>Marca: <?= $vehiculo->marca ?></label>
    <label>Modelo: <?= $vehiculo->modelo ?></label>
    <label>Color: <?= $vehiculo->color ?></label>
    <label>Cilindraje: <?= $vehiculo->cilindraje ?></label>
    <label>Frenos: <?= $vehiculo->frenos ?></label>
    <label>Direccion: <?= $vehiculo->direccion ?></label>
    <label>Descripcion:</label>
    <p>
        <?= $vehiculo->descripcion ?>
    </p>
    <label>Numero de Pasajeros: <?= $vehiculo->npasajeros ?></label>
    <label>Fecha del SOAT: <?= $vehiculo->fechasoat ?></label>
    <label>Fecha del Seguro: <?= $vehiculo->fechaseguro ?></label>
    <label>Fecha de la TenicoMecanica: <?= $vehiculo->fecharevision ?></label>
    <label>Tarifa: <?= $vehiculo->tarifa ?></label>
    <label>Garantia: <?= $vehiculo->garantia ?></label>
    

<?php }
?>
