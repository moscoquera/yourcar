<div>
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
</div>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
        <td>Descripción</td>
    </thead>
    <tbody> 
        <?php foreach ($mantenimientos as $man) { ?>
            <tr>    
                <td><?= $man->id ?></td>
        <td><?= $man->fecha_ingreso ?></td>
        <td><?= $man->fecha_fin ?></td>
        <td><?= $man->tipo ?></td>
        <td><?= $man->valor ?></td>
        <td><?= $man->descripcion ?></td>
        
        </tr>
    <?php }
    ?>
    </tbody>
    </table>
<?php }
?>
