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
    <label>Politicas de la Empresa:</label>
    <textarea name="polempresa"><?= set_value('polempresa',$polempresa) ?></textarea>
    <label>Mision:</label>
    <textarea name="mision"><?= set_value('mision',$mision) ?></textarea>
    <label>Vision:</label>
    <textarea name="vision"><?= set_value('vision',$vision) ?></textarea>
    <label>Objetivos:</label>
    <textarea name="objetivos"><?= set_value('objetivos',$objetivos) ?></textarea>
    <input type="submit" name="actualizar" value="Actualizar">
</form>