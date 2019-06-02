<?= form_open("index.php/traveler/modificacionCargo") ?>
<h2>Ingrese el cargo a modificar</h2>
<?php
	$detalleCargo = array(
		'name' => 'detalleCargo',
		'placeholder' => 'Cargo'
	);
	$nuevoDetalleCargo = array(
		'name' => 'nuevoDetalleCargo',
		'placeholder' => 'Nuevo cargo'
	);
?>
<h3>
<?= form_label('Nombre del cargo: ', 'detalleCargo') ?>
<?= form_input($detalleCargo) ?>
<br>
<?= form_label('Nuevo nombre del cargo: ', 'nuevoDetalleCargo') ?>
<?= form_input($nuevoDetalleCargo) ?>
<br>
<?= form_submit('', 'Modificar') ?>
</h3>
<?= form_close() ?>
</body>
</html>