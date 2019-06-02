<?php
$data = array(
	'dni' => $dni
	);
?>
<?= form_open("index.php/elIndeseable/modificarInfractor/$dni") ?>
<img src="Desktop/Logo.png">
<h2>Modificación datos del infractor</h2>
<?php
	$nombreI = array(
		'name' => 'nombreI',
		'placeholder' => 'Nombre del infractor'
	);
	$apellido = array(
		'name' => 'apellido',
		'placeholder' => 'Apellido del infractor'
	);
?>
<h3>
<?= form_label('Nombre del infractor: ', 'nombreI') ?>
<?= form_input($nombreI) ?>
<br>
<?= form_label('Apellido del infractor: ', 'apellido') ?>
<?= form_input($apellido) ?>
<br>
<?= form_submit('', 'Modificar') ?>
</h3>
<?= form_close() ?>
</body>
</html>