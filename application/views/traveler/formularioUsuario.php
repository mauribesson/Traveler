<?= form_open("index.php/traveler/recibirUsuario") ?>
<h2>Registrar nuevo usuario</h2>
<?php
	$nombreT = array(
		'name' => 'nombreT',
		'placeholder' => 'Nombre del usuario'
	);
?>
<h3>
<?= form_label('Nombre del usuario: ', 'nombreT') ?>
<?= form_input($nombreT) ?>
<br>
<br>
<?= form_label('Contraseña: ') ?>
<?= form_password('contrasenia') ?>
<br>
<br>
<?= form_submit('', 'Registrar') ?>
</h3>
<br>
<?= form_close() ?>
</body>
</html>