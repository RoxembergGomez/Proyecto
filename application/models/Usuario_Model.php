<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

	public function validar($usuario,$contrasena,$estado)
	{
		$this->db->select('idEmpleado,usuario,tipo,estado');
		$this->db->from('empleado');
		$this->db->where('usuario',$usuario);
		$this->db->where('contrasena',$contrasena);
		$this->db->where('estado',$estado);
		return $this->db->get();
	}

	public function validaractualizacion($idUsuario,$contrasena)
	{
		$this->db->select('*');
		$this->db->from('empleado');
		$this->db->where('idEmpleado',$idUsuario);
		$this->db->where('contrasena',$contrasena);
		return $this->db->get();
	}

	public function actualizarcontrasena($idUsuario,$data)
	{
		$this->db->where('idEmpleado',$idUsuario); 
		$this->db->update('empleado',$data);
	}


	public function modificaridempleado($idEmpleado,$base)
	{
		$this->db->where('idEmpleado',$idEmpleado); 
		$this->db->update('empleado',$base);
	}

	//VALIDACIONES EN BASE DE DATOS DE USUARIO Y CONTRASEÑA

	public function validarusuario($usuario)
	{
		$this->db->select('usuario');
		$this->db->from('empleado');
		$this->db->where('usuario',$usuario);
		return $this->db->get();
	}

	public function validarcontrasena($contrasena)
	{
		$this->db->select('contrasena');
		$this->db->from('empleado');
		$this->db->where('contrasena',$contrasena);
		return $this->db->get();
	}

	////////////PARA EL CRUD DE USUSARIOS/////////////////////////

	public function usuarios()
	{
		$this->db->select('*');
		$this->db->from('empleado');
		$this->db->where('estado','1');
		$this->db->or_where('estado','2');
		return $this->db->get();
	}

	public function recuperarusuario($idUsuario)
	{
		$this->db->select('*');
		$this->db->from('empleado');
		$this->db->where('idEmpleado',$idUsuario);
		return $this->db->get();
	}

	public function modificarusuario($idUsuario,$data)
	{
		$this->db->where('idEmpleado',$idUsuario); 
		$this->db->update('empleado',$data);
	}
}
