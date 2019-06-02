<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Traveler_model extends CI_Model{
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
	function reservasPorPasajero($dato){
		$this->db->select("*");
        $this->db->from('reserva');
        $this->db->where('documento', $dato['dni']);
        $query = $this->db->get();
        return $query;
	}
	function alojamientosPorFecha($dato){
		/**$this->db->select("alojamiento.fechaI");
		$this->db->select("alojamiento.fechaF");
		$this->db->select("cliente.nombres");
		$this->db->select("cliente.apellidos");
        $this->db->from('reserva');
        $this->db->join("alojamiento","reserva.numReserva = alojamiento.numReserva");
        $this->db->join("cliente","reserva.documento = cliente.documento");
        $this->db->where('fechaInicio >='. $dato['fecha1']);
		$this->db->where('fechaInicio <='. $dato['fecha2']);
		**/
		$fi = $dato['fecha1'];//ya formateada en el controlador
		$ff = $dato['fecha2'];//ya formateada en el controlador

		$sql = ' 
		SELECT alojamiento."fechaI",
		 alojamiento."fechaF", cliente."nombres",
		 cliente."apellidos" 
		 FROM reserva 
		 JOIN alojamiento ON reserva."numReserva" = alojamiento."numReserva" 
		 JOIN cliente ON reserva."documento" = cliente."documento"
		  WHERE "fechaInicio" >= \''.$fi.'\' AND "fechaInicio" <= \''.$ff.'\'
		
		';

		$query=$this->db->query($sql);

		//$query = $this->db->get();
		var_dump($query); die();
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
	function registroPasajeros($dato){
		$this->db->select("*");
        $this->db->from('cliente');
        $this->db->where('documento', $dato['dni']);
        $query = $this->db->get();
        return $query;
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
		$this->db->insert('reserva', array('fechaReservacion'=>$datas['fechaReservacion'], 'fechaInicio' => $datas['fechaInicio'], 'fechaFin' => $datas['fechaFin'], 'cantPersonas' => $datas['cantPersonas'], 'precioPorNoche' => $datas['precioPorNoche'], 'nombreT' => $datas['nombreT'], 'numHab' => $datas['numHab'], 'documento' => $datas['documento']));
	}
	function eliminarReserva($id){
		$this->db->delete('reserva', array('numReserva'=>$id));
	}
	function arribo($data){
		$this->db->insert('alojamiento', array('fechaI'=> date('Y-m-d'), 'fechaF'=>$data['fechaFin'],'numReserva' => $data['numReservaH']));
	}
	function altaReservaHistorial($data){
		$this->db->insert('reservaHistorial', array('numReservaH'=>$data['numReservaH'],'fechaReservacion'=>$data['fechaReservacion'], 'fechaInicio' => $data['fechaInicio'], 'fechaFin' => $data['fechaFin'], 'cantPersonas' => $data['cantPersonas'], 'precioPorNoche' => $data['precioPorNoche'], 'nombreT' => $data['nombreT'], 'numHab' => $data['numHab'], 'documento' => $data['documento']));
	}
	function cuenta($data){
		$this->db->insert('cuenta', array('montoAloj'=>$data['montoAloj'],'codCI'=>$data['codCI'], 'total' => $data['total'], 'montoCargos' => $data['montoCargos'], 'detalleCargos' => $data['detalleCargos']));
	}
	function altaAlojamientoHistorial($data){
		$this->db->insert('alojamientoHistorial', array('codCIH'=>$data['codCI'], 'fechaI'=> $data['fechaInicio'], 'fechaF'=>$data['fechaFin'],'numReserva' => $data['numReservaH']));
	}
	function eliminarAlojamiento($codCI){
		$this->db->delete('alojamiento', array('codCI'=>$codCI));
	}
}
?>