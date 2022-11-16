<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemorandumPlanificacion_Model extends CI_Model {

	public function mpa()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('a.estadoEjecucion','1');
		$this->db->where('a.estado','1');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo','left');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		$this->db->order_by('m.idEmpleado');
		return $this->db->get();
	}


	public function empleado()
	{
		$this->db->select('*');
		$this->db->from('empleado e');
		$this->db->where('e.estado','1');
		$this->db->where('c.idUnidadNegocio','4');
		$this->db->join('cargo c','e.idCargo=c.idCargo');
		return $this->db->get();
	}

	public function asignarmpa($data)
	{
		$this->db->insert('memorandumplanificacion',$data);
	}

	public function recuperaridPlan($idPlan)
	{
		$this->db->select('idPlanAnualTrabajo');
		$this->db->from('plananualtrabajo');
		$this->db->where('idPlanAnualTrabajo',$idPlan);
		return $this->db->get();
	}

	public function recuperarmpa($idmpa)
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		return $this->db->get();
	}

	public function modificarmpa($idmpa,$data)
	{
		$this->db->where('idMemorandumPlanificacion',$idmpa); 
		$this->db->update('memorandumplanificacion',$data);
	}

	public function empleadoseliminados()
	{
		$this->db->select('empleado.idEmpleado,empleado.ci,empleado.expedicion,empleado.nombres,empleado.primerApellido,empleado.segundoApellido,cargo.denominacionCargo,empleado.celular,empleado.telefonoInterno,empleado.correoInstitucional');
		$this->db->from('empleado');
		$this->db->where('empleado.estado','0');
		$this->db->join('cargo','empleado.idCargo=cargo.idCargo');
		return $this->db->get();
	}


	public function misactividades()
    {
      $this->db->from('memorandumplanificacion');
      $this->db->where('idEmpleado',$this->session->userdata('idUsuario'));
      $this->db->where('estadoProceso','1');

      $this->db->or_where('idEmpleado',$this->session->userdata('idUsuario'));
      $this->db->where('estadoProceso','2');
      $this->db->or_where('idEmpleado',$this->session->userdata('idUsuario'));
      $this->db->where('estadoProceso','3');
     return $this->db->count_all_results();
    }
}
