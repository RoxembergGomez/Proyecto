<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_Model extends CI_Model {

	public function pendientes()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoProceso','1');
		$this->db->where('m.estadoHallazgo','1');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->group_by('m.numeroInforme');
		return $this->db->get();
	}

	public function revision()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoProceso','2');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->group_by('m.numeroInforme');
		return $this->db->get();
	}


	public function enviados()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoProceso','3');
		$this->db->where('h.idEmpleado',$this->session->userdata('idUsuario'));
		$this->db->where('m.estadoProceso','3');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('hallazgo h','p.idProgramaTrabajo=h.idProgramaTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		$this->db->group_by('m.numeroInforme,m.estadoProceso');
		return $this->db->get();
	}

	public function concluidos()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoProceso','4');
		$this->db->where('a.estadoEjecucion','3');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->group_by('m.numeroInforme');
		return $this->db->get();
	}
	
	public function observaciones($idmpa)
	{
		$this->db->select('*');
		$this->db->from('hallazgo h');
		$this->db->where('h.estado','1');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('programatrabajo p','p.idProgramaTrabajo=h.idProgramaTrabajo');
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		return $this->db->get();
	}

	public function observacionesenviadas($idmpa)
	{
		$this->db->select('*');
		$this->db->from('hallazgo h');
		$this->db->where('h.estado','1');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->where('h.idEmpleado',$this->session->userdata('idUsuario'));
		$this->db->join('programatrabajo p','p.idProgramaTrabajo=h.idProgramaTrabajo');
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		return $this->db->get();
	}

//ENVIADOS A DESCARGOS VISTA JEFE Y EJECUTOR
	public function enviadosdescargos()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoProceso','3');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('hallazgo h','p.idProgramaTrabajo=h.idProgramaTrabajo');
		$this->db->join('empleado e','e.idEmpleado=m.idEmpleado');
		$this->db->group_by('m.numeroInforme,m.estadoProceso');
		return $this->db->get();
	}

	public function observacionesenviadasdescargos($idmpa)
	{
		$this->db->select('*');
		$this->db->from('hallazgo h');
		$this->db->where('h.estado','1');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('programatrabajo p','p.idProgramaTrabajo=h.idProgramaTrabajo');
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		return $this->db->get();
	}


	public function vistaobservaciones($idhallazgo)
	{
		$this->db->select('*');
		$this->db->from('hallazgo h');
		$this->db->where('h.idHallazgo',$idhallazgo);
		$this->db->join('empleado e','e.idEmpleado=h.idEmpleado');
		return $this->db->get();
	}

	public function comentarios($idobservacion,$data)
	{
		$this->db->where('idHallazgo',$idobservacion); 
		$this->db->update('hallazgo',$data);
	}


	public function recuperarid($idmpa)
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion');
		$this->db->where('estado','1');
		$this->db->where('idMemorandumPlanificacion',$idmpa);
		return $this->db->get();
	}

	public function selectsubproceso($plan)
	{
		$this->db->select('p.idProceso,p.idPlanAnualTrabajo,s.idSubProceso,
			s.descripcionSubProceso,s.estado,s.idProceso');
		$this->db->from('proceso p');
		$this->db->where('p.idPlanAnualTrabajo',$plan);
		$this->db->where('s.estado','1');
		$this->db->join('subproceso s','p.idProceso=s.idProceso');
		return $this->db->get();
	}

	public function agregarprograma($data)
	{
		$this->db->trans_begin(); 
		foreach ($data['data'] as  $value) {
			$this->db->insert('programatrabajo', array(      
				'actividad' => $value->actividad,      
				'idUsuario' => $this->session->userdata('idUsuario'),       
				'idSubProceso' => $value->subproceso,
				'idMemorandumPlanificacion' => $value->mpa,         
			));  
		}
	   if ($this->db->trans_status() === FALSE){      
		  $this->db->trans_rollback();      
		  return false;    
	   }else{      
		  $this->db->trans_commit();    
		  return true;    
	   }  
	}


	public function recuperarobservaciones($idhallazgo)
	{
		$this->db->select('*');
		$this->db->from('hallazgo h');
		$this->db->where('h.estado','1');
		$this->db->where('h.idHallazgo',$idhallazgo);
		$this->db->join('programatrabajo p','p.idProgramaTrabajo=h.idProgramaTrabajo');
		$this->db->join('subproceso sp','sp.idSubProceso=p.idSubProceso');
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('empleado e','e.idEmpleado=h.idEmpleado');
		return $this->db->get();
	}

	public function modificarobservacion($idhallazgo,$data)
	{
		$this->db->where('idHallazgo',$idhallazgo); 
		$this->db->update('hallazgo',$data);
	}

	public function agregarobservacion($dataobs)
	{
		$this->db->insert('hallazgo',$dataobs);
	}

	/*public function recuperarempleado($idEmpleado)
	{
		$this->db->select('e.idEmpleado,e.ci,e.expedicion,e.nombres,e.primerApellido,e.segundoApellido,
							c.denominacionCargo,e.celular,e.telefonoInterno,e.correoInstitucional,e.idCargo,c.denominacionCargo');
		$this->db->from('empleado e');
		$this->db->where('e.idEmpleado',$idEmpleado);
		$this->db->join('cargo c','e.idCargo=c.idCargo');
		return $this->db->get();
	}

	public function modificarempleado($idEmpleado,$data)
	{
		$this->db->where('idEmpleado',$idEmpleado); 
		$this->db->update('empleado',$data);
	}


	public function empleadoseliminados()
	{
		$this->db->select('e.idEmpleado,e.ci,e.expedicion,e.nombres,e.primerApellido,e.segundoApellido,
			c.denominacionCargo,e.celular,e.telefonoInterno,e.correoInstitucional');
		$this->db->from('empleado e');
		$this->db->where('e.estado','0');
		$this->db->join('cargo c','e.idCargo=c.idCargo');
		return $this->db->get();
	}*/


	//---------------------REPORTES----------------------

	public function hallazgosrevision()
    {
        $this->db->from('memorandumplanificacion');
        $this->db->where('estadoProceso','2');
        return $this->db->count_all_results();
    }
    public function hallazgosenviados()
    {
        $this->db->from('memorandumplanificacion');
        $this->db->where('estadoProceso','3');
        return $this->db->count_all_results();
    }
}
