<?php
echo validation_errors();
if (isset($resultado)) {
    if ($resultado == 'si') {
        ?>
        <b>Información Actualizada</b>
    <?php
    }
}
?>
<form method="post">
    <br/> <br/><label>Politicas de la Empresa:</label>
    <textarea name="polempresa"><?= set_value('polempresa',$polempresa) ?></textarea>
    <br/><br/><label>Mision:</label>
    <textarea name="mision"><?= set_value('mision',$mision) ?></textarea>
    <br/><br/><label>Vision:</label>
    <textarea name="vision"><?= set_value('vision',$vision) ?></textarea>
    <br/><br/><label>Objetivos:</label>
    <textarea name="objetivos"><?= set_value('objetivos',$objetivos) ?></textarea> <br/><br/>
    <input type="submit" name="actualizar" value="Actualizar">
</form>