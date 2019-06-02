<!--<?= form_open("index.php/traveler/listaPorPasajero") ?>
<h2>Ingrese el dni del pasajero para la búsqueda de alojamientos</h2>
<?php
	$dni = array(
		'name' => 'dni',
		'placeholder' => 'Dni'
	);
?>
<h3>
<?= form_label('Dni: ', 'dni') ?>
<?= form_input($dni) ?>
<br>
<?= form_submit('', 'Buscar') ?>
</h3>
<?= form_close() ?>
</body>
</html>-->


<!--==============================================================================================-->
<!-- Bootstrap formulario -->
<div class="container">
	<div class="row">
		<div class="col-md-6">			
			<h2>Buscar Alojamiento </h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" >
			<form action="<?php echo base_url('/index.php/traveler/listaPorPasajero'); ?>" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="nombreTipo">DNI del pasajero:</label>
					<input type="text" class="form-control" name="dni" placeholder="DNI">
					<small class="text-danger">(Sin puntos ".")</small>
				</div>
				<button type="submit" class="btn btn-primary">Buscar</button>
				<!--<a href="administrarTipoHabitacion"class="btn btn-danger">Cancelar</a>-->
			</form>
			
		</div>
	</div>
</div>

<hr>
<!-- /Bootstrap formulario-->

</body>
</html>
