
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h1 style="color:red"><b>[pendiente: reserva( di la habitacion esta ocupada el volver redigige a inicio, deberia bolver al form para cambia o validar))
		,,,, MODIFICAR FUNCIONALIDAD DE LA FECHA DE RESERVA,,,,,,  corregir vslidacion Nueva reserva, revisar ruteo, agregar arribo, checkout, agregar footer],,,,ESTETICA a pantallas de confirmacion de lata de tipo de hanitacion</b></h1>
		
		
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			
					<h2>Reservas - Hoy:</h2>
					<h2>_______________________________</h2>
					<!-- <h3><?= date('Y-m-d') ?></h3> -->
					<?php
						$this->db->select("*");
						$this->db->from('reserva');
						$this->db->where('fechaInicio', date('Y-m-d'));
						//$this->db->where('fechaInicio', '2018-02-19');
						$query = $this->db->get();
						if ($query){
					foreach ($query->result() as $ti) { ?>
					<div class="card">
					<div class="card-body">
						<ul>
							<li>Habitación: <?= $ti->numHab; ?></li>
							<li>Cliente: <?= $ti->documento; ?></li>
							Número de reserva <?= $id=$ti->numReserva;?>
							<li style=font-size:70%><a href="eliminarReserva/<?= $id ?>">Eliminar</a>  <a href="arribo/<?= $id ?>">Check In</a></li>
							<li>_______________________________</li>
						</ul>
						</div>
					</div> <!--fin cards-->	
					<?php }
					}else{
						echo "<p>Error en la aplicación </p>";
					}
					?>

				
					<br>
					<br>
					<br>
			<h2 style=color:#872228>Alojados </h2>
			<h2 style=color:#872228>_______________________________</h2>
			<?php
				$this->db->select("reservaHistorial.numHab");
				$this->db->select("reservaHistorial.documento");
				$this->db->select("alojamiento.codCI");
				$this->db->select("alojamiento.fechaF");
				$this->db->from('alojamiento');
				$this->db->join("reservaHistorial","reservaHistorial.numReservaH = alojamiento.numReserva");
				$this->db->where('alojamiento.fechaI <=', date('Y-m-d'));
				$this->db->where('alojamiento.fechaF >', date('Y-m-d'));
				//$this->db->where('alojamiento.fechaI <=', '2018-01-30');
				//$this->db->where('alojamiento.fechaF >', '2018-01-30');
				$query = $this->db->get();
				if ($query){
			foreach ($query->result() as $ti) { ?>
			<ul>
				<li style=color:#872228>Habitación: <?= $ti->numHab; ?></li>
				<li style=color:#872228>Cliente: <?= $ti->documento; ?></li>
				<li style=color:#872228>Hasta <?= $id=$ti->fechaF;?></li>
				<li style=color:#872228>_______________________________</li>
			</ul>
			<?php }
			}else{
				echo "<p>Error en la aplicación </p>";
			}
			?>
			<br>
			<br>
			<br>
			<h2 style=color:#2D8722>Checks Outs</h2>
			<h2 style=color:#2D8722>_______________________________</h2>
			<?php
				$this->db->select("reservaHistorial.numHab");
				$this->db->select("reservaHistorial.documento");
				$this->db->select("reservaHistorial.precioPorNoche");
				$this->db->select("alojamiento.codCI");
				$this->db->select("alojamiento.fechaF");
				$this->db->select("alojamiento.fechaI");
				$this->db->from('alojamiento');
				$this->db->join("reservaHistorial","reservaHistorial.numReservaH = alojamiento.numReserva");
				$this->db->where('alojamiento.fechaF', date('Y-m-d'));
				//$this->db->where('alojamiento.fechaF', '2018-02-20');
				$query = $this->db->get();
				if ($query){
					foreach ($query->result() as $ti) {
						$arreglo = array(
							'numHab' => $ti->numHab,
							'documento' => $ti->documento,
							'precioPorNoche' => $ti->precioPorNoche,
							'codCI' => $ti->codCI,
							'fechaF' => $ti->fechaF,
							'fechaI' => $ti->fechaI,
						);
			?>
			<ul>
				<li style=color:#2D8722>Habitación: <?= $ti->numHab; ?></li>
				<li style=color:#2D8722>Cliente: <?= $ti->documento; ?></li>
				<li style=color:#2D8722>Codigo: <?= $ti->codCI; ?></li>
				<?= $cod = $ti->codCI; ?>
				<li style=font-size:70%><a href="checkOut/<?= $cod ?>">Cobrar</a></li>
				<li style=color:#2D8722>_______________________________</li>
			</ul>
			<?php }
			}else{
				echo "<p>Error en la aplicación </p>";
			}
			?>
		</div>
	</div>
</div>

</body>
</html>