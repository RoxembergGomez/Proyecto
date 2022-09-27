<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados_Model extends CI_Model {

	public function empleados()
	{
		$this->db->select('e.idEmpleado,e.ci,e.expedicion,e.nombres,e.primerApellido,e.segundoApellido,
			c.denominacionCargo,e.celular,e.telefonoInterno,e.correoInstitucional');
		$this->db->from('empleado e');
		$this->db->where('e.estado','1');
		$this->db->or_where('e.estado','2');
		$this->db->join('cargo c','e.idCargo=c.idCargo');
		return $this->db->get();
	}


	public function seleccion()
	{
		$this->db->select('idCargo,denominacionCargo');
		$this->db->from('cargo');
		$this->db->where('estado','1');
		return $this->db->get();
	}

	public function agregarempleado($data)
	{
		$this->db->insert('empleado',$data);
	}

	public function recuperarempleado($idEmpleado)
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
	}



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
}
