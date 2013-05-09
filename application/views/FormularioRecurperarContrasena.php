<?php
    echo validation_errors();
?>

<form method="post">
     <br> </br>
    <label>Nick:</label>
    <input type="text" name="nick">
    <label>Nombre Completo:</label>
    <input type="text" name="nombre">
    <label> Documento:</label>
    <input type="text" name="documento">
    <input type="submit" value="Recuperar" name="recuperar">
</form>