<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequerimientoInformacion_Model extends CI_Model {

	public function vistaRequerimiento()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('r.estado','1');
		$this->db->where('m.estadoRequerimiento','1');
		$this->db->or_where('m.estadoRequerimiento','2');
		$this->db->or_where('m.estadoRequerimiento','3');
		$this->db->join('requerimientoinformacion r','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=r.idUnidadNegocio');
		$this->db->group_by('m.numeroInforme');
		return $this->db->get();
	}

	public function requerimientoCerrados()
	{
		$this->db->select('*');
		$this->db->from('memorandumplanificacion m');
		$this->db->where('r.estado','1');
		$this->db->where('m.estadoRequerimiento','4');
		$this->db->join('requerimientoinformacion r','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=r.idUnidadNegocio');
		$this->db->group_by('m.numeroInforme');
		return $this->db->get();
	}

	public function unidadRequerimiento($idmpa)
	{
		$this->db->select('*');
		$this->db->from('requerimientoinformacion r');
		$this->db->where('r.estado','1');
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=r.idUnidadNegocio');
		$this->db->group_by('u.lineaNegocio');
		return $this->db->get();
	}

	public function reporteRequerimiento($idunidadnegocio,$idmpa)
	{
		$this->db->select('*');
		$this->db->from('requerimientoinformacion r');
		$this->db->where('r.estado','1');
		$this->db->where('u.idUnidadNegocio',$idunidadnegocio);
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=r.idUnidadNegocio');
		return $this->db->get();
	}

	

	public function agregarRequerimiento($data)
	{
	   $this->db->trans_begin();    
		foreach ($data['data'] as  $value) {
			$this->db->insert('requerimientoinformacion', array(      
				'requerimientoInformacion' => $value->subProceso,      
				'idUnidadNegocio' => $value->gradoCriticidad,
				'idUsuario' => $this->session->userdata('idUsuario'),     
				'idMemorandumPlanificacion' => $value->proceso,      
				'estado' => 1   
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


	public function recuperarRequerimiento($idrequerimiento)
	{
		$this->db->select('*');
		$this->db->from('requerimientoinformacion r');
		$this->db->where('r.estado','1');
		$this->db->where('r.idRequerimientoInformacion',$idrequerimiento);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=r.idUnidadNegocio');
		return $this->db->get();
	}

	public function modificarrequerimiento($idrequerimiento,$data)
	{
		$this->db->where('idRequerimientoInformacion',$idrequerimiento); 
		$this->db->update('requerimientoinformacion',$data);
	}

	public function requerimientoeliminados($idunidadnegocio,$idmpa)
	{
		$this->db->select('*');
		$this->db->from('requerimientoinformacion r');
		$this->db->where('r.estado','0');
		$this->db->where('u.idUnidadNegocio',$idunidadnegocio);
		$this->db->where('m.idMemorandumPlanificacion',$idmpa);
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
		$this->db->join('plananualtrabajo pt','pt.idPlanAnualTrabajo=m.idPlanAnualTrabajo');
		$this->db->join('unidadnegocio u','u.idUnidadNegocio=r.idUnidadNegocio');
		return $this->db->get();
	}

}
