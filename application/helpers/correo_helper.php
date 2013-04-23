<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function nuevoEmailRegistro($nombre,$nick,$contra){
    $texto="";
    $texto="Hola $nombre. \n";
    $texto.="Recibe este email, dado que se a creado una nueva cuenta a su nombre \n";
    $texto.="puede acceder al sistema usando: \n";
    $texto.="nombre de usuario: $nick \n";
    $texto.="contraseña: $contra\n";
    return $texto;
    
}
?>
