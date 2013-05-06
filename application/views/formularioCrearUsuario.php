<?=
validation_errors();

if (isset($resultado)) {
    if ($resultado == 'si') {
        ?> 
        <div> <p>Usuario Agregado</p></div>
    <?php } else {
        ?> 
        <div> <p>Error Agregando usuario</p></div>
        <?php
    }
}
?>
        <form action="<?= base_url() ?>index.php/gestionarUsuarios/crearUsuario" method="post" class="form-horizontal" onsubmit="return alenviar();">
    <label>Nombre Completo:</label>
    <input type="text" name="nombrecompleto" id="nombrecompleto">
    
    <label>soy un(a): </label>
    <select name="tipo" id="tipo" onchange="oncambio()">
        <?php
        if (isset($tipousuarios)) {
            foreach ($tipousuarios as $tipo) {
                ?>
                <option value="<?= $tipo->id ?>"><?= $tipo->nombre ?></option>
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
                <option value="<?= $tipo->id ?>"><?= $tipo->nombre ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label >documento N°:</label>
    <input type="text" name="numdoc">
    <label class="humano">fecha de Nacimiento:</label>
    <input class="humano" type="date" name="fechanaci" id="fechanaci">
    <label>pais:</label>
    <input type="text" name="pais">
    <label>ciudad:</label>
    <input type="text" name="ciudad">
    <label class="humano">tipo sanguineo:</label>
    <input class="humano" name="tiposangre" type="text" maxlength="3">
    <label class="humano">genero:</label>
    <select class="humano" name="genero">
        <?php
        if (isset($generos)) {
            foreach ($generos as $gen) {
                ?>
                <option value="<?= $gen->id ?>"><?= $gen->nombre ?></option>   
                <?php
            }
        }
        ?>
    </select>
    <label class="hotel">Representate:</label>
    <input class="hotel" type="text" name="nombrecontacto">
    <label class="hotel">Direccion Representante:</label>
    <input class="hotel"  type="text" name="direccioncontacto">
    <label>Telefono:</label>
    <input type="tel" name="telefono">
    <label>Nick:</label>
    <input type="text" name="nick" id="nick">
    <label>Email:</label>
    <input type="email" name="email" id="email">
    <label>rol:</label>
    <select name="rol" id="rol">
        <?php
        if (isset($roles)) {
            foreach ($roles as $rol) {
                ?>
                <option value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label>Contraseña</label>
    <input type="password" name="contra" id="contra">
    <div>
        <label> repetir Contraseña</label>
        <input type="password" name="repcontra" id="repcontra">
    </div>
    <input type="submit" value="Agregar" class="btn btn-primary"> 
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