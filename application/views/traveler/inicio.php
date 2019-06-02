
		<!--
		<style type="text/css">
			
			* {
				margin:0px;
				padding:0px;
				/*background-color:black;*/
			}
			
			#header {
				margin:auto;
				width:100%;
				font-family:Arial, Helvetica, sans-serif;
			}
			#body{
				font-size: 150%;
				text-align: center;
				color:violet;
				/*background-color:black;*/
				width:100%;
				position:absolute;
				font-family:sans-serif;
			}
			#body2{
				font-size: 150%;
				text-align: center;
				color:#872228;
				background-color:black;
				width:100%;
				position:absolute;
				font-family:sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav > li {
				float:left;
			}
			
			.nav li a {
				background-color:black;
				color:white;
				text-decoration:none;
				padding:20px 130px;
				display:block;
			}
			
			.nav li a:hover {
				background-color:#434343;
			}
			
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-300px;
				top:0px;
			}
			
		</style>-->

	<body>

	<!--
		<div id="header">
			<ul class="nav">
				<li><a href="">Registro</a>
				<ul>
					<li><a href="">Registro de Reservas</a>
					<ul>
						<li><a href="reservasPorFecha">Por fecha</a></li>
						<li><a href="reservasPorPasajero">Por pasajero</a></li>
					</ul>
				</li>
				<li><a href="">Historial de Alojamientos</a>
				<ul>
					<li><a href="alojamientosPorFecha">Por fecha</a></li>
					<li><a href="alojamientosPorPasajero">Por pasajero</a></li>
				</ul>
			</li>
			<li><a href="registroPasajeros">Pasajeros</a></li>
		</ul>
	</li>
	<li><a href="">Reservas</a>
	<ul>
		<li><a href="nuevaReserva">Nueva Reserva</a></li>
		<li><a href="">Buscar Reserva</a></li>
	</ul>
</li>
<li><a href="">Configuración</a>
<ul>
	<li><a href="">Tipos de Habitaciones</a>
	<ul>
		<li><a href="nuevoTipoHabitacion">Nuevo Tipo</a></li>
		<li><a href="listarTiposHabitacion">Listado de Tipos</a></li>
		<li><a href="modificarTipoHabitacion">Modificar Tipo</a></li>
		<li><a href="eliminarTipoHabitacion">Eliminar Tipo</a></li>
	</ul>
</li>
<li><a href="">Habitaciones</a>
<ul>
	<li><a href="nuevaHabitacion">Nueva Habitación</a></li>
	<li><a href="listarHabitaciones">Listado de Habitaciones</a></li>
	<li><a href="buscarHabitacion">Buscar Habitación</a></li>
	<li><a href="modificarHabitacion">Modificar Habitación</a></li>
	<li><a href="eliminarHabitacion">Eliminar Habitación</a></li>
</ul>
</li>
<li><a href="">Usuarios</a>
<ul>
<li><a href="nuevoUsuario">Nuevo Usuario</a></li>
<li><a href="listarUsuarios">Listado de Usuarios</a></li>
<li><a href="modificarUsuario">Modificar Usuario</a></li>
<li><a href="eliminarUsuario">Eliminar Usuario</a></li>
</ul>
</li>
<li><a href="">Cargos</a>
<ul>
<li><a href="nuevoCargo">Nuevo Cargo</a></li>
<li><a href="listarCargos">Listado de Cargos</a></li>
<li><a href="modificarCargo">Modificar Cargo</a></li>
<li><a href="eliminarCargo">Eliminar Cargo</a></li>
</ul>
</li>
</ul>
</li>
<li><a href="index">Inicio</a></li>
<li><a href="<?php echo base_url('index.php/elIndeseable/index')?>" >El Indeseable</a></li>
</ul>
</div>
<br>
<br><br><br><br>


-->



<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h1 style="color:red"><b>[pendiente: revisar ruteo, agregar arribo, checkout, agregar footer]</b></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>Reservas</h2>
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
			<ul>
				<li>Habitación: <?= $ti->numHab; ?></li>
				<li>Cliente: <?= $ti->documento; ?></li>
				Número de reserva <?= $id=$ti->numReserva;?>
				<li style=font-size:70%><a href="eliminarReserva/<?= $id ?>">Eliminar</a>  <a href="arribo/<?= $id ?>">Check In</a></li>
				<li>_______________________________</li>
			</ul>
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