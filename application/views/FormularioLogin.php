<?php
echo validation_errors();

$att = array('id' => 'frmingresar');
echo form_open('login/hacerlogin', $att)
?>

<label> nick:</label>
<input type="text" id="nick" name="nick" >
<label>contraseña</label>
<input type="password" name="password" id="password" >
<input type="submit" value="ingresar">


<?= form_close(); ?>
<a href="<?= base_url(); ?>index.php/login/recuperarContrasena">Recuperar Contraseña</a>