<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($resultado)){
    if ($resultado=='si'){ ?>
    <b>Comprobate Ingresado con Exito</b>
    <?php }else if ($resultado=='noup'){ ?>
    <b><?=$error ?></b>
  <?php  }
}

if (isset($reserva)){ 
    echo form_open_multipart(null,array('method'=>'post'));
    ?>

    <label>ID: <?= $reserva->id ?></label>
    <label>Precio: <?= $reserva->precio ?></label>
    <label>Fecha de Inicio: <?= $reserva->fechainicio ?></label>
    <label>Fecha de Fin: <?= $reserva->fechafin ?></label>
    <label>Lugar de Inicio: <?= $reserva->lugarinicio ?></label>
    <label>Lugar de Fin: <?= $reserva->lugarfin ?></label>
    <label>Comprobante:</label>
    <input type="file" name="comprobante">
    <input type="submit" value="Guardar" name="btnguardar">
</form>

<?php }
?>
