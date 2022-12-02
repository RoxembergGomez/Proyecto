<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso_Model extends CI_Model {


	public function listaprocesos($idplan)
	{
		$this->db->select('*');
		$this->db->from('proceso p');
		$this->db->where('p.estado','1');
		$this->db->where('p.idPlanAnualTrabajo',$idplan);
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=p.idUnidadNegocio');
		return $this->db->get();
	}




	public function agregarproceso($data)
	{
		$this->db->insert('proceso',$data);
	}
   

	public function recuperarproceso($idproceso)
	{
		$this->db->select('*');
		$this->db->from('proceso p');
		$this->db->where('p.idProceso',$idproceso);
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=p.idUnidadNegocio');
		return $this->db->get();
	}


	public function modificarproceso($idproceso,$data)
	{
		$this->db->where('idProceso',$idproceso); 
		$this->db->update('proceso',$data);
	}


	public function procesoseliminados($idplan)
	{
		$this->db->select('*');
		$this->db->from('proceso p');
		$this->db->where('p.estado','0');
		$this->db->where('p.idPlanAnualTrabajo',$idplan);
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=p.idUnidadNegocio');
		return $this->db->get();
	}
}
