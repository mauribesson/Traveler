<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Habitacion_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function altaTipoHabitacion($data){
		$this->db->insert('tipoHabitacion', array('nombreTipo'=>$data['nombreTipo']));
	}
	function eliminarTipoHabitacion($data){
		$this->db->delete('tipoHabitacion', array('nombreTipo'=>$data['nombreTipo']));
	}
	function actualizarInfractor($data){
		$datos = array(
			'nombreTipo'=>$data['nombreTipo']
			);
		$this -> db ->where('nombreTipo', $data['nombreTipo']);
		$query = $this->db->update('tipoHabitacion', $datos);
	}	
	function actualizarTipoHabitacion($data){
		 $datos = array(
		 	'nombreTipo'=>$data['nuevoNombreTipo']
		 	);
		$this -> db ->where('nombreTipo', $data['nombreTipo']);
		$query = $this->db->update('tipoHabitacion', $datos);
	}
	function altaHabitacion($data){
		$this->db->insert('habitacion', array('numHab' => $data['numHab'],'tipoHab'=>$data['nombreTipo']));
	}
	function eliminarHabitacion($data){
		$this->db->delete('habitacion', array('numHab'=>$data['numHab']));
	}
	function actualizarHabitacion($data){
		 $datos = array(
		 	'numHab'=>$data['nuevoNumHab'],
		 	'tipoHab'=>$data['tipoHab']
		 	);
		$this -> db ->where('numHab', $data['numHab']);
		$query = $this->db->update('habitacion', $datos);
	}
	

	function consultaTiposHabitacion(){
		$this->db->select("tipoHab, nombreTipo");
        $this->db->from('tipoHabitacion');
        $this->db->order_by('tipoHab', 'ASC');
        $query = $this->db->get();
        return $query;
	}
	function consultaHabitaciones(){
		$this->db->select("habitacion.numHab");
		$this->db->select("tipoHabitacion.nombreTipo");
        $this->db->from('tipoHabitacion');
        $this->db->join("habitacion","tipoHabitacion.tipoHab = habitacion.tipoHab");
        $query = $this->db->get();
        return $query;
	}
	function consulta($dni){
		$this->db->select("Infraccion.nombreU");
		$this->db->select("TipoInfraccion.nombreTipo");
		$this->db->select("Infraccion.fecha");
        $this->db->from('TipoInfraccion');
        $this->db->join("Infraccion","TipoInfraccion.id = Infraccion.tipoInfraccion");
        $this->db->join("Infractor","Infraccion.dni = Infractor.dni");
        $this->db->where('Infractor.dni', $dni);
        $query = $this->db->get();
        return $query;
	}
	function consultaHabitacion($numHab){
		$this->db->select("habitacion.numHab");
		$this->db->select("tipoHabitacion.nombreTipo");
        $this->db->from('tipoHabitacion');
        $this->db->join("habitacion","tipoHabitacion.tipoHab = habitacion.tipoHab");
        $this->db->where('habitacion.numHab', $numHab);
        $query = $this->db->get();
        return $query;
	}


	function listadoHabitaciones(){
		$this->db->select("*");
	   $this->db->from('habitacion');        
	   $query = $this->db->get();		
	   
	   //$query = $this->db->query('SELECT * FROM "usuarioT"');

	   return $query->result();
   }
	
}
?>