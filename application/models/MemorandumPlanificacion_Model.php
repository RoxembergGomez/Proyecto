<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemorandumPlanificacion_Model extends CI_Model {

	public function mpa()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoProceso','1');
		$this->db->or_where('m.estadoProceso','2');
		$this->db->or_where('m.estadoProceso','3');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		return $this->db->get();
	}


	public function seleccion()
	{
		$this->db->select('*');
		$this->db->from('empleado e');
		$this->db->where('e.estado','1');
		$this->db->join('cargo c','e.idCargo=c.idCargo');
		return $this->db->get();
	}

	public function selectcargo()
	{
		$this->db->select('idCargo');
		$this->db->from('cargo');
		$this->db->where('estado','1');
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

	public function eliminarmpa($idEmpleado)
	{
		$this->db->where('idEmpleado',$idEmpleado); 
		$this->db->delete('empleado');
	}

	public function recuperarmpa($idEmpleado)
	{
		$this->db->select('empleado.idEmpleado,empleado.ci,empleado.expedicion,empleado.nombres,empleado.primerApellido,empleado.segundoApellido,cargo.denominacionCargo,empleado.celular,empleado.telefonoInterno,empleado.correoInstitucional');
		$this->db->from('empleado');
		$this->db->where('idEmpleado',$idEmpleado);
		$this->db->join('cargo','empleado.idCargo=cargo.idCargo');
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
}
