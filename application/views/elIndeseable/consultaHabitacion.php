<h3>Consulta de habitación</h3>
<br>
	<ul>
		<li>Número de Habitación</li>
		<li>Tipo de Habitación</li>
	</ul>
<?php
	 if ($habitación){
	 foreach ($habitación->result() as $inf) { ?>
	 	<ul>
	 		<li><?= $inf->numHab; ?></li>
	 		<li><?= $inf->nombreTipo; ?></li>
	 	</ul>
	 <?php } 
	 }else{
	 	echo "<p>Error en la aplicación </p>";
	 }
?>

</body>
</html>