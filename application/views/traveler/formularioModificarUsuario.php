<?= form_open("index.php/traveler/modificacionUsuario") ?>
<h2>Ingrese el usuario a modificar</h2>
<?php
	$nombreT= array(
		'name' => 'nombreT',
		'placeholder' => 'Nombre de Usuario'
	);
	$nuevoNombreT= array(
		'name' => 'nuevoNombreT',
		'placeholder' => 'Nuevo nombre de Usuario'
	);
?>
<h3>
<?= form_label('Nombre del Usuario: ', 'nombreT') ?>
<?= form_input($nombreT) ?>
<br>
<?= form_label('Nuevo nombre del Usuario: ', 'nuevoNombreT') ?>
<?= form_input($nuevoNombreT) ?>
<br>
<?= form_label('Contraseña: ') ?>
<?= form_password('contrasenia') ?>
<br>
<?= form_submit('', 'Modificar') ?>
</h3>
<?= form_close() ?>
</body>
</html>