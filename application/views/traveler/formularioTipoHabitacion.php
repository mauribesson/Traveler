<!--<?= form_open("index.php/traveler/recibirDatosTipoHabitacion") ?>
<h2>Registrar nuevo tipo de habitación</h2>

<?php
	$nombreTipo = array(
		'name' => 'nombreTipo',
		'placeholder' => 'Nombre del Tipo'
	);
?>
<h3>
<?= form_label('Nombre del Tipo: ', 'nombreTipo') ?>
<?= form_input($nombreTipo) ?>
<br>
<br>
<?= form_submit('', 'Registrar') ?>
</h3>
<br>
<?= form_close() ?>
-->
<!-- formulario nuevo  -->


<!-- Bootstrap formulario -->
<div class="container">
	<div class="row">
		<div class="col-md-6">			
			<h2>Registrar nuevo tipo de habitación</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" >
			<form action="<?php echo base_url('/index.php/traveler/recibirDatosTipoHabitacion'); ?>" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="nombreTipo">Nombre del Tipo de habitacion:</label>
					<input type="text" class="form-control" name="nombreTipo" placeholder="Nombre del Tipo">
					<small class="text-danger">(Log. maxima 15 caracteres)</small>
				</div>
				<button type="submit" class="btn btn-primary">Nuevo</button>
				<a href="administrarTipoHabitacion"class="btn btn-danger">Cancelar</a>
			</form>
			
		</div>
	</div>
</div>
<!-- /Bootstrap formulario-->

</body>
</html>