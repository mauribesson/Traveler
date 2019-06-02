<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class ElIndeseable_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function altaPersona($data){
		$this->db->insert('Infractor', array('nombreI'=>$data['nombreI'], 'apellido'=>$data['apellido'], 'dni'=>$data['dni']));
	}
	function obtenerInfractores(){
		 $query = $this->db->get('Infractor');
		 if($query->num_rows()>0) return $query;
		 else return false;
	}
	function obtenerInfractor($id){
		$this->db->where('dni', $id);
		 $query = $this->db->get('Infractor');
		 if($query->num_rows()>0) return $query;
		 else return false;
	}
	function actualizarInfractor($DNI, $data){
		$datos = array(
			'nombreI'=>$data['nombreI'], 
			'apellido'=>$data['apellido'], 
			'dni'=>$data['dni']
			);
		$this -> db ->where('dni', $DNI);
		$query = $this->db->update('Infractor', $datos);
	}
	function nuevaInfraccion($data){
		$this->db->insert('Infraccion', array('nombreU'=>$data['nombreU'], 'dni'=>$data['dni'], 'fecha' =>$data['fecha'], 'tipoInfraccion'=>$data['tipoInfraccion']));
	}
	function eliminarInfractor($DNI){
		$this->db->delete('Infractor', array('dni'=>$DNI));
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
}
?>