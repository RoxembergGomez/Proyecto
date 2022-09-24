<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proceso_Model extends CI_Model {

 	//Modelo para ver el listado de la base de datos
	public function procesos_subprocesos()
	{
		$this->db->select('p.idProceso,p.descripcionProceso,
			sp.descripcionSubProceso,sp.clasificacionCriticidad');
		$this->db->from('proceso p');
		$this->db->where('p.estado','1');
		$this->db->where('sp.estado','1');
		$this->db->join('subproceso sp','p.idProceso=sp.idProceso');
		return $this->db->get();
	}

	public function listaprocesos()
	{
		$this->db->select('p.idProceso,a.informe,p.descripcionProceso');
		$this->db->from('proceso p');
		$this->db->where('p.estado','1');
		$this->db->where('p.estado','1');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=p.idPlanAnualTrabajo');
		return $this->db->get();
	}

	//Modelo para Agregar a base de datos
	public function agregarproceso($data)
	{
		$this->db->insert('proceso',$data);
	}
   
    //Modelo para recupaerar los valores registrados y modificar los datos en base a los que ya fueron registrados
	public function recuperaractividad($idPlan)
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo');
		$this->db->where('idPlanAnualTrabajo',$idPlan); 
		return $this->db->get();
	}

	//Modelo para modificar los datos en la base de datos
	public function modificaractividad($idPlan,$data)
	{
		$this->db->where('idPlanAnualTrabajo',$idPlan); 
		$this->db->update('plananualtrabajo',$data);
	}

	//Modelo para eliminación lógica de los datos
	public function actividadeseliminadas()
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo');
		$this->db->where('estado','0');
		return $this->db->get();
	}

	public function buscar($dato)
	{
		$this->db->from('plananualtrabajo');
		$this->db->like('informe',$dato,'both');
		return $this->db->get();
	}


}
