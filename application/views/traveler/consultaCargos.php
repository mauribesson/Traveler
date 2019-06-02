	<!--<style>
		ul {
			width:40%;
  			font-size: 100%;
  			background: white;
  			text-align: center;
		}
	</style>
<center>
<h1>Cargos</h1>
<?php
	 if ($detalleCargo){
	 foreach ($detalleCargo->result() as $ti) { ?> 
	 	<ul>
	 		<li><?= $ti->detalleCargo; ?></li>
	 	</ul>
	 <?php } 
	 }else{
	 	echo "<p>Error en la aplicación </p>";
	 }
?>
<br>
<br>
<h3><a href="index">Volver</a></h3>
</body>
</html>-->




<div class="container">
	<div class="col-md-6">
		<h1>Cargos</h1>
	</div>
	<div class="col-md-12">
		<div class="btn-group">
			<label class="btn btn-secondary ">
				<a class="" href="index"><< Volver </a>
			</label>
			<label class="btn btn-secondary ">
				<a class="" href="nuevoCargo">Nuevo</a>
			</label>
			<label class="btn btn-secondary">
				<a class ="" href="modificarCargo">Modificar</a>
			</label>
			<label class="btn btn-secondary">
				<a class="" href="eliminarCargo">Eliminar</a>
			</label>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					
					<th scope="col">Cargo</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($detalleCargo){
						foreach ($detalleCargo->result() as $ti) { ?>
						<tr>
							<td><?= $ti->detalleCargo; ?></td>							
						</tr>
						<?php }
						}else{
							echo "<p>Error en la aplicación -> no se puesden cargar cargos</p>";
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