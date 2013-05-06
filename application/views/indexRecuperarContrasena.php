<?php
if (isset($resultado)) {
    if ($resultado == 'si') {
        ?>
        <p>Si usted ingreso los datos correctamente, recibira una nueva contraseña a su correo electronico</p>
        <?
    } else {
        ?>
        <p>Usuario no Encontrado</p>
        <?php
    }
}
?>
<p>
    por favor elija una opcion para recuperar su contraseña:
<form method="post">
    Diligenciando un formulario<input type="radio" value="formulario" name="opcion">
    <br/>
    <input type="submit" value="continuar">
</form>
</p>