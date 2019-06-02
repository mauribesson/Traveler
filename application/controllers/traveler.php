<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Traveler extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		
	/*CARGA DE HABITACIOES */
		$this->load->model('reserva_model');
		$this->load->model('traveler_model');
		$this->load->model('habitacion_model');
		$this->load->model('tipohabitacion_model');
		$this->load->model('usuario_model');
		$this->load->model('cargo_model');
		$this->load->model('reserva_model');
		$this->load->library('session');

		//Carga Helper de Fecha para SQL
		$this->load->helper('fechaSQL_helper');
	}


	function index(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/inicio');
	}



/**********************************************************************************
			TIPO DE HABITACION 
	*/

	function administrarTipoHabitacion(){
		//Lista los Tipos de Habitacion
		$this->listarTiposHabitacion();
	}

	function nuevoTipoHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioTipoHabitacion');
	}
	function recibirDatosTipoHabitacion(){
		$data = array(
			'nombreTipo' => $this->input->post('nombreTipo')
		);
		$this->traveler_model->altaTipoHabitacion($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/altaTipoHabitacion');
	}

	//LISTA
	function listarTiposHabitacion(){
		$dato['tipos'] = $this->tipohabitacion_model->consultaTiposHabitacion();
		$this->load->view('traveler/header');
		$this->load->view('traveler/consultaTipoHabitacion', $dato);
	}


	function modificarTipoHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioModificacionTipoHabitacion');
	}
	function modificacionTipoHabitacion(){
		$data = array(
			'nombreTipo' => $this->input->post('nombreTipo'),
			'nuevoNombreTipo' => $this->input->post('nuevoNombreTipo')
		);
		$this->tipohabitacion_model->actualizarTipoHabitacion($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/actualizarTipoHabitacion');
	}
	function eliminarTipoHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioEliminacionTipoHabitacion');
	}
	function eliminacionTipoHabitacion(){
		$data = array(
			'nombreTipo' => $this->input->post('nombreTipo')
			);
		$this->tipohabitacion_model->eliminarTipoHabitacion($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/eliminarTipoHabitacion');
	}



/*
			FIN TIPO DE HABITACION 
	*****************************************************************************/



/****************************************************
			HABITACION 
	*/


	function administrarHabitacion(){
		$this->listarHabitaciones();
	}


	function nuevaHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioHabitacion');
	}
	function recibirDatosHabitacion(){
		$id=$this->input->post('tipo');
		$data = array(
			'numHab' =>$this->input->post('numHab'),
			'nombreTipo' => $id
		);
		$this->habitacion_model->altaHabitacion($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/altaHabitacion');
	}
	function listarHabitaciones(){
		$dato['numHab'] = $this->habitacion_model->consultaHabitaciones();
		$this->load->view('traveler/header');
		$this->load->view('traveler/consultaHabitaciones', $dato);
	}
	function buscarHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioBuscarHabitacion');
	}
	function recibirBusquedaHabitacion(){
		$data = array(
			'numHab' => $this->input->post('numHab')
			);
		$dato['habitacion'] = $this->habitacion_model->consultaHabitacion($data['numHab']);
		$this->load->view('traveler/header');
		$this->load->view('traveler/consultaHabitacion', $dato);
	}
	function modificarHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioModificarHabitacion');
	}
	function modificacionHabitacion(){
		$id=$this->input->post('tipo');
		$id = $id+2;
		$data = array(
			'numHab' => $this->input->post('numHab'),
			'nuevoNumHab' => $this->input->post('nuevoNumHab'),
			'tipoHab' => $id
		);
		$this->habitacion_model->actualizarHabitacion($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/actualizarHabitacion');
	}
	function eliminarHabitacion(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioEliminacionHabitacion');
	}
	function eliminacionHabitacion(){
		$data = array(
			'numHab' => $this->input->post('numHab')
			);
		$this->habitacion_model->eliminarHabitacion($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/eliminarHabitacion');
	}
/*
			FIN HABITACION 
	*****************************************************************************/





/****************************************************
			USUARIOS 
	*/


	function administrarUsuarios(){
		$this->listarUsuarios();
	}

	function nuevoUsuario(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioUsuario');
	}
	function recibirUsuario(){
		$data = array(
			'nombreT' => $this->input->post('nombreT'),
			'contrasenia' => $this->input->post('contrasenia')
		);
		$this->usuario_model->altaUsuario($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/altaUsuario');
	}
	function listarUsuarios(){
		$dato['usuarios'] = $this->usuario_model->consultaUsuarios();
		$this->load->view('traveler/header');
		$this->load->view('traveler/consultaUsuarios', $dato);
	}
	function modificarUsuario(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioModificarUsuario');
	}
	function modificacionUsuario(){
		$data = array(
			'nombreT' => $this->input->post('nombreT'),
			'nuevoNombreT' => $this->input->post('nuevoNombreT'),
			'contrasenia' => $this->input->post('contrasenia')
		);
		$this->usuario_model->actualizarUsuario($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/actualizarUsuario');
	}
	function eliminarUsuario(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioEliminacionUsuario');
	}
	function eliminacionUsuario(){
		$data = array(
			'nombreT' => $this->input->post('nombreT')
			);
		$this->usuario_model->eliminarUsuario($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/eliminarUsuario');
	}



/*
			FIN USUARIO
	*****************************************************************************/







/****************************************************
			CARGO 
	*/


	function administrarCargos(){
		$this->listarCargos();
	}

	function nuevoCargo(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioCargo');
	}
	function recibirCargo(){
		$data = array(
			'detalleCargo' => $this->input->post('detalleCargo')
		);
		$this->cargo_model->altaCargo($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/altaCargo');
	}
	function listarCargos(){
		$dato['detalleCargo'] = $this->cargo_model->consultaCargos();
		$this->load->view('traveler/header');
		$this->load->view('traveler/consultaCargos', $dato);
	}
	function modificarCargo(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioModificarCargo');
	}
	function modificacionCargo(){
		$data = array(
			'detalleCargo' => $this->input->post('detalleCargo'),
			'nuevoDetalleCargo' => $this->input->post('nuevoDetalleCargo')
		);
		$this->cargo_model->actualizarCargo($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/actualizarCargo');
	}
	function eliminarCargo(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/formularioEliminacionCargo');
	}
	function eliminacionCargo(){
		$data = array(
			'detalleCargo' => $this->input->post('detalleCargo')
			);
		$this->cargo_model->eliminarCargo($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/eliminarCargo');
	}


/*
			FIN CARGO
	*****************************************************************************/




	/**************************RESERVAS*********************************/

/*

	function reservasPorFecha(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioReservaPorFecha');
	}

	//LISTADO POR FECHA
	function listadoPorFecha(){
		$data = array(
			'fecha1' =>fechaSQL_helper( $this->input->post('fecha1')),
			'fecha2' => fechaSQL_helper( $this->input->post('fecha2'))
		);

		var_dump($data);

		$dato['reservas'] = $this->reserva_model->reservasPorFecha($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listadoPorFecha', $dato);
	}


	function reservasPorPasajero(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioReservaPorPasajero');
	}
	function listadoPorPasajero(){
		$data = array(
			'dni' => $this->input->post('dni')
		);
		$dato['pasajero'] = $this->reserva_model->reservasPorpasajero($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listadoPorPasajero', $dato);
	}
	function alojamientosPorFecha(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioAlojamientoPorFecha');
	}

	function listaPorFecha(){
		$data = array(
			'fecha1' => fechaSQL_helper($this->input->post('fecha1')),
			'fecha2' => fechaSQL_helper($this->input->post('fecha2'))
		);
		$dato['alojamientos'] = $this->traveler_model->alojamientosPorFecha($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listaPorFecha', $dato);
	}

	function alojamientosPorPasajero(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioAlojamientoPorPasajero');
	}
	function listaPorPasajero(){
		$data = array(
			'dni' => $this->input->post('dni')
		);
		$dato['pasajero'] = $this->traveler_model->alojamientoPorpasajero($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listaPorPasajero', $dato);
	}
	function registroPasajeros(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioRegistroPasajero');
	}
	function listadoPasajeros(){
		$data = array(
			'dni' => $this->input->post('dni')
		);
		$dato['pasajero'] = $this->traveler_model->registroPasajeros($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listadoPasajeros', $dato);
	}
	function nuevaReserva(){
		$dato['usarios'] = $this->usuario_model->listadoUsuarios();
		$dato['habitacion'] = $this->habitacion_model->listadoHabitaciones();

		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioNuevaReserva', $dato);
	}



	function guardarNuevaReserva(){

		$dato = array();
		//obtener los datos del formulario.
		//$nombre = $this->input->post('nombre');
		//$numeroHab = $this->input->post('numero');

		//Transformar Fecha del calendario, usando Helper
		$fechaInicio = fechaSQL_helper($this->input->post('fechaInicio'));		
		$fechaFin = fechaSQL_helper($this->input->post('fechaFin')); 


		//var_dump($fechaFin);die;

		$dato = array(
					
			'fechaReservacion' => date('Y-m-d'),
			'fechaInicio' => $fechaInicio,
			'fechaFin' => $fechaFin,
			'cantPersonas' => $this->input->post('cantPersonas'),
			'nombreT' => $this->input->post('nombre'),
			'numHab' => $this->input->post('numero'),
			'precioPorNoche' => $this->input->post('precioPorNoche'),
			'documento' => $this->input->post('documento')

			);

			$reservaDisponible = array();
			$reservaDisponible['reserva'] = $this->traveler_model->chequearDisponibilidad($dato);

		//$reservaDisponible = $this->reserva_model->nuevaReserva($dato); 

			// SI HAY UNA RESERVA INDICA Q NO HAY DISPONIBILIDAD
			// SINO DA DE ALTA LA NUEVA RESERVA. 
			if ($reservaDisponible['reserva']->result()){
				$this->load->view('traveler/header');
				$this->load->view('traveler/reserva/noDisponible');			
		   }else{
			   $this->reserva_model->altaReserva($dato);
				$this->load->view('traveler/header');
				$this->load->view('traveler/reserva/altaReserva');
   
			}
		
	}

	//Validar formulario de nueva reserva
	function ValidarFormularioNuevaReserva($DatosFotmulario = array()){
		$resultado = array();

		//fechaInicio
		if($DatosFotmulario['fechaInicio'] != '')
			$resultado['fechaInicio'] = true;
		else
			$resultado['fechaInicio'] = false;
		
		//fechaFin
		if($DatosFotmulario['fechaFin'] != '')
			$resultado['fechaFin'] = true; //ok
		else
			$resultado['fechaFin'] = false; //no ok

		//cantPersonas 
		if($DatosFotmulario['cantPersonas'] != '')
			$resultado['cantPersonas'] = true;
		else
			$resultado['cantPersonas'] = false;	
		
		//nombreT 
		if($DatosFotmulario['nombreT'] != '')
			$resultado['nombreT'] = true;
		else
			$resultado['nombreT'] = false;	

		//numHab 
		if($DatosFotmulario['numHab'] != '')
			$resultado['numHab'] = true;
		else
			$resultado['numHab'] = false;	

		//precioPorNoche 
		if($DatosFotmulario['precioPorNoche'] != '')
			$resultado['numprecioPorNocheHab'] = true;
		else
			$resultado['precioPorNoche'] = false;
			
		//documento	
		if($DatosFotmulario['documento'] != '')
			$resultado['documento'] = true;
		else
			$resultado['documento'] = false;


		//armar todos los que etan mal para devolver a la vista 
		
		return $resultado;
	} 


	function eliminarReserva($id){
		$this->reserva_model->eliminarReserva($id);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/eliminarReserva');
	}

	function arribo($id){
		$this->db->select("*");
		$this->db->from('reserva');
		$this->db->where('numReserva', $id);
		$query = $this->db->get();
		if ($query){
	 		foreach ($query->result() as $ti) { 
	 			$data = array(
	 				'numReservaH' => $id,
		 			'fechaReservacion' => $ti->fechaReservacion,
					'fechaInicio' => $ti->fechaInicio,
					'fechaFin' => $ti->fechaFin,
					'cantPersonas' => $ti->cantPersonas,
					'nombreT' => $ti->nombreT,
					'numHab' =>  $ti->numHab,
					'precioPorNoche' => $ti->precioPorNoche,
					'documento' => $ti->documento
		 		);
		 	} 
	 	}else{
	 		echo "<p>Error en la aplicación </p>";
	 	}
	 	$this->traveler_model->arribo($data);
		$this->reserva_model->altaReservaHistorial($data);
		$this->reserva_model->eliminarReserva($id);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/arribo');
	}

*/
/*****************FIN RESERVAS ******** */

	function checkOut($cod){
			$this->db->select("reservaHistorial.numHab");
			$this->db->select("reservaHistorial.documento");
			$this->db->select("reservaHistorial.precioPorNoche");
			$this->db->select("alojamiento.codCI");
			$this->db->select("alojamiento.fechaF");
			$this->db->select("alojamiento.fechaI");
			$this->db->from('alojamiento');
			$this->db->join("reservaHistorial","reservaHistorial.numReservaH = alojamiento.numReserva");
			$this->db->where('alojamiento.codCI', $cod);

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
	 			$fechaI = $ti->fechaI;
				$fechaF = $ti->fechaF;
				$monto = $ti->precioPorNoche;
	 			}	
	 		}
			
			$datetime1 = date_create(date($fechaI));
			$datetime2 = date_create(date($fechaF));
			$interval = date_diff($datetime1, $datetime2);
			$cantNoches = $interval->format('%a');
			$montoAloj = ($cantNoches * $monto);
			$data = array(
				'numHab' => $arreglo['numHab'],
				'documento' => $arreglo['documento'],
				'precioPorNoche' => $arreglo['precioPorNoche'],
				'codCI' => $arreglo['codCI'],
				'fechaI' => $arreglo['fechaI'],
				'fechaF' => $arreglo['fechaF'],
				'cantNoches' => $cantNoches,
				'montoAloj' => $montoAloj
			);
			$this->load->view('traveler/header');
			$this->load->view('traveler/formularioCobrar', $data);
	}
	function cobrar($codCI){
			$this->db->select("reservaHistorial.precioPorNoche");
			$this->db->select("reservaHistorial.numReservaH");
			$this->db->select("alojamiento.codCI");
			$this->db->select("alojamiento.fechaF");
			$this->db->select("alojamiento.fechaI");
			$this->db->from('alojamiento');
			$this->db->join("reservaHistorial","reservaHistorial.numReservaH = alojamiento.numReserva");
			$this->db->where('alojamiento.codCI', $codCI);

			$query = $this->db->get();
			if ($query){
	 			foreach ($query->result() as $ti) { 
	 				$arreglo = array(
	 					'precioPorNoche' => $ti->precioPorNoche,
	 					'codCI' => $ti->codCI,
	 					'fechaF' => $ti->fechaF,
	 					'fechaI' => $ti->fechaI,
	 					'numReservaH' => $ti->numReservaH
	 				);
	 			$fechaI = $ti->fechaI;
				$fechaF = $ti->fechaF;
				$monto = $ti->precioPorNoche;
				$numR = $ti->numReservaH;
	 			}	
	 		}
			$datetime1 = date_create(date($fechaI));
			$datetime2 = date_create(date($fechaF));
			$interval = date_diff($datetime1, $datetime2);
			$cantNoches = $interval->format('%a');
			$montoAloj = ($cantNoches * $monto);
		    $cargos = $this->input->post('montoCargos');
		    $total = ($montoAloj + $cargos);
		    $data = array(
		 	 	'montoAloj' => $montoAloj,
			 	'codCI' => $codCI,
			 	'total' => $total,
			 	'montoCargos' => $this->input->post('montoCargos'),
				'detalleCargos' => $this->input->post('detalleCargos'),
				'numReservaH' => $numR,
				'fechaInicio' => $fechaI,
				'fechaFin' => $fechaF
			);
			$this->traveler_model->cuenta($data);
			$this->traveler_model->altaAlojamientoHistorial($data);
			$this->traveler_model->eliminarAlojamiento($codCI);
		 	$this->load->view('traveler/header');
		    $this->load->view('traveler/cobrado');
	}

	
}
?>