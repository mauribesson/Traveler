<?= form_open("index.php/traveler/recibirCargo") ?>
<h2>Nuevo Cargo</h2>
<?php
	$detalleCargo = array(
		'name' => 'detalleCargo',
		'placeholder' => 'Cargo'
	);
?>
<h3>
<?= form_label('Cargo: ', 'detalleCargo') ?>
<?= form_input($detalleCargo) ?>
<br>
<?= form_submit('', 'Registrar') ?>
</h3>
<?= form_close() ?>
</body>
</html>