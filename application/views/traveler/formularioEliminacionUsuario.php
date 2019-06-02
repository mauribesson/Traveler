<?= form_open("index.php/traveler/eliminacionUsuario") ?>
<h2>Buscar usuario</h2>
<?php
	$nombreT= array(
		'name' => 'nombreT'
	);
?>
<h3>
<?= form_label('Nombre del usuario: ', 'nombreT') ?>
<?= form_input($nombreT) ?>
<br>
<?= form_submit('', 'Buscar') ?>
</h3>
<?= form_close() ?>
</body>
</html>