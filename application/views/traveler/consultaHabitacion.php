	<style>
		ul {
			width:50%;
  			font-size: 100%;
  			background: white;
  			text-align: center;
		}
	</style>
<h1>Consulta de habitación</h1>
<center>
<br>
	<ul>
		<li>Número de Habitación</li>
		<li>Tipo de Habitación</li>
	</ul>
<?php
	 if ($habitacion){
	 foreach ($habitacion->result() as $inf) { ?>
	 	<ul>
	 		<li><?= $inf->numHab; ?></li>
	 		<li><?= $inf->nombreTipo; ?></li>
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