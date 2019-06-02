<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class TipoHabitacion_model extends CI_Model{
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
	
	function actualizarTipoHabitacion($data){
		 $datos = array(
		 	'nombreTipo'=>$data['nuevoNombreTipo']
		 	);
		$this -> db ->where('nombreTipo', $data['nombreTipo']);
		$query = $this->db->update('tipoHabitacion', $datos);
	}	

	function consultaTiposHabitacion(){
		$this->db->select("tipoHab, nombreTipo");
        $this->db->from('tipoHabitacion');
        $this->db->order_by('tipoHab', 'ASC');
        $query = $this->db->get();
        return $query;
	}
	
	
}