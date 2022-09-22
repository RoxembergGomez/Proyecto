<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

	public function validar($usuario,$contrasena,$estado)
	{
		$this->db->select('idUsuario,usuario,tipo,idEmpleado,estado');
		$this->db->from('usuario');
		$this->db->where('usuario',$usuario);
		$this->db->where('contrasena',$contrasena);
		$this->db->where('estado',$estado);
		return $this->db->get();
	}

	public function seleccion()
	{
		$this->db->select('idEmpleado,nombres,primerApellido,segundoApellido');
		$this->db->from('empleado');
		$this->db->where('estado','1');
		return $this->db->get();
	}

	public function validaractualizacion($idUsuario,$contrasena)
	{
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('idUsuario',$idUsuario);
		$this->db->where('contrasena',$contrasena);
		return $this->db->get();
	}

	public function actualizarcontrasena($idUsuario,$data)
	{
		$this->db->where('idUsuario',$idUsuario); 
		$this->db->update('usuario',$data);
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
		$this->db->from('usuario');
		$this->db->where('usuario',$usuario);
		return $this->db->get();
	}

	public function validarcontrasena($contrasena)
	{
		$this->db->select('contrasena');
		$this->db->from('usuario');
		$this->db->where('contrasena',$contrasena);
		return $this->db->get();
	}

	////////////PARA EL CRUD DE USUSARIOS/////////////////////////
	
	public function crearusuario($data)
	{
		$this->db->insert('usuario',$data);
	}

	public function usuarios()
	{
		$this->db->select('u.idUsuario,u.usuario,u.tipo,
			e.nombres,e.primerApellido,e.segundoApellido');
		$this->db->from('usuario u');
		$this->db->where('u.estado','1');
		$this->db->or_where('u.estado','2');
		$this->db->join('empleado e','u.idEmpleado=e.idEmpleado');
		return $this->db->get();
	}

	public function recuperarusuario($idUsuario)
	{
		$this->db->select('u.idUsuario,u.usuario,u.tipo,
			e.nombres,e.primerApellido,e.segundoApellido');
		$this->db->from('usuario u');
		$this->db->where('u.idUsuario',$idUsuario);
		$this->db->join('empleado e','u.idEmpleado=e.idEmpleado');
		return $this->db->get();
	}

	public function modificarusuario($idUsuario,$data)
	{
		$this->db->where('idUsuario',$idUsuario); 
		$this->db->update('usuario',$data);
	}


	public function usuarioseliminados()
	{
		$this->db->select('u.idUsuario,u.usuario,u.tipo,
			e.nombres,e.primerApellido,e.segundoApellido');
		$this->db->from('usuario u');
		$this->db->where('u.estado','0');
		$this->db->join('empleado e','u.idEmpleado=e.idEmpleado');
		return $this->db->get();
	}
}
