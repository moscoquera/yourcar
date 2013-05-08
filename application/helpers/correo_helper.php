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

function nuevaContrasena($nombre,$nick,$contra){
    $texto="";
    $texto="Hola $nombre. \n";
    $texto.="Recibe este email, dado que se a creado una nueva contraseña para se cuenta\n";
    $texto.="puede acceder al sistema usando: \n";
    $texto.="nombre de usuario: $nick \n";
    $texto.="contraseña: $contra\n";
    return $texto;
}

function nuevaPagoReserva($id,$nick,$nombre,$documento){
    $texto="";
    $texto="Hola \n";
    $texto.="EL usuario $nick ha ingresado un nuevo comprobante de pago\n";
    $texto.="para la reserva $id\n\n\n";
    $texto.="La información del Cliente es la Siguiente:\n";
    $texto.="Nombre Completo: $nombre";
    $texto.="Documento N°: $documento";
    $texto.="Reserva N°: $id";
    return $texto;
}
?>
