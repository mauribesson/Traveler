<?= form_open("index.php/traveler/recibirDatosHabitacion") ?>
<h2>Nueva Habitación</h2>
<?php
	$numHab = array(
		'name' => 'numHab',
		'placeholder' => 'Número de Habitación'
	);
?>
<h3>
<?= form_label('Número de Habitación: ', 'numHab') ?>
<?= form_input($numHab) ?>
<br>
<?php
$this->db->select('nombreTipo');
$this->db->from('tipoHabitacion');
$query = $this->db->get();
foreach ($query->result() as $row) { 
	$array[] = $row->nombreTipo; 
} 
?>
<?= form_label('Tipo de habitacion: ') ?>
<?= form_dropdown('tipo', $array, 'Estandar') ?>
<br>
<?= form_submit('', 'Registrar') ?>
</h3>
<?= form_close() ?>
</body>
</html>