<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($vehiculo)) {
    ?>
    <table class="table table-condensed">
        <thead>
            <tr>
                <td>Propiedad</td>
                <td>Valor</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Placa
                </td>

                <td>
                    <?= $vehiculo->placa ?>
                </td>
            </tr>
            <tr>
                <td>Marca</td>
                <td> <?= $vehiculo->marca ?></td>
            </tr>
            <tr>
                <td>Modelo</td>
                <td> <?= $vehiculo->modelo ?></td>
            </tr>
            <tr>
                <td>Color</td>
                <td> <?= $vehiculo->color ?></td>
            </tr>
            <tr>
                <td>Cilindraje</td>
                <td> <?= $vehiculo->cilindraje ?></td>
            </tr>
            <tr>
                <td>Frenos</td>
                <td> <?= $vehiculo->frenos ?></td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td> <?= $vehiculo->direccion ?></td>
            </tr>
            <tr>
                <td>Descripcion</td>
                <td>
                    <?= $vehiculo->descripcion ?>
                </td>
            </tr>
            <tr><td>Numero de Pasajeros</td>
                <td> <?= $vehiculo->npasajeros ?></td>
            </tr>
            <tr>
                <td>Fecha del SOAT</td>
                <td> <?= $vehiculo->fechasoat ?></td>
            </tr>
            <tr>
                <td>Fecha del Seguro</td>
                <td> <?= $vehiculo->fechaseguro ?></td>
            </tr>
            <tr>
                <td>Fecha de la TenicoMecanica</td>
                <td> <?= $vehiculo->fecharevision ?></td>
            </tr>
            <tr>
                <td>Tarifa </td>
                <td><?= $vehiculo->tarifa ?></td>
            </tr>
            <tr>
                <td>Garantia</td>
                <td> <?= $vehiculo->garantia ?></td>
            </tr>
            <tr>
                <td>Kilometros por Dia</td>
                <td><?= $vehiculo->kmsdia ?></td>
            </tr>
            <tr>
                <td>Iva</td>
                <td><?= $vehiculo->iva ?>%</td>
            </tr>
            <tr>
                <td>Valor Galón de Gasolina </td>
                <td> <?= $vehiculo->valorgasolina ?></td>
            </tr>
            <tr>
                <td>Valor de la Lavada </td>
                <td><?= $vehiculo->valorlavada ?></td>
            </tr>
            <tr>
                <td>Airbags</td>
                <td> <?= ($vehiculo->airbags) ? "SI" : 'NO' ?></td>
            </tr>
            <tr>
                <td>Precio Servicio de Conductor</td>
                <td> <?= $vehiculo->precioconductor ?></td>
            </tr>
            <tr>
                <td>Gama</td>
                <td> <?= $vehiculo->gama ?></td>
            </tr>
            <tr>
                <td>Transmision</td>
                <td> <?= $vehiculo->transmision ?></td>
            </tr>
            <tr>
                <td>Tracción </td>
                <td> <?= $vehiculo->traccion ?></td>
            </tr>
            <tr>
                <td>Fecha del Cambio de Aceite</td>
                <td> <?= $vehiculo->fechaaceite ?></td>
            </tr>
        <tbody>
    </table>
    <label>Foto</label>
    <img src="<?= base_url() ?>/uploads/<?= $vehiculo->foto ?>" style="max-width: 600px; max-height: 600px">
    <?php
}
if (isset($mantenimientos)) {
    ?>
    <h2 class="">Historial de mantenimientos</h2>
    <br>
    <table class="table table-bordered">
        <thead>
        <td>id</td>
        <td>Fecha de inicio</td>
        <td>Fecha de Fin</td>
        <td>Tipo</td>
        <td>Valor</td>
    </thead>
    <tbody> 
        <?php foreach ($mantenimientos as $man) { ?>
            <tr>    
                <td><?= $man->id ?></td>
        <td><?= $man->fecha_ingreso ?></td>
        <td><?= $man->fecha_fin ?></td>
        <td><?= $man->tipo ?></td>
        <td><?= $man->valor ?></td>
        </tr>
    <?php }
    ?>
    </tbody>
    </table>
<?php }
?>
