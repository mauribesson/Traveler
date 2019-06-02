<?= form_open("index.php/traveler/modificacionHabitacion") ?>
<h2>Ingrese el número de la habitación a modificar</h2>
<?php
	$numHab= array(
		'name' => 'numHab',
		'placeholder' => 'Numero de la habitación'
	);
	$nuevoNumHab = array(
		'name' => 'nuevoNumHab',
		'placeholder' => 'Nuevo número de la habitación'
	);
?>
<h3>
<?= form_label('Número de la habitación: ', 'numHab') ?>
<?= form_input($numHab) ?>
<br>
<?= form_label('Nuevo número de la habitación: ', 'nuevoNumHab') ?>
<?= form_input($nuevoNumHab) ?>
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
<?= form_submit('', 'Modificar') ?>
</h3>
<?= form_close() ?>
</body>
</html>