
<div class="row">

    <div id="menunavegacionpublico" class="span2">
        <ul class="nav nav-list">
            <?php if (!isset($usuario)) { ?>
                <li id="linkcuenta">
                    <a href="<?= base_url() ?>index.php/login">INGRESAR</a>
                </li><br /> 


                <br /> <br /> <li id="linkcrearcuenta"><a href="<?= base_url() ?>index.php/login/crearCuenta">SOLICITAR LA CUENTA </a></li><br /> 
                <br /> <br /> <li id="linkrecuperar"><a href="<?= base_url() ?>index.php/login/recuperarContrasena">Recuperar la Contraseña </a></li><br /> 
            <?php } else { ?>

                <br /> <br /> <li class="active" id="linkcuenta"><?= $usuario->nombres ?></li> <br />
                <br /> <li id="linksalir"><a class="btn btn-warning" href="<?= base_url() ?>index.php/login/salir">SALIR</a></li><br />
                <?php
            }
            ?>        
        </ul>  


    </div>

    <div class="span9">
           <form method="post">
            <div class="span4">
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
                    
                </div>
                <div class="spam4">
                    <label>Garantia(Voucher):</label> 
                    <input type="number" name="garantia" min="0">  
                    <div>Tiene Airbags:
                        <input type="checkbox" name="airbags" value="si">
                    </div>
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

                </div>
            <input type="submit" value="Filtrar" class="btn btn-success" name="filtrar"> 
        </form>
    </div>
   
</div>
<div class="row">
    <table class="table table-bordered">
            <thead>
            <td>MARCA:</td> 
            <td>MODELO:</td>
            <td>COLOR:</td>
            <td>CILINDRAJE:</td>
            <td>FRENOS:</td>
            <td>DIRECCION:</td>
            <td>PASAJEROS:</td>
            <td>TARIFA:</td>
            <td>VALOR DEL VOUCHER: </td>
            <td>Foto:</td>
            <td>OPCION</td>
            </thead>
            <?php
            if (isset($vehiculos)) {
                foreach ($vehiculos as $vehiculo) {
                    ?>
                    <tr>
                        <td><?= $vehiculo->marca ?></td>
                        <td><?= $vehiculo->modelo ?></td>
                        <td><?= $vehiculo->color ?></td>
                        <td><?= $vehiculo->cilindraje ?></td>
                        <td><?= $vehiculo->frenos ?></td>
                        <td><?= $vehiculo->direccion ?></td>
                        <td><?= $vehiculo->npasajeros ?></td>
                        <td><?= $vehiculo->tarifa ?></td>
                        <td><?= $vehiculo->garantia ?></td>
                        <td><a href="<?= base_url() ?>/uploads/<?= $vehiculo->foto?>"><img src="<?= base_url() ?>/uploads/<?= $vehiculo->foto?>"></a></td>
                        <td>
                            <a class="btn btn-primary" href="<?= base_url() ?>index.php/centro/cotizacion/<?= $vehiculo->placa ?>">Cotizar</a>
                            <a class="btn btn-success" href="<?= base_url() ?>index.php/gestorReservas/reservar/<?= $vehiculo->placa ?>">Reservar</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    
</div>