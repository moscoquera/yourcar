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
        
        <form method="post" class="form-horizontal" onsubmit="return alenviar();">
            <FRAMESET COLS="50%, 50%">
       <br /> <br /> <label>Nombre Completo: </label> <br />
    <input type="text" name="nombrecompleto" id="nombrecompleto">
    
     <br />  <br /> <label>Soy Un(a): </label> <br />
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
   <br /> <br /> <label>Tipo de Documento:</label> <br />
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
   <br /> <br /> <label > N° Documento:</label> <br />
    <input type="text" name="numdoc">
    <br /> <br /> <label class="humano">Fecha De Nacimiento:</label> <br />
    <input class="humano" type="date" name="fechanaci" id="fechanaci">
    <br /> <br /><label>Pais:</label>  <br />
    <input type="text" name="pais">
    <br /> <br /> <label>Ciudad:</label> <br />
    <input type="text" name="ciudad">
    <br /> <br /> <label class="humano">Tipo Sanguineo:</label> <br />
    <input class="humano" name="tiposangre" type="text" maxlength="3">
    <br /> <br /> <label class="humano">Genero:</label> <br />
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
    <br /> <br /> <label class="hotel">Representate:</label> <br />
    <input class="hotel" type="text" name="nombrecontacto">
    <br /> <br /> <label class="hotel">Direccion Representante:</label> <br />
    <input class="hotel"  type="text" name="direccioncontacto">
    <br /> <br /> <label>Telefono:</label> <br />
    <input type="tel" name="telefono">
    <br /> <br /> <label>Nick:</label> <br />
    <input type="text" name="nick" id="nick">
    <br /> <br /> <label>Email:</label> <br />
    <input type="email" name="email" id="email"> <br />
   <br /> <br />  <label>Rol:</label> <br />
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
    <br /> <br /> <label>Contraseña</label> <br />
    <input type="password" name="contra" id="contra">
    <div>
        <br /> <br /> <label> Repetir Contraseña</label> <br />
        <input type="password" name="repcontra" id="repcontra">
    </div>
    <br /> <input type="submit" value="Agregar" class="btn btn-primary"> 
               </FRAMESET>

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