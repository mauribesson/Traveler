	<style>
		ul {
			width:95%;
  			font-size: 100%;
  			background: white;
  			text-align: center;
		}
	</style>
<center>
<h1>Consulta de pasajeros</h1>
 	<ul>
		<li>Documento</li>
		<li>Apellidos</li>
		<li>Nombres</li>
		<li>Dirección</li>
		<li>Fecha Nacimiento</li>
		<li>Teléfono</li>
	</ul>
<?php
	 if ($pasajero){
	 foreach ($pasajero->result() as $ti) { ?> 
	 	<ul>
	 		<li><?= $ti->documento; ?></li>
	 		<li><?= $ti->apellidos; ?></li>
	 		<li><?= $ti->nombres; ?></li>
	 		<li><?= $ti->calleYNum; ?></li>
	 		<li><?= $ti->fechaNac; ?></li>
	 		<li><?= $ti->telefono; ?></li>
	 	</ul>
	 <?php } 
	 }else{
	 	echo "<p>Error en la aplicación </p>";
	 }
?>
<h3><a href="index">Volver</a></h3>
</center>
</body>
</html>