<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($estado)){
    if ($estado=='si'){
        ?>
    <p>Usuario Eliminado</p>
            <?php
    }else if ($estado=='error'){
        ?> 
    <p>No se puede eliminar a usted mism@</p>
            <?php
    }else{
        ?>
    <p>Error eliminado usuario </p>
    <?php
        
    }
}


if (isset($usuario)) {
    ?>
    <p>Nick: <b><?= $usuario->nick ?></b></br></p>
    <p>Nombre: <b><?= $usuario->nombres ?></b></br></p>
    <p>Email: <b><?= $usuario->email ?></b></br></p>
    
    <form id="formulario" action="<?= base_url()?>index.php/gestionarUsuarios/eliminarUsuario" method="post" onsubmit="return antes();">
        <input type="hidden" value="<?= $usuario->nick?>" name="nick">
            
        <input type="submit" value="Eliminar" name="eliminar">
    </form>
    
    <?php
}
?>

    <script>
        function antes(){
            return confirm("Esta seguro que desea eliminar a este usuario?");
        }
    </script>