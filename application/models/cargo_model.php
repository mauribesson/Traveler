<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Cargo_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function altaCargo($data){
		$this->db->insert('cargos', array('detalleCargo'=>$data['detalleCargo']));
	}
	function actualizarUsuario($data){
		 $datos = array(
		 	'nombreT'=>$data['nuevoNombreT'],
		 	'contrasenia'=>$data['contrasenia']
		 	);
		$this -> db ->where('nombreT', $data['nombreT']);
		$query = $this->db->update('usuarioT', $datos);
	}
	function eliminarUsuario($data){
		$this->db->delete('usuarioT', array('nombreT'=>$data['nombreT']));
	}
	function actualizarCargo($data){
		 $datos = array(
		 	'detalleCargo'=>$data['nuevoDetalleCargo']
		 	);
		$this -> db ->where('detalleCargo', $data['detalleCargo']);
		$query = $this->db->update('cargos', $datos);
	}
	function eliminarCargo($data){
		$this->db->delete('cargos', array('detalleCargo'=>$data['detalleCargo']));
	}

	
	function consultaCargos(){
		$this->db->select("detalleCargo");
        $this->db->from('cargos');
        $query = $this->db->get();
        return $query;
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

      
		$fecha1_aux = date("Y-m-d", strtotime($dato['fecha1']));

		$fecha2_aux = date("Y-m-d", strtotime($dato['fecha2']));

        $this->db->where('fechaInicio >=', $fecha1_aux);
        $this->db->where('fechaInicio <=', $fecha2_aux);

        $query = $this->db->get();

        var_dump($this->db->last_query());die();
        return $query;
	}
	
}