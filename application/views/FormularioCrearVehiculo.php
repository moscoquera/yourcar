<?php
echo validation_errors('<div class="alert alert-error">', '</p></div>');

if (isset($estado)) {
    if ($estado == 'si') {
        ?>
        <div class="alert alert-success"><p>Vehiculo Agregado</p></div>
    <?php } else if ($estado == 'no'){
        ?>
        <div class="alert alert-error"><p>Error agregando vehiculo</p></div>
        <?php
    } else if ($estado == 'fotoerr'){ ?>
        <div class="alert alert-error"><p><?= $error ?></p></div>
   <?php }
}
?>
<form action="<?= base_url() ?>index.php/gestionVehiculos/crearVehiculo" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="span4">
            <label>Placa:</label>
            <input type="text" name="placa" maxlength="7">
            <label>Marca:</label>
            <input type="text" name="marca">
            <label>Modelo:</label>
            <input type="text" name="modelo">
            <label> Color</label>
            <input type="text" name="color">
            <label>Cilindraje (c.c.):</label>
            <input type="number" name="cilindraje">
            <label>Frenos:</label>
            <select name="frenos">
                <?php
                if (isset($frenos)) {
                    foreach ($frenos as $freno) {
                        ?>
                        <option value="<?= $freno->id ?>"><?= $freno->nombre ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <label>Direccion:</label>
            <select name="direccion">
                <?php
                if (isset($direccion)) {
                    foreach ($direccion as $dir) {
                        ?>
                        <option value="<?= $dir->id ?>"><?= $dir->nombre ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <label>Descripcion:</label>
            <textarea name="descripcion"></textarea>
        </div>
        <div class="span4 offset2">
            <label>Numero de Pasajeros:</label>
            <input type="number" name="pasajeros" min="0">
            <label>Fecha del Soat:</label>
            <input type="date" name="fechasoat">
            <label>Fecha del Seguro:</label>
            <input type="date" name="fechaseg">
            <label>Fecha revision tecnicomecanica: </label>
            <input type="date" name="fechatec">
            <label>Tarifa por dia:</label>
            <input type="number" name="tarifa" min="0">
            <label>Garantia(Voucher):</label> 
            <input type="number" name="garantia" min="0">  
            <label>Kms por Dia:</label> 
            <input type="number" name="kmsdia" min="0">  
            <label>Iva (%):</label> 
            <input type="number" name="iva" min="0">  
            <label>Valor Galon de Gasolina:</label> 
            <input type="number" name="gasolina" min="0">  
            <label>Valor Lavada:</label> 
            <input type="number" name="lavada" min="0">
            <div>Tiene Airbags:
                <input type="checkbox" name="airbags" value="si">
            </div>
            <label>Precio Servicio Conductor:</label>
            <input type="number" name="conductor" min="0">
            <label>Fecha cambio de Aceite:</label>
            <input type="date" name="fechaaceite">
            <label>Gama:</label>
            <select name="gama">
                <?php
                if (isset($gamas)) {
                    foreach ($gamas as $dir) {
                        ?>
                        <option value="<?= $dir->id ?>"><?= $dir->nombre ?></option>
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
                        <option value="<?= $dir->id ?>"><?= $dir->nombre ?></option>
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
                        <option value="<?= $dir->id ?>"><?= $dir->nombre ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <label>Imagen:</label>
            <input type="file" name="foto">
            
        </div>
    </div>
    <input type="submit" value="Agregar" class="btn btn-success"> 
</form>