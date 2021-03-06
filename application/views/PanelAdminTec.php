<div>
    <ul>
        <br><br/><li><a href="<?= base_url() ?>index.php/gestionarUsuarios/crearUsuario">Crear Usuario</a></li>
    </ul>
</div>
<div>
    <?php
    if (isset($usuarios)) {
        ?>
        <br><br/>
       <table class="table table-bordered">
            <tr>
                <th>NICK</th>
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th>ROL</th>
                <th>OPCIONES</th>
            </tr>

            <?php
            foreach ($usuarios as $usr) {
                ?>
                <tr>
                    <td><?= $usr->nick ?></td>
                    <td><?= $usr->nombres ?></td>
                    <td><?= $usr->email ?></td>
                    <td><?= $usr->rol ?></td>
                    <td>
                        <a href="<?= base_url()?>index.php/gestionarUsuarios/modificarUsuario/<?= $usr->nick ?>">Editar</a>
                        |
                        <a href="<?= base_url()?>index.php/gestionarUsuarios/eliminarUsuario/<?= $usr->nick ?>">Eliminar</a>
                    </td>
                </tr>
                <?php }
            ?>
        </table>
        <?php
    }
    ?>
</div>