<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanAnualTrabajo_Model extends CI_Model {

 	//Modelo para ver el listado de la base de datos
	public function actividades()
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo');
		$this->db->where('estado','1');
		return $this->db->get();

	}

	//Modelo para Agregar a base de datos
	public function agregaractividad($data)
	{
		$this->db->insert('plananualtrabajo',$data);
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
}
