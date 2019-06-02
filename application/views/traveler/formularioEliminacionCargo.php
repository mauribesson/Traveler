<?= form_open("index.php/traveler/eliminacionCargo") ?>
<h2>Buscar cargo</h2>
<?php
	$detalleCargo= array(
		'name' => 'detalleCargo'
	);
?>
<h3>
<?= form_label('Cargo: ', 'detalleCargo') ?>
<?= form_input($detalleCargo) ?>
<br>
<?= form_submit('', 'Buscar') ?>
</h3>
<?= form_close() ?>
</body>
</html>