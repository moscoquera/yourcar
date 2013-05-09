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
    <br> </br>
    por favor elija una opcion para recuperar su contraseña:
<form method="post">
    <br> <br/>
    <tr>
   <td> Diligenciando un formulario<td/> 
       <td><input type="radio" value="formulario" name="opcion"><td/>
    <tr/>
   <br> <br/>
    <input type="submit" value="continuar">
</form>
</p>