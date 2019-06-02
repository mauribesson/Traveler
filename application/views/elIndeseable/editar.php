<?= form_open("index.php/elIndeseable/actualizar/".$DNI) ?>
<?php
	$nombreI = array(
		'name' => 'nombreI',
		'placeholder' => 'Nombre',
		'value' => $Infractor->result()[0]->nombreI
		);
	$apellido = array(
		'name' => 'apellido',
		'placeholder' => 'Apellido',
		'value' => $Infractor->result()[0]->apellido
		);
	$dni = array(
		'name' => 'dni',
		'placeholder' => 'Dni',
		'value' => $Infractor->result()[0]->dni
		);
?>
<?= form_label('Nombre: ', 'nombreI') ?>
<?= form_input($nombreI) ?>
<br>
<?= form_label('Apellido', 'apellido') ?>
<?= form_input($apellido) ?>
<br>
<?= form_label('DNI', 'dni') ?>
<?= form_input($dni) ?>
<br>
<?= form_submit('', 'Actualizar') ?>
<?= form_close() ?>
</body>
</html>