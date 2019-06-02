<!--	<style>
		ul {
			width:50%;
  			font-size: 100%;
  			background: white;
  			text-align: center;
		}
	</style>
<center>
<h1>Habitaciones</h1>
	<ul>
		<li>Número de Habitación</li>
		<li>Tipo de Habitación</li>
	</ul>
<?php
	 if ($numHab){
	 foreach ($numHab->result() as $ti) { ?> 
	 	<ul>
	 		<li><?= $ti->numHab; ?></li>
	 		<li><?= $ti->nombreTipo; ?></li>
	 	</ul>
	 <?php } 
	 }else{
	 	echo "<p>Error en la aplicación </p>";
	 }
?>
<h3><a href="index">Volver</a></h3>
</center>
</body>
</html>-->

<!--====================================================================================================================-->
<div class="container">
	<div class="col-md-6">
		<h1>Habitaciones</h1>
	</div>
	<div class="col-md-12">
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
	</div>
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Habitación</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($numHab){
						foreach ($numHab->result() as $ti) { ?>
						<tr>
							<td><?= $ti->numHab; ?></td>
							<td><?= $ti->nombreTipo; ?></td>
						</tr>
						<?php }
						}else{
							echo "<p>Error en la aplicación -> no se puesden cargar habitaciones</p>";
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