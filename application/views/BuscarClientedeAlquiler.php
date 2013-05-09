<form method="post">
    <label>Buscar Cliente por Documento:</label>
    <input type="text" name="documento">
    <input type="submit" name="buscar" value="buscar">
        
</form>

<?php

if (isset($resultado)) {
    if ($resultado=='si'){ ?>
<h2><?= $usuario->nombres ?></h2>
<table class="table table-bordered">
    <thead>
        <td>id</td>
        <td>Franquicia</td>
        <td>Numero de Voucher</td>
        <td>Numero de Verificacion</td>
        <td>Monto</td>
        <td>Numero de Tarjeta</td>
        <td>Banco</td>
    </thead>
    <tbody>
        <?php
         foreach ($vouchers as $voucher){?>
        <td><?= $voucher->id ?></td>
        <td><?= $voucher->franquicia ?></td>
        <td><?= $voucher->numvoucher ?></td>
        <td><?= $voucher->codverificacion ?></td>
        <td><?= $voucher->monto ?></td>
        <td><?= $voucher->nuntarjeta ?></td>
        <td><?= $voucher->banco ?></td>
       <?php  }
        ?>
    </tbody>
</table>
 <?php   }else if ($resultado=='no'){ ?>
<b>No existe un usuario con ese numero de documento</b>
   <?php }
    
}
?>