<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Reserva_model extends CI_Model{

	public $numReserva; 
	public $fechaReservacion;
	public $fechaInicio;
	public $fechaFin;
	public $cantPersonas;
	public $precioPorNoche;
	public $nombreT;
	public $numHab;
	public $documento;

	function __construct(){
		parent::__construct();
		$this->load->database();
	}


	//Alta de una reserva 
	function altaReservaHistorial($data){
		$this->db->insert('reservaHistorial', array('numReservaH'=>$data['numReservaH'],'fechaReservacion'=>$data['fechaReservacion'], 'fechaInicio' => $data['fechaInicio'], 'fechaFin' => $data['fechaFin'], 'cantPersonas' => $data['cantPersonas'], 'precioPorNoche' => $data['precioPorNoche'], 'nombreT' => $data['nombreT'], 'numHab' => $data['numHab'], 'documento' => $data['documento']));
	}


	function nuevaReserva($dato){
		//trae el nombre el ususario
		/*$this->db->select('nombreT');
		$this->db->from('usuarioT');
		$query = $this->db->get();
		foreach ($query->result() as $row) { 
			$array[] = $row->nombreT; 
		} 
		$usu = $dato['UsuarioNombre'];	
		*/
		/*
		//$usu=$array[$nombre];
		//trae el numero de la habitacion
		$this->db->select('numHab');
		$this->db->from('habitacion');
		$query = $this->db->get();

		foreach ($query->result() as $row) { 
			$array1[] = $row->numHab; 
		} 
		
		$hab=$dato['NumeroHabitacion'];

		*/

		/*
		 *pasar al modelo los controladores !!!!
		 * 
		 */
		/*$data = array(
		 	'fechaReservacion' => date('Y-m-d'),
			'fechaInicio' => $this->input->post('fechaInicio'),
			'fechaFin' => $this->input->post('fechaFin'),
			'cantPersonas' => $this->input->post('cantPersonas'),
			'nombreT' => $usu,
			'numHab' => $hab,
			'precioPorNoche' => $this->input->post('precioPorNoche'),
			'documento' => $this->input->post('documento')
		 );*/

	

		//return $reservaDisponible;
		 			
	}


	function reservasPorFecha($dato){
		$this->db->select("reserva.numReserva");
		$this->db->select("reserva.fechaInicio");
		$this->db->select("reserva.precioPorNoche");
		$this->db->select("reserva.numHab");
		$this->db->select("cliente.nombres");
		$this->db->select("cliente.apellidos");
        $this->db->from('cliente');
        $this->db->join("reserva","cliente.documento = reserva.documento");

        //$fecha1_aux = date($dato['fecha1'], 'Y-m-d');
        //$fecha2_aux = date($dato['fecha2'], 'Y-m-d'); 	
		
		$fecha1_aux = date("Y-m-d", strtotime(str_replace('/', '-', $dato['fecha1'])));

		$fecha2_aux = date("Y-m-d", strtotime(str_replace('/', '-', $dato['fecha2'])));

		
        $this->db->where('fechaInicio >=', $fecha1_aux);
        $this->db->where('fechaInicio <=', $fecha2_aux);

        $query = $this->db->get();

		//var_dump($this->db->last_query());die();
		//var_dump($query); die();

        return $query;
	}
	function reservasPorPasajero($dato){
		$this->db->select("*");
        $this->db->from('reserva');
        $this->db->where('documento', $dato['dni']);
        $query = $this->db->get();
        return $query;
	}
	function alojamientosPorFecha($dato){
		$this->db->select("alojamiento.fecha");
		$this->db->select("cliente.nombres");
		$this->db->select("cliente.apellidos");
        $this->db->from('reserva');
        $this->db->join("alojamiento","reserva.numReserva = alojamiento.numReserva");
        $this->db->join("cliente","reserva.documento = cliente.documento");
        $this->db->where('fechaInicio >=', $dato['fecha1']);
        $this->db->where('fechaInicio <=', $dato['fecha2']);
        $query = $this->db->get();
        return $query;
	}
	function alojamientoPorPasajero($dato){
		$this->db->select("alojamiento.fecha");
		$this->db->select("cliente.nombres");
		$this->db->select("cliente.apellidos");
		$this->db->from('reserva');
        $this->db->join("alojamiento","reserva.numReserva = alojamiento.numReserva");
        $this->db->join("cliente","reserva.documento = cliente.documento");
        $this->db->where('reserva.documento', $dato['dni']);
        $query = $this->db->get();
        return $query;
	}
	//Listado de alojaminetos por pasajero, $dato : DNI	
	function registroPasajeros($pDni){

		$str_dni = (string)$pDni;

		$sql = "SELECT 
					documento, 
					apellidos, 
					nombres, 
					'calleYNum', 
					'fechaNac', 
					telefono, 
					'codPost'
				FROM public.cliente
				WHERE documento  =  $str_dni";

		$query=$this->db->query($sql);

		//$query = $this->db->get();
		var_dump($query); die();
        return $query;

		/* 
		$this->db->select("*");
        $this->db->from('cliente');
        $this->db->where('documento', $dato['dni']);
        $query = $this->db->get();
		return $query;
		*/

	}
	function chequearDisponibilidad($data){
		$this->db->select("*");
		$this->db->from('reserva');
        $this->db->group_start();
        	$this->db->where('numHab', $data['numHab']);
        	$this->db->group_start();
        		$this->db->or_group_start();
                      $this->db->where('fechaInicio <=', $data['fechaInicio']);
                      $this->db->where('fechaFin >', $data['fechaInicio']);
                $this->db->group_end();
                $this->db->or_group_start();
                      $this->db->where('fechaInicio <', $data['fechaFin']);
                      $this->db->where('fechaFin >=', $data['fechaFin']);
                $this->db->group_end();
            $this->db->group_end();
      	$this->db->group_end();
		$query = $this->db->get();
		return $query;
	}

	
	function altaReserva($datas){
		$this->db->insert('reserva', array(
			'fechaReservacion'=>$datas['fechaReservacion'], 
			'fechaInicio' => $datas['fechaInicio'], 
			'fechaFin' => $datas['fechaFin'], 
			'cantPersonas' => $datas['cantPersonas'], 
			'precioPorNoche' => $datas['precioPorNoche'], 
			'nombreT' => $datas['nombreT'], 
			'numHab' => $datas['numHab'], 
			'documento' => $datas['documento']
		));
	}
	function eliminarReserva($id){
		$this->db->delete('reserva', array('numReserva'=>$id));
	}
	function arribo($data){
		$this->db->insert('alojamiento', array('fechaI'=> date('Y-m-d'), 'fechaF'=>$data['fechaFin'],'numReserva' => $data['numReservaH']));
	}
	


}
?>