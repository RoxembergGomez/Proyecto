<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subprocesos_Model extends CI_Model {

	public function subprocesos($idproceso)
	{
		$this->db->select('*');
		$this->db->from('subproceso s');
		$this->db->where('s.estado','1');
		$this->db->where('s.idProceso',$idproceso);
		$this->db->join('proceso p','p.idProceso=s.idProceso');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
		return $this->db->get();
	}

	public function subprocesoslist($idproceso)
	{
		$this->db->select('*');
		$this->db->from('proceso p');
		$this->db->where('p.idProceso',$idproceso);
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
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

	public function recuperarsubproceso($idsub)
	{
		$this->db->select('*');
		$this->db->from('subproceso s');
		$this->db->where('s.idSubProceso',$idsub);
		$this->db->join('proceso p','p.idProceso=s.idProceso');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
		return $this->db->get();
	}

	public function modificasubproceso($idsub,$data)
	{
		$this->db->where('idSubProceso',$idsub); 
		$this->db->update('subproceso',$data);
	}

	public function subprocesoeliminados($idproceso)
	{
		$this->db->select('*');
		$this->db->from('subproceso s');
		$this->db->where('s.estado','0');
		$this->db->where('s.idProceso',$idproceso);
		$this->db->join('proceso p','p.idProceso=s.idProceso');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
		return $this->db->get();
	}
}
