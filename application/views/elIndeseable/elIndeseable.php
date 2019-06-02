<?php
	if ($infractores){
		foreach ($infractores->result() as $infractor) { ?>	
				<ul>
					<li><?= $infractor->nombreI; ?></li>
				</ul>
<?php }

}else{
		echo "<p>Error en la aplicación </p>";
	}
	
?>

</body>
</html>