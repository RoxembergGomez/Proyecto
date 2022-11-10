<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanAnualTrabajo_Model extends CI_Model {

 	//Modelo para ver el listado de la base de datos
	public function actividades()
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo p');
		$this->db->where('p.estado','1');
		$this->db->where('p.estadoEjecucion','1');
		$this->db->or_where('p.estadoEjecucion','2');
		$this->db->or_where('p.estadoEjecucion','3');
		$this->db->order_by('estadoEjecucion,fechaInicio','asc');
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

	//------------------------------REPORTES----------------------------------------//

	public function actividadespendientes()
    {
        $this->db->from('plananualtrabajo');
        $this->db->where('estadoEjecucion','2');
        return $this->db->count_all_results();
    }

    public function actividadesenproceso()
    {
        $this->db->from('plananualtrabajo');
        $this->db->where('estadoEjecucion','1');
        return $this->db->count_all_results();
    }

	public function actividadescerradas()
    {
        $this->db->select('*');
        $this->db->from('plananualtrabajo');
        $this->db->where('estadoEjecucion','3');
        $this->db->order_by('fechaInicio','asc');
        return $this->db->count_all_results();
    }



    public function pendientes()
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo');
		$this->db->where('estadoEjecucion','2');
		$this->db->order_by('fechaInicio','asc');
		return $this->db->get();
	}

	public function proceso()
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo');
		$this->db->where('estadoEjecucion','1');
		return $this->db->get();
	}

	public function ejecutadas()
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo p');
		$this->db->where('p.estadoEjecucion','3');
		$this->db->join('memorandumplanificacion m','p.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		$this->db->order_by('numeroInforme','asc');
		return $this->db->get();
	}

	public function ejecutadasporestado($estado,$empleado)
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo p');
		$this->db->where('p.estadoEjecucion',$estado);
		$this->db->where('m.idEmpleado',$empleado);
		$this->db->join('memorandumplanificacion m','p.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		$this->db->order_by('numeroInforme','asc');
		return $this->db->get();
	}


	public function generalporempleado($empleado)
	{
		$this->db->select('*');
		$this->db->from('plananualtrabajo p');
		$this->db->where('m.idEmpleado',$empleado);
		$this->db->where('p.estadoEjecucion','1');
		$this->db->or_where('m.idEmpleado',$empleado);
		$this->db->where('p.estadoEjecucion','3');
		$this->db->join('memorandumplanificacion m','p.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		$this->db->order_by('p.estadoEjecucion','m.numeroInforme');
		return $this->db->get();
	}


	public function enprocesoporempleado()
	{
		$this->db->select('e.nombres,e.primerApellido,e.segundoApellido,e.idEmpleado,
			COUNT(idMemorandumPlanificacion) AS cantidad');
		$this->db->from('empleado e');
		$this->db->join('memorandumplanificacion m','e.idEmpleado=m.idEmpleado');
		$this->db->group_by('e.idEmpleado');
		return $this->db->get();
	}
}
