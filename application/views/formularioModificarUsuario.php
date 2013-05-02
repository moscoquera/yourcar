<?php
echo validation_errors();

if (isset($resultado)) {
    if ($resultado == 'si') {
        ?>
        <p>Usuario modificado con exito</p>
        <?php
    } else {
        ?>
        <p>Error modificando al Usuario</p>
        <?php
    }
}

if (isset($usuario)) {
    ?>
    <form action="<?= base_url() ?>index.php/gestionarUsuarios/modificarUsuario/<?= $usuario->nick ?>" method="post">
        <label>Nombre Completo:</label>
        <input type="text" name="nombrecompleto" id="nombrecompleto" value="<?= $usuario->nombres ?>">
        <label>Nick:</label>
        <input type="text" name="nick" id="nick" value="<?= $usuario->nick ?>"  readonly="readonly">
        <label>Email:</label>
        <input type="email" name="email" id="email" value="<?= $usuario->email ?>">
        <label>rol:</label>
        <select name="rol" id="rol">
    <?php
    if (isset($roles)) {
        foreach ($roles as $rol) {
            ?>
                    <option value="<?= $rol->id ?>" <?= ($rol->id == $usuario->rol_id) ? 'selected="selected"' : '' ?>><?= $rol->nombre ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label>Contraseña (dejar en blanco para no modificar)</label>
        <input type="password" name="contra" id="contra">
        <label> repetir Contraseña</label>
        <input type="password" name="repcontra" id="repcontra">

        <input type="submit" value="Guardar"> 
    </form>
    <?php
} else {
    ?>
    <p>Usuario no valido</p>
    <?php
}
?>
