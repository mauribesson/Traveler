<?= form_open("index.php/traveler/recibirBusquedaHabitacion") ?>
<h2>Buscar una habitación</h2>
<?php
	$numHab = array(
		'name' => 'numHab',
		'placeholder' => 'Número de habitación'
	);
?>
<h3>
<?= form_label('Número de habitación: ', 'numHab') ?>
<?= form_input($numHab) ?>
<br>
<br>
<?= form_submit('', 'Buscar') ?>
</h3>
<br>
<?= form_close() ?>
</body>
</html>