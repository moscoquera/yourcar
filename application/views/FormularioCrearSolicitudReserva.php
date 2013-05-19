<?php
echo validation_errors('<div class="alert alert-error"><p>', '</p></div>');
if (isset($resultado)) {
    if ($resultado == 'errfecha') {
        ?>
        <div class="alert alert-error"><p>El rango de fechas no es valido</p></div>
        <?php } else if ($resultado == 'si') {
        ?>
        <div class="alert alert-success"><p>Reserva Creada</p></div>
    <?php
    }else if ($resultado == 'no'){ 
        if (isset($error)){
            if ($error == 'colision'){ ?>
            <div class="alert alert-error"><p>El vehiculo ya tiene una reserva para uno o mas dias durante las fechas que usted desea reservar. por favor cambie de vehiculo</p></div>
          <?php }
        }
        
    }
}
?>
<form method="post">
    <input type="hidden" name="reserva" value="r">
    <br/> <br/> <label>Nombre Completo:</label>
    <input type="text" value="<?= $usuario->nombres ?>" disabled="true">
    <br/><br/><label>Email:</label>
    <input type="text" value="<?= $usuario->email ?>" disabled="true">
    <br/><br/><label>Tipo de Documento:</label>
    <input type="text" value="<?= $usuario->tipo_doc ?>" disabled="true">
    <br/><br/><label>Numero de Documento:</label>
    <input type="text" value="<?= $usuario->ndocumento ?>" disabled="true">
    <br/><br/><label>Direccion:</label>
    <input type="text" value="<?= $usuario->direccion ?>" disabled="true">
<?php if (isset($vehiculo)) { ?>
        <h2>Vehiculo</h2>
        <input type="hidden" value="<?= $vehiculo->placa ?>" name="placa"> 
        <br/><br/><label>Marca:</label>
        <input type="text" value="<?= $vehiculo->marca ?>" disabled="true">
        <br/><br/><label>Modelo:</label>
        <input type="text" value="<?= $vehiculo->modelo ?>" disabled="true">
        <br/><br/><label>Color:</label>
        <input type="text" value="<?= $vehiculo->color ?>" disabled="true">
        <br/><br/><label>Cilindraje:</label>
        <input type="text" value="<?= $vehiculo->cilindraje ?>" disabled="true">
        <br/><br/><label>Frenos:</label>
        <input type="text" value="<?= $vehiculo->frenos ?>" disabled="true">
        <br/><br/><label>Direccion:</label>
        <input type="text" value="<?= $vehiculo->direccion ?>" disabled="true">
        <br/><br/><label>Pasajeros:</label>
        <input type="text" value="<?= $vehiculo->npasajeros ?>" disabled="true">
<?php } else { ?>
        <br/><br/><label>Vehiculo:</label>
        <select name="placa"> <?php
            if (isset($vehiculos)) {
                foreach ($vehiculos as $vehiculo) {
                    ?>
                    <option value="<?= $vehiculo->placa ?>" <?= set_select('placa', $vehiculo->placa) ?>><?= $vehiculo->marca . "=>" . $vehiculo->modelo ?></option>
                <?php
            }
        }
        ?> </select>
<?php } ?>

    <br/><br/><label>Fecha y Hora de inicio:</label>
    <div id="horainicio" class="input-append date">
        <input data-format="dd/MM/yyyy hh:mm" type="text" name="horainicio" value="<?= set_value('horainicio', (isset($horainicio)) ? $horainicio : '') ?>">
        <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
        </span>
    </div>
    <br/><br/><label>Fecha y Hora de Fin: </label>
    <div id="horafin" class="input-append date">
        <input data-format="dd/MM/yyyy hh:mm" type="text" name="horafin" value="<?= set_value('horafin', (isset($horafin)) ? $horafin : '') ?>">
        <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
        </span>
    </div>
    <br/><br/><label>Ciudad o Lugar de la Entrega:</label>
    <select name="lugarentrega">
        <?php
        if (isset($lugares)) {
            foreach ($lugares as $lugar) {
                if (!isset($lugarentrega)) {
                    ?>
                    <option value="<?= $lugar->id ?>"<?= set_select('lugarentrega', $lugar->id) ?>><?= $lugar->nombre . " ($lugar->valor)" ?></option>
                <?php } else { ?>
                    <option value="<?= $lugar->id ?>" <?php
                            if ($lugarentrega == $lugar->id) {
                                echo "selected='true'";
                            }
                            ?>> <?= $lugar->nombre . " ($lugar->valor)" ?></option>
                            <?php
                        }
                    }
                }
                ?>
    </select>

    <br/><br/><label>Ciudad o Lugar de la Recepción:</label>
    <select name="lugarrecepcion">
        <?php
        if (isset($lugares)) {
            foreach ($lugares as $lugar) {
                if (!isset($lugarrecepcion)) {
                    ?>
                    <option value="<?= $lugar->id ?>"<?= set_select('lugarrecepcion', $lugar->id) ?>><?= $lugar->nombre . " ($lugar->valor)" ?></option>
                <?php } else { ?>
                    <option value="<?= $lugar->id ?>" <?php
                            if ($lugarrecepcion == $lugar->id) {
                                echo "selected='true'";
                            }
                            ?> ><?= $lugar->nombre . " ($lugar->valor)" ?></option>

                    <?php
                }
            }
        }
        ?>
    </select>

    <?php if (isset($costo)) { ?>
        <br/><br/><label><b>Costo: <?= $costo ?></b></label>
<?php }
?>
    <br/><br/><input type="submit" value="Reservar" name="btnreservar">
</form>

<script type="text/javascript">
    $(function() {
        $('#horainicio').datetimepicker();
        $('#horafin').datetimepicker();
    });

</script>
