<?= form_open("index.php/traveler/confirmacionReserva") ?>

<h2>Nueva Reserva</h2>
<?php
	$fechaI = array(
		'name' => 'fechaInicio',
		'value' =>  $this->session->userdata('data')[0]
	);
	$cantNoches = array(
		'name' => 'cantNoches',
		'value' => $this->input->post['cantNoches']
	);
	$fechaFin = array(
		'name' => 'fechaFin',
		'value' => $this->input->post['fechaFin']
	);
	$numHab = array(
		'name' => 'numHab',
		'value' => $this->input->post['numHab']
	);
	$cantPersonas = array(
		'name' => 'cantPersonas'
	);
	$precioPorNoche = array(
		'name' => 'precioPorNoche'
	);
	$documento = array(
		'name' => 'documento'
	);
?>
<h3>
<?= form_label('Cantidad de personas: ', 'cantPersonas') ?>
<?= form_input($cantPersonas) ?>
<br>
<?= form_label('Precio por noche: ', 'precioPorNoche') ?>
<?= form_input($precioPorNoche) ?>
<br>
<?php
$this->db->select('nombreT');
$this->db->from('usuarioT');
$query = $this->db->get();
foreach ($query->result() as $row) { 
	$array[] = $row->nombreT; 
} 
?>
<?= form_label('Usuario: ') ?>
<?= form_dropdown('numero', $array, '101') ?>
<br>
<?= form_label('Documento del pasajero: ', 'documento') ?>
<?= form_input($documento) ?>
<br>
<?= form_submit('', 'Reservar') ?>
</h3>
<?= form_close() ?>
</body>
</html>