<!DOCTYPE html>
<html lang='es'>
<head>
	<title>Traveler</title>
	<meta charset='utf-8'>
		<!--CSS-->
		<link rel="stylesheet" href="<?php echo base_url('estilo/bootstrap/css/bootstrap.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('estilo/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css'); ?>">
		<!--
			<link rel="stylesheet" type="text/css" href="<?php echo base_url('estilo/fontawesome/css/fontawesome.css'); ?>">
		-->
		<!--JS-->
		<script  type="text/javascript" src="<?php echo base_url('estilo/jquery/jquery-3.3.1.min.js'); ?>"></script>
		<script  type="text/javascript" src="<?php echo base_url('estilo/bootstrap/js/bootstrap.js'); ?>"></script>
		<script  type="text/javascript" src="<?php echo base_url('estilo/moment/min/moment.min.js');?>"></script>
		<script  type="text/javascript" src="<?php echo base_url('estilo/moment/locale/es.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('estilo/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js'); ?>"></script> 
		<script type="text/javascript" src="<?php echo base_url('estilo/fontawesome/js/fontawesome-all.min.js'); ?>"></script> 
</head>
<body>
<!--NavBar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="<?php echo base_url('index.php/Traveler/index')?>">
	<img src=<?php echo base_url('estilo/img/ICONO.svg')?> width="50" height="50" alt="">
	Traveler</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<!--<li class="nav-item active">
				<a class="nav-link" href="Index">Incio<span class="sr-only">(Actual)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Idesa</a>
			</li>-->
			<!--Reserva-->
			<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Reservas
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?php echo base_url('index.php/Reserva/nuevaReserva')?>">Registrar Reserva</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Buscar Reserva <b>[NO HACE NADA VER]</b></a>
					</div>
			</li>
			<!--/Reserva-->

			<!-- Registro -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Buscar Registro
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo base_url('index.php/Reserva/reservasPorFecha')?>">Buscar Reg. Reserva » Por Fecha </a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('index.php/Reserva/reservasPorPasajero')?>">Buscar Reg. Reserva » Por Pasajero</a>
					<!--<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>-->
			</li>
			<!-- Historial de alojaminto-->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Historial de Alojamientos
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo base_url('index.php/Reserva/alojamientosPorFecha')?>">Historial de Alojamientos » Por Fecha </a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('index.php/Reserva/alojamientosPorPasajero')?>">Historial de Alojamientos » Por Pasajero</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pasajero
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?php echo base_url('index.php/pasajero/registroPasajeros')?>">Registrar ingreso del Pasajero</a>
					</div>
				</li>

				
				<!-- Tipo de Habitacion-->
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Configuración 
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo base_url('index.php/traveler/administrarTipoHabitacion')?>">Tipo de Habitaciones </a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('index.php/traveler/administrarHabitacion')?>">Habitaciones</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('index.php/traveler/administrarCargos')?>">Cargos</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('index.php/traveler/administrarUsuarios')?>">Usuarios</a>					
				</li>
				<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('index.php/elIndeseable/index'); ?>">El Indeseable</a>
			</li>
				<!-- /nuevo -->
			</ul>
			<!--<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>-->
		</div>
	</nav>
<!--Navbar-->

