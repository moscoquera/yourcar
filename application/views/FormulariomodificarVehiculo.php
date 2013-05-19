<?php
echo validation_errors('<p><b>', '</b></p>');
if (isset($resultado)) {
    if ($resultado == 'nove') {
        ?>
        <div class="alert alert-error"><p>Vehiculo no encontrado</p></div>
    <?php } else if ($resultado == 'si') {
        ?>
        <div class="alert alert-success"><p>informacion Actualizada</p></div>

    <?php } else if ($resultado == 'fotoerr') {
        ?>
        <div class="alert alert-error"><p><?= $error ?></p></div>
        <?php
    } else {
        ?>
        <div class="alert alert-error"><p>Vehiculo no Actualizado</p></div>

        <?php
    }
}
if (isset($vehiculo)) {
    ?>
    <form method="post" enctype="multipart/form-data">
        <br /><br /> <label>Placa:</label>
        <input type="text" name="placa" maxlength="7" value="<?= $vehiculo->placa ?>" readonly="true">
        <br /><br /><label>Marca:</label>
        <input type="text" name="marca" value="<?= $vehiculo->marca ?>">
        <br /><br /><label>Modelo:</label>
        <input type="text" name="modelo" value="<?= $vehiculo->modelo ?>">
        <br /><br /><label> Color</label>
        <input type="text" name="color" value="<?= $vehiculo->color ?>">
        <br /><br /><label>Cilindraje (c.c.):</label>
        <input type="number" name="cilindraje" value="<?= $vehiculo->cilindraje ?>">
        <br /><br /><label>Frenos:</label>
        <select name="frenos">
            <?php
            if (isset($frenos)) {
                foreach ($frenos as $freno) {
                    ?>
                    <option value="<?= $freno->id ?>" <?php
            if ($freno->id == $vehiculo->frenos) {
                echo 'selected="selected"';
            }
                    ?>><?= $freno->nombre ?></option>
                            <?php
                        }
                    }
                    ?>
        </select>
        <br /><br /><label>Direccion:</label>
        <select name="direccion">
            <?php
            if (isset($direccion)) {
                foreach ($direccion as $dir) {
                    ?>
                    <option value="<?= $dir->id ?>" <?php
            if ($dir->id == $vehiculo->direccion) {
                echo 'selected="selected"';
            }
                    ?>><?= $dir->nombre ?></option>
                            <?php
                        }
                    }
                    ?>
        </select>
        <br /><br /> <label>Descripcion:</label> <br />
        <textarea name="descripcion"><?= $vehiculo->descripcion ?></textarea>
        <br /><br /><label>Numero de Pasajeros:</label>
        <input type="number" name="pasajeros" min="0" value="<?= $vehiculo->npasajeros ?>">
        <br /><br /><label>Fecha del Soat:</label>
        <input type="date" name="fechasoat" value="<?= $vehiculo->fechasoat ?>">
        <br /><br /><label>Fecha del Seguro:</label>
        <input type="date" name="fechaseg" value="<?= $vehiculo->fechaseguro ?>">
        <br /><br /><label>Fecha revision tecnicomecanica: </label>
        <input type="date" name="fechatec" value="<?= $vehiculo->fecharevision ?>">
        <br /><br /><label>Tarifa:</label>
        <input type="number" name="tarifa" min="0" value="<?= $vehiculo->tarifa ?>">
        <br /><br /><label>Garantia:</label>
        <input type="number" name="garantia" min="0" value="<?= $vehiculo->garantia ?>">

        <label>Kms por Dia:</label> 
        <input type="number" name="kmsdia" min="0" value="<?= $vehiculo->kmsdia?>">  
        <label>Iva (%):</label> 
        <input type="number" name="iva" min="0"  value="<?= $vehiculo->iva?>">  
        <label>Valor Galon de Gasolina:</label> 
        <input type="number" name="gasolina" min="0" value="<?= $vehiculo->valorgasolina?>">  
        <label>Valor Lavada:</label> 
        <input type="number" name="lavada" min="0" value="<?= $vehiculo->valorlavada?>">
        <div>Tiene Airbags:
            <input type="checkbox" name="airbags" value="si" checked="<?= ($vehiculo->airbags == '1')?'true':''?>">
        </div>
        <label>Precio Servicio Conductor:</label>
        <input type="number" name="conductor" min="0" value="<?= $vehiculo->precioconductor ?>">
        <label>Fecha cambio de Aceite:</label>
        <input type="date" name="fechaaceite" value="<?= $vehiculo->fechaaceite ?>">
        <label>Gama:</label>
        <select name="gama">
            <?php
            if (isset($gamas)) {
                foreach ($gamas as $dir) {
                    ?>
                    <option value="<?= $dir->id ?>" <?php
            if ($dir->id == $vehiculo->gama) {
                echo 'selected="selected"';
            }
                    ?>><?= $dir->nombre ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label>Transmision:</label>
        <select name="transmision">
            <?php
            if (isset($transmision)) {
                foreach ($transmision as $dir) {
                    ?>
                    <option value="<?= $dir->id ?>" <?php
            if ($dir->id == $vehiculo->transmision) {
                echo 'selected="selected"';
            }
                    ?>><?= $dir->nombre ?></option>
                        <?php
                }
            }
            ?>
        </select>
        <label>Tracción:</label>
        <select name="traccion">
            <?php
            if (isset($traccion)) {
                foreach ($traccion as $dir) {
                    ?>
                    
                        <option value="<?= $dir->id ?>" <?php
            if ($dir->id == $vehiculo->traccion) {
                echo 'selected="selected"';
            }
                    ?>><?= $dir->nombre ?></option><?php
                }
            }
            ?>
        </select>
        <label>Imagen: (no subir nada para no modificar la imagen actual)</label>
        <img style="max-height: 300px;max-width: 300px" src="<?= base_url()?>uploads/<?= $vehiculo->foto ?>">
        <br>
        <input type="file" name="foto">
        <br>


        <input class="btn btn-info" type="submit" value="Modificar" name="modificar">
    </form>
<?php } else {
    ?>
    <form method="post" action="<?= base_url() ?>index.php/gestionVehiculos/modificarVehiculo">
        <br /><br /><br /><label>Placa</label>
        <input type="search" name="busqueda"><br /><br />
        <input type="submit" value="buscar" name="buscar">
    </form>
    <?php
}
?>