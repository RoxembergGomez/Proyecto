<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_empleados extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listaempleados=$this->Empleados_Model->empleados();
			$data['empleados']=$listaempleados;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_empleados',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function agregar()
	{
		$listacargo=$this->Empleados_Model->seleccion();
		$data['seleccion']=$listacargo;

		$data['msg']=$this->uri->segment(3);

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_empleado',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario','usuario','required|min_length[4]|alpha_numeric',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 carateres','alpha_numeric'=>'(*) Se requiere solo letras o números'));
		if ($this->form_validation->run()==FALSE) {
				$listacargo=$this->Empleados_Model->seleccion();
				$data['seleccion']=$listacargo;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_empleado',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}else{

					$usuario=strtolower($_POST ['usuario']);
					
					$validarusuario=$this->Usuario_Model->validarusuario($usuario);
					if($validarusuario->num_rows()>0)
					{
						redirect('controller_empleados/agregar/1','refresh');
					} else {
						$contrasena=MD5($_POST ['contrasena']);
						$validarcontrasena=$this->Usuario_Model->validarcontrasena($contrasena);
						if ($validarcontrasena->num_rows()>0){
							redirect('controller_empleados/agregar/2','refresh');
						} else{
							$data['nombres']=mb_strtoupper($_POST ['nombres'],'UTF-8');
							$data['primerApellido']=mb_strtoupper($_POST ['primerApellido'],'UTF-8');
							$data['segundoApellido']=mb_strtoupper($_POST ['segundoApellido'],'UTF-8');
							$data['ci']=$_POST ['ci'];
							$data['expedicion']=$_POST ['expedicion'];
							$data['celular']=$_POST ['celular'];
							$data['telefonoInterno']=$_POST ['telefonoInterno'];
							$data['correoInstitucional']=strtolower($_POST ['correoInstitucional']);
							$data['idCargo']=$_POST ['idCargo'];
							$data['usuario']=strtolower($_POST ['usuario']);
							$data['contrasena']=MD5($_POST ['contrasena']);
							$data['tipo']=strtolower($_POST ['tipo']);
							$data['estado']='2';
							$data['idusuariocud']=$this->session->userdata('idUsuario');

							$this->Empleados_Model->agregarempleado($data);
							redirect('controller_empleados/index','refresh');
						}
					}
				}
	}

	public function modificar()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['infoempleado']=$this->Empleados_Model->recuperarempleado($idEmpleado);
		
		$listacargo=$this->Empleados_Model->seleccion();
		$data['seleccion']=$listacargo;


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('update/modificar_empleado',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];

		$data['nombres']=mb_strtoupper($_POST ['nombres'],'UTF-8');
		$data['primerApellido']=mb_strtoupper($_POST ['primerApellido'],'UTF-8');
		$data['segundoApellido']=mb_strtoupper($_POST ['segundoApellido'],'UTF-8');
		$data['ci']=$_POST ['ci'];
		$data['expedicion']=$_POST ['expedicion'];
		$data['celular']=$_POST ['celular'];
		$data['telefonoInterno']=$_POST ['telefonoInterno'];
		$data['correoInstitucional']=strtolower($_POST ['correoInstitucional']);
		$data['idCargo']=$_POST ['idCargo'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');
		
		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/index','refresh');
	}

	public function eliminarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Empleados_Model->modificarempleado($idEmpleado,$data);

		redirect('controller_Empleados/index','refresh');
	}

	public function eliminados()
	{
		$listaempleados=$this->Empleados_Model->empleadoseliminados();
		$data['empleados']=$listaempleados;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('delete/view_EmpleadosEliminados',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function recuperarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['estado']='1';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/eliminados','refresh');

	}


}
