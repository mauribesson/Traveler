<?php
$data = array(
	'dni' => $dni
	);
?>
<?= form_open("index.php/elIndeseable/recibirNuevaInfraccion/$dni") ?>
<img src="Desktop/Logo.png">
<h2>Nueva Infraccion</h2>
<?php
	$nombreU = array(
		'name' => 'nombreU',
		'placeholder' => 'Nombre del hotel'
	);
	$fecha = array(
		'name' => 'fecha',
		'placeholder' => 'Fecha de la infraccion'
	);
?>
<h3>
<?= form_label('Nombre del hotel: ', 'nombreU') ?>
<?= form_input($nombreU) ?>
<br>
<?= form_label('Fecha de la infraccion: ', 'fecha') ?>
<?= form_input($fecha) ?>
<br>
<?php
$this->db->select('nombreTipo');
$this->db->from('TipoInfraccion');
$query = $this->db->get();
foreach ($query->result() as $row) { 
	$array[] = $row->nombreTipo; 
} 
?>
<?= form_label('Tipo de infraccion: ') ?>
<?= form_dropdown('tipo', $array, 'Robo/Rotura') ?>
<br>
<?= form_submit('', 'Registrar') ?>
</h3>
<?= form_close() ?>
</body>
</html>