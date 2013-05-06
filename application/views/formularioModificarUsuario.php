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
        <label>Nick:</label>
        <input type="text" name="nick" id="nick" value="<?= $usuario->nick?>" readonly="true">
        
        
        <label>Nombre Completo:</label>
        <input type="text" name="nombrecompleto" id="nombrecompleto" value="<?= $usuario->nombres ?>">

        <label>soy un(a): </label>
        <select name="tipo" id="tipo" onchange="oncambio()">
            <?php
            if (isset($tipousuarios)) {
                foreach ($tipousuarios as $tipo) {
                    ?>
                    <option value="<?= $tipo->id ?>" <?php if ($tipo->id == $usuario->tipo){echo 'selected="selected"';}?> ><?= $tipo->nombre ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label>Tipo de Documento:</label>
        <select name="tipodoc">
            <?php
            if (isset($documentos)) {
                foreach ($documentos as $tipo) {
                    ?> 
                    <option value="<?= $tipo->id ?>" <?php if ($tipo->id == $usuario->tipo_doc){echo 'selected="selected"';}?>><?= $tipo->nombre ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label >documento N°:</label>
        <input type="text" name="numdoc" value="<?= $usuario->ndocumento?>">
        <label class="humano">fecha de Nacimiento:</label>
        <input class="humano" type="date" name="fechanaci" id="fechanaci" value="<?= $usuario->fechanacimiento ?>">
        <label>pais:</label>
        <input type="text" name="pais" value="<?= $usuario->pais ?>">
        <label>ciudad:</label>
        <input type="text" name="ciudad" value="<?= $usuario->ciudad ?>">
        <label class="humano">tipo sanguineo:</label>
        <input class="humano" name="tiposangre" type="text" maxlength="3" value="<?= $usuario->tiposangre ?>">
        <label class="humano">genero:</label>
        <select class="humano" name="genero">
            <?php
            if (isset($generos)) {
                foreach ($generos as $gen) {
                    ?>
                    <option value="<?= $gen->id ?>" <?php if ($tipo->id == $usuario->genero){echo 'selected="selected"';}?> ><?= $gen->nombre ?></option>   
                    <?php
                }
            }
            ?>
        </select>
        <label class="hotel">Representate:</label>
        <input class="hotel" type="text" name="nombrecontacto" value="<?= $usuario->nombre ?>">
        <label class="hotel">Direccion Representante:</label>
        <input class="hotel"  type="text" name="direccioncontacto" value="<?= $usuario->direccion ?>">
        <label>Telefono:</label>
        <input type="tel" name="telefono" value="<?= $usuario->telefono ?>">
        <label>Email:</label>
        <input type="email" name="email" id="email" value="<?= $usuario->email ?>">
        <label>rol:</label>
        <select name="rol" id="rol">
            <?php
            if (isset($roles)) {
                foreach ($roles as $rol) {
                    ?>
                    <option value="<?= $rol->id ?>" <?php if ($rol->id == $usuario->rol_id){echo 'selected="selected"';}?>><?= $rol->nombre ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label>Contraseña: <b><u> =>(Dejar en blanco para no cambiar la contraseña) </u></b></label>
        <input type="password" name="contra" id="contra">
        <div>
            <label> repetir Contraseña</label>
            <input type="password" name="repcontra" id="repcontra">
        </div>
        <input type="submit" value="Guardar" class="btn btn-primary"> 
    </form>
    <script type="text/javascript">
        $(document).ready(oncambio());

        function oncambio() {
            var elem = $('#tipo').val();
            //es humano    
            if (elem === '1') {
                $('.humano').show();
                $('.hotel').hide();

            } else {
                $('.humano').hide();
                $('.hotel').show();

            }
        }
        
        function alenviar(){
            if ($('#tipo').val() === '1'){
                var fechan = $('#fechanaci').val().split('-');
                fechan = new Date(parseInt(fechan[0]),parseInt(fechan[1])-1,parseInt(fechan[2]),0,0,0,0);
                fechan = fechan.getTime();
                var hoy = (new Date()).getTime();
                if (hoy<fechan){
                    alert('fecha de nacimiento no valida');
                    return false;
                }
               
            }
            return true;
        }
</script>
        
    <?php
} else {
    ?>
    <p>Usuario no valido</p>
    <?php
}
?>
