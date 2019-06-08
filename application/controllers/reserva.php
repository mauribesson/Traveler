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
		$resultado = array();

		//Creaar un objeto de validacion
		$campo1 = new stdClass();
		$campo1->estado = false;
		$campo1->valor = '';

		$campo2 = new stdClass();
		$campo2->estado = false;
		$campo2->valor = '';

		$campo3 = new stdClass();
		$campo3->estado = false;
		$campo3->valor = '';

		$campo4 = new stdClass();
		$campo4->estado = false;
		$campo4->valor = '';

		$campo5 = new stdClass();
		$campo5->estado = false;
		$campo5->valor = '';

		$campo6 = new stdClass();
		$campo6->estado = false;
		$campo6->valor = '';

		$campo7 = new stdClass();
		$campo7->estado = false;
		$campo7->valor = '';
	

		//fechaInicio
		if($DatosFotmulario['fechaInicio'] != '')
			{
				
				$campo1->estado = true; //ok, el campo esta cargado 
				$campo1->valor = $DatosFotmulario['fechaInicio'];
				$resultado['fechaInicio'] = $campo1; 
			}			
		else
			{
				$campo1->estado = false; //ok
				$campo1->valor = $DatosFotmulario['fechaInicio']; //guarda el valor vacio 
				$resultado['fechaInicio'] = $campo1; 
			}


		//fechaFin
		if($DatosFotmulario['fechaFin'] != '')
			{
				$campo2->estado = true; //ok, el campo esta cargado 
				$campo2->valor = $DatosFotmulario['fechaFin'];
				$resultado['fechaFin'] = $campo2; 
			}			
		else
			{
				$campo2->estado = false; //ok
				$campo2->valor = $DatosFotmulario['fechaFin']; //guarda el valor vacio 
				$resultado['fechaFin'] = $campo2; 
			}	
			   

		//cantPersonas
		if($DatosFotmulario['cantPersonas'] != '')
			{
				$campo3->estado = true; //ok, el campo esta cargado 
				$campo3->valor = $DatosFotmulario['cantPersonas'];
				$resultado['cantPersonas'] = $campo3; 
			}			
		else
			{
				$campo3->estado = false; //ok
				$campo3->valor = $DatosFotmulario['cantPersonas']; //guarda el valor vacio 
				$resultado['cantPersonas'] = $campo3; 
			}

		//nombreT
		if($DatosFotmulario['nombreT'] != '')
			{
				$campo4->estado = true; //ok, el campo esta cargado 
				$campo4->valor = $DatosFotmulario['nombreT'];
				$resultado['nombreT'] = $campo4; 
			}			
		else
			{
				$campo4->estado = false; //ok
				$campo4->valor = $DatosFotmulario['nombreT']; //guarda el valor vacio 
				$resultado['nombreT'] = $campo4; 
			}

		//numHab
		if($DatosFotmulario['numHab'] != '')
			{
				$campo5->estado = true; //ok, el campo esta cargado 
				$campo5->valor = $DatosFotmulario['numHab'];
				$resultado['numHab'] = $campo5; 
			}			
			else
			{
				$campo5->estado = false; //ok
				$campo5->valor = $DatosFotmulario['numHab']; //guarda el valor vacio 
				$resultado['numHab'] = $campo5; 
			}

		//precioPorNoche

			
		if($DatosFotmulario['precioPorNoche'] != '' )
			{
				$campo6->estado = true; //ok, el campo esta cargado 
				$campo6->valor = $DatosFotmulario['precioPorNoche'];
				$resultado['precioPorNoche'] = $campo6; 				
				
			}			
			else
			{
				$campo6->estado6 = false; //ok
				$campo6->valor6 = $DatosFotmulario['precioPorNoche']; //guarda el valor vacio 
				$resultado['precioPorNoche'] = $campo6; 
			}

		//documento
		if($DatosFotmulario['documento'] != '')
			{
				$campo7->estado = true; //ok, el campo esta cargado 
				$campo7->valor = $DatosFotmulario['documento'];
				$resultado['documento'] = $campo7; 
			}			
		else
			{
				$campo7->estado = false; //ok
				$campo7->valor = $DatosFotmulario['documento']; //guarda el valor vacio 
				$resultado['documento'] = $campo7; 
			}
			
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

		$dato['reservas'] = $this->reserva_model->reservasPorFecha($data);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listadoPorFecha', $dato);
	}

	function reservasPorPasajero(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/formularioReservaPorPasajero');
    }
        
	/*function listadoPorPasajero(){
		$dato = array(
			'dni' => $this->input->post('dni')
		);
		$dato['pasajero'] = $this->reserva_model->reservasPorpasajero($dato);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listadoPorPasajero', $dato);
    }*/
    
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

	//Listado de pasajero 
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

	