<?= form_open("index.php/elIndeseable/recibirDatos") ?>
<h2>Registrar nuevo infractor</h2>
<?php
	$nombreI = array(
		'name' => 'nombreI',
		'placeholder' => 'Nombre del infractor'
	);
	$apellido = array(
		'name' => 'apellido',
		'placeholder' => 'Apellido del infractor'
	);
	$DNI = array(
		'name' => 'dni',
		'placeholder' => 'DNI del infractor'
	);
?>
<h3>
<?= form_label('Nombre infractor: ', 'nombreI') ?>
<?= form_input($nombreI) ?>
<br>
<br>
<?= form_label('Apellido infractor: ', 'apellido') ?>
<?= form_input($apellido) ?>
<br>
<br>
<?= form_label('DNI infractor: ', 'dni') ?>
<?= form_input($DNI) ?>
<br>
<br>
<?= form_submit('', 'Registrar') ?>
</h3>
<br>
<?= form_close() ?>
</body>
</html>