<?= validation_errors();

if (isset($resultado)){
    if ($resultado=='si'){ ?> 
            <div> <p>Usuario Agregado</p></div>
   <?php }else{
    ?> 
        <div> <p>Error Agregando usuario</p></div>
        <?php    
    }
    
}
?>
<form action="<?= base_url() ?>index.php/gestionarUsuarios/crearUsuario" method="post">
    <label>Nombre Completo:</label>
    <input type="text" name="nombrecompleto" id="nombrecompleto">
    <label>Nick:</label>
    <input type="text" name="nick" id="nick">
    <label>Email:</label>
    <input type="email" name="email" id="email">
    <label>rol:</label>
    <select name="rol" id="rol">
        <?php if (isset($roles)){
            foreach ($roles as $rol){
         ?>
        <option value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
        <?php
            }
        }
                ?>
    </select>
    <label>Contraseña</label>
    <input type="password" name="contra" id="contra">
    <label> repetir Contraseña</label>
    <input type="password" name="repcontra" id="repcontra">
    
    <input type="submit" value="Agregar"> 
</form>