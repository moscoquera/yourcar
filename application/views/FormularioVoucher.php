<?php
echo validation_errors();
if (isset($resultado)) {
    if ($resultado == 'errnocli') {
        ?>

        <b>No existe un Usuario con Dicho numero de Cedula</b>
    <?php } else if ($resultado == 'si') { ?>
        <b>Voucher ingresado con exito</b>
    <?php
    }
}
?>
<form method="post">
    <label>Numero de Documento:</label>
    <input type="text" name="documento">
    <label>Franquicia:</label>
    <input type="text" name="franquicia">
    <label>Numero de Autorizacion del Voucher:</label>
    <input type="text" name="autorizacion">
    <label>Numero de Verificación de la Transaccion:</label>
    <input type="text" name="verificacion">
    <label>Monto:</label>
    <input type="number" name="monto" min="0">
    <label>Numero de la Tarjeta:</label>
    <input type="text" name="tarjeta">
    <label>Banco: </label>
    <input type="text" name="banco">
    <input type="submit" value="Ingresar" name="ingresar">
</form>