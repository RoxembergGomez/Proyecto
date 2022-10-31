<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadNegocio_Model extends CI_Model {

	public function unidadnegocio()
	{
		$this->db->select('*');
		$this->db->from('unidadnegocio');
		$this->db->where('estado','1');
		return $this->db->get();
	}

	public function agregarunidadnegocio($data)
	{
		$this->db->insert('unidadnegocio',$data);
	}

	public function recuperarunidadnegocio($idUnidadNegocio)
	{
		$this->db->select('*');
		$this->db->from('unidadnegocio');
		$this->db->where('idUnidadNegocio',$idUnidadNegocio);
		return $this->db->get();
	}

	public function modificarunidadnegocio($idUnidadNegocio,$data)
	{
		$this->db->where('idUnidadNegocio',$idUnidadNegocio); 
		$this->db->update('unidadnegocio',$data);
	}

	public function eliminarunidadnegocio($idUnidadNegocio)
	{
		$this->db->where('idUnidadNegocio',$idUnidadNegocio); 
		$this->db->delete('unidadnegocio');
	}

	public function unidadnegocioeliminados()
	{
		$this->db->select('*');
		$this->db->from('unidadnegocio');
		$this->db->where('estado','0');
		return $this->db->get();
	}
}
