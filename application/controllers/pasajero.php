<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Pasajero extends CI_Controller{
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

	function registroPasajeros(){
		$this->load->view('traveler/header');
		$this->load->view('traveler/pasajero/formularioRegistroPasajero');
	}

	function listadoPorPasajero(){
		$dato = array(
			'dni' => $this->input->post('dni')
		);
		$dato['pasajero'] = $this->reserva_model->reservasPorpasajero($dato);
		$this->load->view('traveler/header');
		$this->load->view('traveler/reserva/listadoPorPasajero', $dato);
    }

}