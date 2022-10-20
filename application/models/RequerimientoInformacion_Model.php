<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequerimientoInformacion_Model extends CI_Model {

	public function vistaRequerimiento()
	{
		$this->db->select('*');
		$this->db->from('requerimientoinformacion r');
		$this->db->where('r.estado','1');
		$this->db->join('memorandumplanificacion m','m.idMemorandumPlanificacion=r.idMemorandumPlanificacion');
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
		//$this->db->group_by('u.lineaNegocio');
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

	public function modificarprograma($idprograma,$data)
	{
		$this->db->where('idProgramaTrabajo',$idprograma); 
		$this->db->update('programatrabajo',$data);
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
}