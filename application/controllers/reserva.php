<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Reserva extends CI_Controller{
	function __construct(){
		parent::__construct();	
	    //Modelos
		$this->load->model('reserva_model');
        $this->load->model('traveler_model');
        $this->load->model('usuario_model');
        $this->load->model('habitacion_model');		
		$this->load->library('session');
		//Helper
		$this->load->helper('fechaSQL_helper');
	}

    function nuevaReserva($validacion = array()){
		$dato['usarios'] = $this->usuario_model->listadoUsuarios();
        $dato['habitacion'] = $this->habitacion_model->listadoHabitaciones();

        if (!empty($validacion))
            $dato['validacion'] = $validacion; 

		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioNuevaReserva', $dato);
	}

	function guardarNuevaReserva(){
		$dato = array();	
		//Transformar Fecha del calendario, usando Helper
		$fechaInicio = fechaSQL_helper($this->input->post('fechaInicio'));		
		$fechaFin = fechaSQL_helper($this->input->post('fechaFin')); 	

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

        //VALIDACIN DE FORMULARIO    
        $validacion = $this->ValidarFormularioNuevaReserva($dato);
    
		if (empty($validacion))
			{ // formulario correcto, si la validacion esta vacia.        
				$reservaDisponible = array();
				$reservaDisponible['reserva'] = $this->traveler_model->chequearDisponibilidad($dato);

				// SI HAY UNA RESERVA INDICA QUE NO HAY DISPONIBILIDAD
				// SINO DA DE ALTA LA NUEVA RESERVA. 
				if ($reservaDisponible['reserva']->result()){
					$this->load->view('traveler/header');
					$this->load->view('traveler/reserva/noDisponible');			
				}else{
					var_dump($dato);
					$this->reserva_model->altaReserva($dato);
					$this->load->view('traveler/header');
					$this->load->view('traveler/reserva/altaReserva');   
				}            
			}
			else
				{ //Si hay errores en el formulario 
            		$this->nuevaReserva($validacion);
        		}   		
	}

	//Validar formulario de nueva reserva
	function ValidarFormularioNuevaReserva($DatosFotmulario = array()){

		//Creaar un objeto de validacion 
		$campo = new stdClass();
		$campo->estado = false;
		$campo->valor = '';

		$resultado = array($campo);




		//fechaInicio
		if($DatosFotmulario['fechaInicio'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['fechaInicio'];
				$resultado['fechaInicio'] = $campo; 
			}			
		else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['fechaInicio']; //guarda el valor vacio 
				$resultado['fechaInicio'] = $campo; 
			}


		//fechaFin
		if($DatosFotmulario['fechaFin'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['fechaFin'];
				$resultado['fechaFin'] = $campo; 
			}			
		else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['fechaFin']; //guarda el valor vacio 
				$resultado['fechaFin'] = $campo; 
			}	
			   

		//cantPersonas
		if($DatosFotmulario['cantPersonas'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['cantPersonas'];
				$resultado['cantPersonas'] = $campo; 
			}			
		else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['cantPersonas']; //guarda el valor vacio 
				$resultado['cantPersonas'] = $campo; 
			}

		//nombreT
		if($DatosFotmulario['nombreT'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['nombreT'];
				$resultado['nombreT'] = $campo; 
			}			
		else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['nombreT']; //guarda el valor vacio 
				$resultado['nombreT'] = $campo; 
			}

		//numHab
		if($DatosFotmulario['numHab'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['numHab'];
				$resultado['numHab'] = $campo; 
			}			
			else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['numHab']; //guarda el valor vacio 
				$resultado['numHab'] = $campo; 
			}

		//precioPorNoche
		if($DatosFotmulario['precioPorNoche'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['precioPorNoche'];
				$resultado['precioPorNoche'] = $campo; 
			}			
			else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['precioPorNoche']; //guarda el valor vacio 
				$resultado['precioPorNoche'] = $campo; 
			}

		//documento
		if($DatosFotmulario['documento'] != '')
			{
				$campo->estado = true; //ok, el campo esta cargado 
				$campo->valor = $DatosFotmulario['documento'];
				$resultado['documento'] = $campo; 
			}			
		else
			{
				$campo->estado = false; //ok
				$campo->valor = $DatosFotmulario['documento']; //guarda el valor vacio 
				$resultado['documento'] = $campo; 
			}




		//###########################################################################

		/*
		//fechaFin *
		if($DatosFotmulario['fechaFin'] != '')
			$resultado['fechaFin'] = true; //ok
		else
			$resultado['fechaFin'] = false; //no ok   

		//cantPersonas *
		if($DatosFotmulario['cantPersonas'] != '')
			$resultado['cantPersonas'] = true;
		else
			$resultado['cantPersonas'] = false;	
		
		//nombreT *
		if($DatosFotmulario['nombreT'] != '')
			$resultado['nombreT'] = true;
		else
			$resultado['nombreT'] = false;	

		//numHab *
		if($DatosFotmulario['numHab'] != '')
			$resultado['numHab'] = true;
		else
			$resultado['numHab'] = false;	

		//precioPorNoche * 
		if($DatosFotmulario['precioPorNoche'] != '')
			$resultado['precioPorNoche'] = true;
		else
			$resultado['precioPorNoche'] = false;
			
		//documento *	
		if($DatosFotmulario['documento'] != '')
			$resultado['documento'] = true;
		else
			$resultado['documento'] = false;

		*/	
		//armar todos los que estan mal para devolver a la vista 
		
        $cont = 0;
        foreach ($resultado as $e){             
            if ($e->estado == false)
                $cont++;
        }

        if ($cont > 0) //Faltan campos
            return $resultado;
        else
            return array(); // Formulario OK   		
		
	} 

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
		$dato = array(
			'dni' => $this->input->post('dni')
		);
		$dato['pasajero'] = $this->reserva_model->reservasPorpasajero($dato);
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


}

	