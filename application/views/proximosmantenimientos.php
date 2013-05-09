<br><table class="table table-bordered">
    <thead>
    <td>Placa</td>
    <td>Ultima Revision</td>
    <td>Accion</td>
    </thead>
    <tbody>
<?php
if (isset($proximos)){
    foreach ($proximos as $vehiculo){ ?>
        <tr>
            <td><?= $vehiculo->placa ?></td>
            <td><?= ($vehiculo->fecha_ingreso==null)?'Nunca':$vehiculo->fecha_ingreso ?></td>
            <td><a href="<?= base_url()?>index.php/mantenimientos/mantenimientoCorrectivo" >Realizar Mantenimiento</a></td>
        </tr>
  <?php  }
}
?>
    <tbody>
</table><br/>