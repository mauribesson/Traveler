	<style>
		ul {
			width:95%;
  			font-size: 100%;
  			background: white;
  			text-align: center;
		}
	</style>
<center>
<h1>Listado de alojamientos</h1>
 	<ul>
		<li>Fecha alojamiento</li>
		<li>Nombre</li>
		<li>Apellido</li>
	</ul>
<?php
	 if ($pasajero){
	 foreach ($pasajero->result() as $ti) { ?> 
	 	<ul>
	 		<li><?= $ti->fecha; ?></li>
	 		<li><?= $ti->nombres; ?></li>
	 		<li><?= $ti->apellidos; ?></li>
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