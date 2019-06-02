<div class="container">
	<div class="col-md-6">
		<h1>Tipos de habitacion</h1>
	</div>
	<div class="col-md-12">
		<div class="btn-group">
			<label class="btn btn-secondary ">
				<a class="" href="index"><< Volver </a>
			</label>
			<label class="btn btn-secondary ">
				<a class="" href="nuevoTipoHabitacion">Nuevo</a>
			</label>
			<label class="btn btn-secondary">
				<a class ="" href="modificarTipoHabitacion">Modificar</a>
			</label>
			<label class="btn btn-secondary">
				<a class="" href="eliminarTipoHabitacion">Eliminar</a>
			</label>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Tipo de Habitación</th>
				</tr>
			</thead>
			<tbody>
				<?php
								if ($tipos){
				foreach ($tipos->result() as $ti) { ?>
				<tr>
					<td><?= $ti->tipoHab; ?></td>
					<td><?= $ti->nombreTipo; ?></td>
				</tr>
				<?php }
				}else{
					echo "<p>Error en la aplicación -> no se puesden cargar los tipos fr habitacion</p>";
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
</body>
</html>