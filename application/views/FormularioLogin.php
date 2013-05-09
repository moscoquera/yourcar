<?php
echo validation_errors();

$att = array('id' => 'frmingresar');
echo form_open('login/hacerlogin', $att)
?>

<br /> <br /> <br /> <label> NICK:</label> 
<input type="text" id="nick" name="nick" >
<br /> <br /><label>CONTRASEÑA</label>  
<input type="password" name="password" id="password" >
<input type="submit" value="INGRESAR">


<?= form_close(); ?>
<a href="<?= base_url(); ?>index.php/login/recuperarContrasena">RECUPERAR CONTRASEÑA</a>