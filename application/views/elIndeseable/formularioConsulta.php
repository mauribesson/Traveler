<?= form_open("index.php/elIndeseable/recibirConsulta") ?>
<img src="Desktop/Logo.png">
<h2>Buscar una persona</h2>
<?php
	$DNI = array(
		'name' => 'dni'
	);
?>
<h3>
<?= form_label('DNI infractor: ', 'dni') ?>
<?= form_input($DNI) ?>
<br>
<?= form_submit('', 'Consultar') ?>
</h3>
<?= form_close() ?>
</body>
</html>