<style>
		h2 {
			width:95%;
  			font-size: 300%;
  			background: white;
  			text-align: center;
		}
		h3 {
			width:95%;
  			font-size: 170%;
  			color:black;
  			background: white;
  			text-align: center;
		}
		h4 {
			width:95%;
  			font-size: 200%;
  			color:black;
  			background: white;
  			text-align: left;
  			float:right;
		}
</style>
<?php
	$dato = array(
			'numHab' => $this->input->post('numHab'),
			'documento' => $this->input->post('documento'),
			'cantNoches' => $this->input->post('cantNoches'),
			'precioPorNoche' => $this->input->post('precioPorNoche'),
			'codCI' => $this->input->post('codCI'),
			'montoAloj' => $this->input->post('montoAloj')
		);
?>
<?= form_open("index.php/traveler/cobrar/$codCI") ?>
<h2>Cuenta</h2>
<h4>
<li style=color:#2D8722 font-size: 170%>Habitación: <?= $numHab; ?></li>
<li style=color:#2D8722>Cliente: <?= $documento; ?></li>
<li style=color:#2D8722>precio: <?= $precioPorNoche; ?></li>
<li style=color:#2D8722>noches: <?= $cantNoches; ?></li>
<li style=color:#2D8722>Total alojamiento: <?= $montoAloj; ?></li>

<?php
	$montoCargos = array(
		'name' => 'montoCargos',
		'placeholder' => 'Monto cargos'
	);
	$detalleCargos = array(
		'name' => 'detalleCargos',
		'placeholder' => 'Detalle cargos'
	);
?>
<?= form_label('Monto de cargos: ', 'montoCargos') ?>
<?= form_input($montoCargos) ?>
<br>
<?= form_label('Detalle de cargos: ', 'detalleCargos') ?>
<?= form_input($detalleCargos) ?>
<br>
<?= form_submit('', 'Cobrar') ?>
</h4>
<?= form_close() ?>
</body>
</html>