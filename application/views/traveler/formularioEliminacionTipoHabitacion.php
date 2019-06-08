
<!--formulario Bootstrap -->
<div class="container">
	<div class="row">
		<div class="col-md-6">			
			<h2>Eliminar tipo de habitación</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" >
			<form action="<?php echo base_url('/index.php/traveler/eliminacionTipoHabitacion'); ?>" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="nombreTipo">Nombre del Tipo de habitacion:</label>
					<input type="text" class="form-control" name="nombreTipo" placeholder="Nombre del Tipo">
					<small class="text-danger">(Log. maxima 15 caracteres)</small>
				</div>
				<button type="submit" class="btn btn-primary">Eliminar</button>
				<a href="administrarTipoHabitacion"class="btn btn-danger">Cancelar</a>
			</form>
			
		</div>
	</div>
</div>




<!--/formulario bootstrap -->


<!--<form action="http://localhost:8080/Traveler/index.php/traveler/eliminacionTipoHabitacion" method="post" accept-charset="utf-8">
<h2>Buscar tipo de habitación</h2>
<h3>
<label for="nombreTipo">Nombre del Tipo: </label><input type="text" name="nombreTipo" value="">
<br>
<input type="submit" value="Buscar">
</h3>
</form>-->




</body>
</html>