<!--<?= form_open("index.php/traveler/modificacionTipoHabitacion") ?>
<h2>Ingrese el nombre del tipo de habitación a modificar</h2>
<?php
	$nombreTipo = array(
		'name' => 'nombreTipo',
		'placeholder' => 'Nombre del tipo'
	);
	$nuevoNombreTipo = array(
		'name' => 'nuevoNombreTipo',
		'placeholder' => 'Nuevo nombre del tipo'
	);
?>
<h3>
<?= form_label('Nombre del tipo: ', 'nombreTipo') ?>
<?= form_input($nombreTipo) ?>
<br>
<?= form_label('Nuevo nombre del tipo: ', 'nuevoNombreTipo') ?>
<?= form_input($nuevoNombreTipo) ?>
<br>
<?= form_submit('', 'Modificar') ?>
</h3>
<?= form_close() ?>-->
<!--Formulario Bootstrap-->
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>Modificar el tipo de habitación</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" >
			<form action="<?php echo base_url('/index.php/traveler/modificacionTipoHabitacion'); ?>" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="">Nombre del Tipo de habitacion:</label>
					<input type="text" class="form-control" name="nombreTipo" placeholder="Nombre del Tipo">
					<small class="text-danger">(Log. maxima 15 caracteres)</small>
				</div>
				<div class="form-group">
					<label for="nuevoNombreTipo">Nuevo nombre del tipo de habitacion:</label>
					<input type="text" class="form-control" name="nuevoNombreTipo" placeholder="Nombre del Tipo">
					<small class="text-danger">(Log. maxima 15 caracteres)</small>
				</div>

				<button type="submit" class="btn btn-primary">Modificar</button>
				<a href="administrarTipoHabitacion"class="btn btn-danger">Cancelar</a>
			</form>
			
		</div>
	</div>
</div>
<!--/formulario Bootstrap-->
<!--<hr>
<form action="http://localhost:8080/Traveler/index.php/traveler/modificacionTipoHabitacion" method="post" accept-charset="utf-8">
	<h2>Ingrese el nombre del tipo de habitación a modificar</h2>
	<h3>
	<label for="nombreTipo">Nombre del tipo: </label><input type="text" name="nombreTipo" value="" placeholder="Nombre del tipo">
	<br>
	<label for="nuevoNombreTipo">Nuevo nombre del tipo: </label><input type="text" name="nuevoNombreTipo" value="" placeholder="Nuevo nombre del tipo">
	<br>
	<input type="submit" value="Modificar">
	</h3>
</form>-->
</body>
</html>