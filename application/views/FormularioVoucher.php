<?php
echo validation_errors('<div class="alert alert-error"> <p>','</p></div>');
if (isset($resultado)) {
    if ($resultado == 'errnocli') {
        ?>

        <div class="alert alert-error"> <p>No existe un Usuario con Dicho numero de Cedula</p></div>
    <?php } else if ($resultado == 'si') { ?>
        <div class="alert alert-success">  <p>Voucher ingresado con exito</p></div>
        <?php
    }
}
?>
<form method="post">
    <label>Numero de Documento del Cliente:</label>
    <input type="text" name="documento">
    <label>Nombre del Cliente:</label>
    <input type="text" name="nombre">
    <label>Franquicia:</label>
    <input type="text" name="franquicia">
    <label>Numero de Autorizacion del Voucher:</label>
    <input type="text" name="autorizacion">
    <label>Monto:</label>
    <input type="number" name="monto" min="0">
    <label>Numero de la Tarjeta:</label>
    <input type="text" name="tarjeta">
    <label>Codigo de Verificación de la tarjeta:</label>
    <input type="text" name="verificacion">
    <label>Banco: </label>
    <input type="text" name="banco">
    <input type="submit" value="Ingresar" name="ingresar">
</form>