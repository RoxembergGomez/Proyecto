<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo_Model extends CI_Model {

	//CREATE
	public function agregarcargo($data)
	{
		$this->db->insert('cargo',$data);
	}

	//READ
	public function listacargos()
	{
		$this->db->select('*');
		$this->db->from('cargo c');
		$this->db->where('c.estado','1');
		$this->db->join('unidadnegocio un','un.idUnidadNegocio=c.idUnidadNegocio');
		return $this->db->get();
	}

	//UPDATE

	public function recuperarcargo($idCargo)
	{
		$this->db->select('*');
		$this->db->from('cargo c');
		$this->db->where('c.idCargo',$idCargo);
		$this->db->join('unidadnegocio un','un.idUnidadNegocio=c.idUnidadNegocio');
		return $this->db->get();
	}

	public function modificarcargo($idCargo,$data)
	{
		$this->db->where('idCargo',$idCargo); 
		$this->db->update('cargo',$data);
	}

	//DELETE
	public function eliminarcargo($idCargo)
	{
		$this->db->where('idCargo',$idCargo); 
		$this->db->delete('cargo');
	}

	public function cargoseliminados()
	{
		$this->db->select('*');
		$this->db->from('cargo c');
		$this->db->where('c.estado','0');
		$this->db->join('unidadnegocio un','un.idUnidadNegocio=c.idUnidadNegocio');
		return $this->db->get();
	}
}
