<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class ElIndeseable extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('elIndeseable_model');
	}
	function index(){
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/inicio');
	}
	function nuevo(){
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/formulario');
	}
	function recibirDatos(){
		$data = array(
			'nombreI' => $this->input->post('nombreI'),
			'apellido' => $this->input->post('apellido'),
			'dni' => $this->input->post('dni')
		);
		$this->elIndeseable_model->altaPersona($data);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/altaInfractor');
	}
	function consultar(){
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/formularioConsulta');
	}
	function recibirConsulta(){
		$data = array(
			'dni' => $this->input->post('dni')
			);
		$dato['infractor'] = $this->elIndeseable_model->consulta($data['dni']);
		$dato['dni'] = $data['dni'];
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/consulta', $dato);
	}
	function nuevaConsulta($dni){
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/formularioNuevaInfraccion',$dni);
	}
	function recibirNuevaInfraccion($dni){
		$id=$this->input->post('tipo');
		$id = $id + 1;
		$data = array(
				'nombreU' => $this->input->post('nombreU'),
				'dni' => $dni,
				'fecha' => $this->input->post('fecha'),
				'tipoInfraccion' => $id
				);
		$this->elIndeseable_model->nuevaInfraccion($data);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/nuevaInfraccion');
	}
	function nuevaInfraccion($dni){
		$data = array(
			'dni' => $dni
			);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/formularioNuevaInfraccion', $data);
	}
	function modificar($dni){
		$data = array(
			'dni' => $dni
			);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/formularioModificacion', $data);
	}
	function modificarInfractor($dni){
		$data = array(
			'nombreI' => $this->input->post('nombreI'),
			'apellido' => $this->input->post('apellido'),
			'dni' => $dni
		);
		$this->elIndeseable_model->actualizarInfractor($dni, $data);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/actualizarInfractor');
	}
	function editar(){
		$data['DNI'] = $this->uri->segment(3);
		$data['Infractor'] = $this->elIndeseable_model->obtenerInfractor($data['DNI']);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/editar',$data);
	}
	function eliminar($dni){
		$data = array(
			'dni' => $dni
			);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/formularioEliminacion', $data);
	}
	function eliminarInfractor($dni){
		$this->elIndeseable_model->eliminarInfractor($dni);
		$this->load->view('ElIndeseable/headers');
		$this->load->view('ElIndeseable/eliminarInfractor');
	}
}
?>