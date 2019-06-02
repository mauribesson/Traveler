<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Usuario_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function altaUsuario($data){
		$this->db->insert('usuarioT', array('nombreT'=>$data['nombreT'],'contrasenia'=>$data['contrasenia']));
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
	
	function consultaUsuarios(){
		$this->db->select("nombreT");
        $this->db->from('usuarioT');
        $query = $this->db->get();
        return $query;
	}
	function consultaCargos(){
		$this->db->select("detalleCargo");
        $this->db->from('cargos');
        $query = $this->db->get();
        return $query;
	}
	
	function reservasPorPasajero($dato){
		$this->db->select("*");
        $this->db->from('reserva');
        $this->db->where('documento', $dato['dni']);
        $query = $this->db->get();
        return $query;
	}


	function listadoUsuarios(){
		 $this->db->select("*");
        $this->db->from('usuarioT');        
		$query = $this->db->get();		
		
		//$query = $this->db->query('SELECT * FROM "usuarioT"');

        return $query->result();
	}
	
}
