<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function crearObjetoLink($nombre, $ruta){
    
    $obj = (object)array(
    'nombre'=>$nombre,
    'url'=>$ruta);
    return $obj;
    
}
?>
