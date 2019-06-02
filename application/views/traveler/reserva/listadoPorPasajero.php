	

<!--==============================================================================================-->

<div class="container">
	<div class="col-md-12">
		<h1>Reservas para el pasajero - DNI: <b><?php echo $dni; ?></b></h1>
	</div>
	<!--<div class="col-md-12">
		<div class="btn-group">
			<label class="btn btn-secondary ">
				<a class="" href="index"><< Volver </a>
			</label>
			<label class="btn btn-secondary ">
				<a class="" href="nuevaHabitacion">Nuevo</a>
			</label>
			<label class="btn btn-secondary">
				<a class ="" href="modificarHabitacion">Modificar</a>
			</label>
			<label class="btn btn-secondary">
				<a class="" href="eliminarHabitacion">Eliminar</a>
			</label>
		</div>
	</div>-->
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Número de reserva</th>
					<th scope="col">Fecha reserva</th>
					<th scope="col">Cantidad personas</th>				
					<th scope="col">Precio por noche</th>
					<th scope="col">Usuario</th>
					<th scope="col">Número habitación</th>
					
				</tr>
			</thead>
			<tbody>
				<?php if ($pasajero){
						foreach ($pasajero->result() as $ti) {
							
							$auxFecha = date("d/m/Y", strtotime($ti->fechaInicio));
							?>
						<tr>
							
							<td><?= $ti->numReserva; ?></td>
	 						<td><?= $auxFecha; ?></td>
	 						<td><?= $ti->cantPersonas; ?></td>
	 						<td><?= $ti->precioPorNoche; ?></td>
	 						<td><?= $ti->nombreT; ?></td>
	 						<td><?= $ti->numHab; ?></td>

						</tr>
						<?php }
						}else{
							echo "<p>Error en la aplicación -> no se puesden cargar reservas</p>";
						}
				?>
				
			</tbody>
		</table>
	</div>
	<!--<div class="col-md-3">
		<h3>
		<h3><a class="btn" href="index"><< Volver </a></h3>
		</center>
		</h3>
	</div>-->
</div>
<hr>
</body>
</html>