<?= form_open("index.php/traveler/eliminacionHabitacion") ?>
<h2>Buscar habitación</h2>
<?php
	$numHab= array(
		'name' => 'numHab'
	);
?>
<h3>
<?= form_label('Número de habitación: ', 'numHab') ?>
<?= form_input($numHab) ?>
<br>
<?= form_submit('', 'Buscar') ?>
</h3>
<?= form_close() ?>
</body>
</html>