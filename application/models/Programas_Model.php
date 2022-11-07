<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programas_Model extends CI_Model {

	public function programas()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoPrograma','1');
		$this->db->or_where('m.estadoPrograma','2');
		$this->db->or_where('m.estadoPrograma','3');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->group_by('m.numeroInforme');
		$this->db->order_by('m.estadoPrograma','m.numeroInforme');
		return $this->db->get();
	}


	public function programascerrados()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('m.estado','1');
		$this->db->where('m.estadoPrograma','4');
		$this->db->join('plananualtrabajo a','a.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('programatrabajo p','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->group_by('m.numeroInforme');
		$this->db->order_by('m.estadoPrograma');
		return $this->db->get();
	}

	public function actividades($idmpa)
	{
		$this->db->select('*');
		$this->db->from('programatrabajo p');
		$this->db->where('p.estado','1');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('subproceso s','s.idSubProceso=p.idSubProceso');
		$this->db->order_by('s.descripcionSubProceso,s.clasificacionCriticidad');
		return $this->db->get();
	}

	public function vistaejecucion($idPrograma)
	{
		$this->db->select('*');
		$this->db->from('programatrabajo pt');
		$this->db->where('pt.estado','1');
		$this->db->where('pt.idProgramaTrabajo',$idPrograma);
		$this->db->join('subproceso sp','sp.idSubProceso=pt.idSubProceso');
		return $this->db->get();
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



	// MODIFICAR LOS PROGRAMAS ANTES DE SU ENVÍO
	public function recuperarprograma($idprograma)
	{
		$this->db->select('*');
		$this->db->from('programatrabajo p');
		$this->db->where('p.estado','1');
		$this->db->where('p.idProgramaTrabajo',$idprograma);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('subproceso s','s.idSubProceso=p.idSubProceso');
		return $this->db->get();
	}

	public function modificarprograma($idprograma,$data)
	{
		$this->db->where('idProgramaTrabajo',$idprograma); 
		$this->db->update('programatrabajo',$data);
	}


	public function actividadeseliminadas($idmpa)
	{
		$this->db->select('*');
		$this->db->from('programatrabajo p');
		$this->db->where('p.estado','0');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=p.idMemorandumPlanificacion');
		$this->db->join('subproceso s','s.idSubProceso=p.idSubProceso');
		$this->db->order_by('s.descripcionSubProceso,s.clasificacionCriticidad');
		return $this->db->get();
	}

	public function agregarobservacion($dataobs)
	{
		$this->db->insert('hallazgo',$dataobs);
	}



//----------------REPORTES ---------------------
	public function programasrevision()
    {
        $this->db->from('memorandumplanificacion');
        $this->db->where('estadoPrograma','2');
        return $this->db->count_all_results();
    }
    public function programasaprobados()
    {
        $this->db->from('memorandumplanificacion');
        $this->db->where('estadoPrograma','3');
        return $this->db->count_all_results();
    }
}
