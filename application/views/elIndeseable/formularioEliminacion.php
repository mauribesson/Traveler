<?php
$data = array(
	'dni' => $dni
	);
?>
<img src="Desktop/Logo.png">
<h2>Eliminación de infractor</h2>
<h3>Desea elimnar este infractor? </h3>
<br>
<center><h3><a href="http://localhost:81/Traveler/index.php/elIndeseable/eliminarInfractor/<?= $dni?>">Si</a></h3></center>
<br>
<center><h3><a href="http://localhost:81/Traveler/index.php/elIndeseable/index">No</a></h3></center>
</body>
</html>