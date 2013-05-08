<?php
echo validation_errors('<b>', '</b>');
if (isset($resultado)) {
    if ($resultado == 'errfecha') {
        ?>
        <b>El rango de fechas no es valido</b>
    <?php
    }else if ($resultado == 'si'){ ?>
        <b>Reserva Creada</b>
   <?php }
}
?>
<form method="post">
    <input type="hidden" name="reserva" value="r">
    <label>Nombre Completo:</label>
    <input type="text" value="<?= $usuario->nombres ?>" disabled="true">
    <label>Email:</label>
    <input type="text" value="<?= $usuario->email ?>" disabled="true">
    <label>tipo de Documento:</label>
    <input type="text" value="<?= $usuario->tipo_doc ?>" disabled="true">
    <label>Numero de Documento:</label>
    <input type="text" value="<?= $usuario->ndocumento ?>" disabled="true">
    <label>Direccion:</label>
    <input type="text" value="<?= $usuario->direccion ?>" disabled="true">
    <?php if (isset($vehiculo)){ ?>
    <h2>Vehiculo</h2>
    <input type="hidden" value="<?= $vehiculo->placa ?>" name="placa"> 
    <label>Marca:</label>
    <input type="text" value="<?= $vehiculo->marca ?>" disabled="true">
    <label>Modelo:</label>
    <input type="text" value="<?= $vehiculo->modelo ?>" disabled="true">
    <label>Color:</label>
    <input type="text" value="<?= $vehiculo->color ?>" disabled="true">
    <label>Cilindraje:</label>
    <input type="text" value="<?= $vehiculo->cilindraje ?>" disabled="true">
    <label>Frenos:</label>
    <input type="text" value="<?= $vehiculo->frenos ?>" disabled="true">
    <label>Direccion:</label>
    <input type="text" value="<?= $vehiculo->direccion ?>" disabled="true">
    <label>Pasajeros:</label>
    <input type="text" value="<?= $vehiculo->npasajeros ?>" disabled="true">
    <?php }else{ ?>
    <label>Vehiculo:</label>
    <select name="placa"> <?php
       if (isset($vehiculos)){
           foreach ($vehiculos as $vehiculo){ ?>
        <option value="<?= $vehiculo->placa ?>" <?= set_select('placa',$vehiculo->placa)?>><?= $vehiculo->marca."=>".$vehiculo->modelo?></option>
          <?php }
       } 
    ?> </select>
    <?php } ?>
    
    <label>Fecha y Hora de inicio:</label>
    <div id="horainicio" class="input-append date">
        <input data-format="dd/MM/yyyy hh:mm" type="text" name="horainicio" value="<?= set_value('horainicio', (isset($horainicio)) ? $horainicio : '') ?>">
        <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
        </span>
    </div>
    <label>Fecha y Hora de Fin: </label>
    <div id="horafin" class="input-append date">
        <input data-format="dd/MM/yyyy hh:mm" type="text" name="horafin" value="<?= set_value('horafin', (isset($horafin)) ? $horafin : '') ?>">
        <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
            </i>
        </span>
    </div>
    <label>Ciudad o Lugar de la Entrega:</label>
    <select name="lugarentrega">
        <?php
        if (isset($lugares)) {
            foreach ($lugares as $lugar) {
                if (!isset($lugarentrega)) {
                    ?>
                    <option value="<?= $lugar->id ?>"<?= set_select('lugarentrega', $lugar->id) ?>><?= $lugar->nombre ?></option>
                <?php } else { ?>
                    <option value="<?= $lugar->id ?>" <?php
                    if ($lugarentrega == $lugar->id) {
                        echo "selected='true'";
                    }
                    ?>> <?= $lugar->nombre ?></option>
                            <?php
                        }
                    }
                }
                ?>
    </select>

    <label>Ciudad o Lugar de la Recepción:</label>
    <select name="lugarrecepcion">
        <?php
        if (isset($lugares)) {
            foreach ($lugares as $lugar) {
                if (!isset($lugarrecepcion)) {
                    ?>
                    <option value="<?= $lugar->id ?>"<?= set_select('lugarrecepcion', $lugar->id) ?>><?= $lugar->nombre ?></option>
                <?php } else { ?>
                    <option value="<?= $lugar->id ?>" <?php
                if ($lugarrecepcion == $lugar->id) {
                    echo "selected='true'";
                }
                    ?> ><?= $lugar->nombre ?></option>

                    <?php
                }
            }
        }
        ?>
    </select>

<?php if (isset($costo)) { ?>
        <label><b>Costo: <?= $costo ?></b></label>
<?php }
?>
    <input type="submit" value="Reservar" name="btnreservar">
</form>

<script type="text/javascript">
    $(function() {
        $('#horainicio').datetimepicker();
        $('#horafin').datetimepicker();
    });

</script>
