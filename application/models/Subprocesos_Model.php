<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subprocesos_Model extends CI_Model {

	public function subprocesos()
	{
		$this->db->select('*');
		$this->db->from('subproceso');
		$this->db->where('estado','1');
		return $this->db->get();
	}


	public function seleccion()
	{
		$this->db->select('idCargo,denominacionCargo');
		$this->db->from('cargo');
		$this->db->where('estado','1');
		return $this->db->get();
	}

	public function agregarsubproceso($data)
	{
		$this->db->insert('subproceso',$data);
	}

	public function recuperaridproceso($idProceso)
	{
		$this->db->select('idProceso');
		$this->db->from('proceso');
		$this->db->where('idProceso',$idProceso);
		return $this->db->get();
	}

	public function eliminarempleado($idEmpleado)
	{
		$this->db->where('idEmpleado',$idEmpleado); 
		$this->db->delete('empleado');
	}

	public function recuperarempleado($idEmpleado)
	{
		$this->db->select('empleado.idEmpleado,empleado.ci,empleado.expedicion,empleado.nombres,empleado.primerApellido,empleado.segundoApellido,cargo.denominacionCargo,empleado.celular,empleado.telefonoInterno,empleado.correoInstitucional');
		$this->db->from('empleado');
		$this->db->where('idEmpleado',$idEmpleado);
		$this->db->join('cargo','empleado.idCargo=cargo.idCargo');
		return $this->db->get();
	}

	public function modificarempleado($idEmpleado,$data)
	{
		$this->db->where('idEmpleado',$idEmpleado); 
		$this->db->update('empleado',$data);
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
