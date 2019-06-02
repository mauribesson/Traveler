<h3>Antedecentes hoteleros</h3>
<br>
<h5>
	<ul>
		<li><a href="nuevaInfraccion/<?= $dni?>">Cargar nuevo antecedente</a></li>
		<li><a href="modificar/<?= $dni?>">Modificar infractor</a></li>
		<li><a href="eliminar/<?= $dni?>">Eliminar infractor</a></li>
	</ul>
</h5>
<br>
	<ul>
		<li>Dónde?</li>
		<li>Qué hizo?</li>
		<li>Cuándo?</h4></li>
	</ul>
<?php
	 if ($infractor){
	 foreach ($infractor->result() as $inf) { ?>
	 	<ul>
	 		<li><?= $inf->nombreU; ?></li>
	 		<li><?= $inf->nombreTipo; ?></li>
	 		<li><?= $inf->fecha; ?></li>
	 	</ul>
	 <?php } 
	 }else{
	 	echo "<p>Error en la aplicación </p>";
	 }
?>

</body>
</html>