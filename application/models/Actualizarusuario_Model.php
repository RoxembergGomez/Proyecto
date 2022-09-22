<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actualizarusuario_Model extends CI_Model {

	public function validar($usuario,$contrasena)
	{
		$this->db->select('idUsuario,usuario,tipo,idEmpleado'); //tal como está escrito en la base de datos
		$this->db->from('usuario'); //nombre de la tabla
		$this->db->where('usuario',$usuario); //sirve para condicionante AND porner en dos líneas el where
		$this->db->where('contrasena',$contrasena);
		return $this->db->get();
	}

	public function seleccion()
	{
		$this->db->select('idEmpleado,nombres,primerApellido,segundoApellido');
		$this->db->from('empleado');
		$this->db->where('estado','1');
		return $this->db->get();
	}

	public function modificaridempleado($idEmpleado,$data)
	{
		$this->db->where('idEmpleado',$idEmpleado); 
		$this->db->update('empleado',$data);
	}
	
	public function crearusuario($data)
	{
		$this->db->insert('usuario',$data);
	}

	public function usuarios()
	{
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('estado','1');
		return $this->db->get();
	}
}
