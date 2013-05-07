<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($disponibles)) {
    ?>

    <table style="border: 2px black solid;">
        <thead>
        <td>Placa</td>
        <td>Marca</td>
        <td>Modelo</td>
        <td>Color</td>
        <td>Cilindraje (c.c.)</td>
    </thead>
    <tbody><?php foreach ($disponibles as $vehiculo) { ?>
            <tr>
                <td><a href="<?= base_url()?>index.php/gestionVehiculos/ver/<?= $vehiculo->placa ?>"><?= $vehiculo->placa ?></a></td>
                <td><?= $vehiculo->marca ?></td>
                <td><?= $vehiculo->modelo ?></td>
                <td><?= $vehiculo->color ?></td>
                <td align="center"><?= $vehiculo->cilindraje ?></td>
            </tr>
    <?php }
    ?> </tbody>
    </table>


        <?php
    } else {
        
    }
    ?>
