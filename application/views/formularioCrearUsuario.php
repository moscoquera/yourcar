<?php
echo validation_errors('<div class="alert alert-error"> <p>', '</p></div>');

if (isset($resultado)) {
    if ($resultado == 'si') {
        ?> 
        <div class="alert alert-success"> <p>Usuario Agregado</p></div>
        <?php
    } elseif ($resultado == 'no') {
        if (isset($error)) {
            if ($error == 'email') {
                ?> 
                <div class="alert alert-error"> <p>El Email ya esta en Uso</p></div>
                <?php
            } else if ($error == 'nick') {
                ?> 
                <div class="alert alert-error"> <p>El nick ya esta en uso</p></div>
                <?php
            } elseif ($error == 'doc') {
                ?> 
                <div class="alert alert-error"> <p>El numero de documento ya esta en nuestra base de datos</p></div>
                <?php
            }
        } else {
            ?> 
            <div class="alert alert-error"> <p>Error Agregando usuario</p></div>
            <?php
        }
    } else {
        ?> 
        <div class="alert alert-error"> <p>Error Agregando usuario</p></div>
        <?php
    }
}
?>
<div style="margin-bottom: 50px !important" class="row">
    <form method="post" class="form-horizontal" onsubmit="return alenviar();">
        <div class="span4">
            <label>Nombre Completo: </label>
            <input type="text" name="nombrecompleto" id="nombrecompleto">

            <label>Soy Un(a): </label> 
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
            <label > N° Documento:</label> 
            <input type="text" name="numdoc">
            <label class="humano">Fecha De Nacimiento:</label> 
            <input class="humano" type="date" name="fechanaci" id="fechanaci">
            <label>Pais:</label>  
            <input type="text" name="pais">
            <label>Ciudad:</label> 
            <input type="text" name="ciudad">
            <label class="humano">Tipo Sanguineo:</label> 
            <input class="humano" name="tiposangre" type="text" maxlength="3">
            <label class="humano">Genero:</label> 
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
        </div>
        <div class="offset2 span4">
            <label class="hotel">Representate:</label> 
            <input class="hotel" type="text" name="nombrecontacto">
            <label>Direccion:</label> 
            <input  type="text" name="direccioncontacto">
            <label>Telefono fijo:</label> 
            <input type="tel" name="telefono">
            <label>Celular:</label> 
            <input type="tel" name="celular">
            <label>Nick:</label> 
            <input type="text" name="nick" id="nick">
            <label>Email:</label> 
            <input type="email" name="email" id="email"> 
            <label>Rol:</label> 
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
                <label> Repetir Contraseña</label> 
                <input type="password" name="repcontra" id="repcontra">
            </div>
            <input type="submit" value="Agregar" class="btn btn-primary"> 
        </div>

    </form>
</div>

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

        function alenviar() {
            if ($('#tipo').val() === '1') {
                var fechan = $('#fechanaci').val().split('-');
                fechan = new Date(parseInt(fechan[0]), parseInt(fechan[1]) - 1, parseInt(fechan[2]), 0, 0, 0, 0);
                fechan = fechan.getTime();
                var hoy = (new Date()).getTime();
                if (hoy < fechan) {
                    alert('fecha de nacimiento no valida');
                    return false;
                }

            }
            return true;
        }
</script>