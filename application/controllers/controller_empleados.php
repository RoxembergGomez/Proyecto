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
		if($this->session->userdata('tipo')=='jefe')
		{
			$listacargo=$this->Cargo_Model->listacargos();
			$data['seleccion']=$listacargo;

			$data['msg']=$this->uri->segment(3);

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('create/add_empleado',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function agregarbdd()
	{
		if($this->session->userdata('tipo')=='jefe')
		{

			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombres','nombres','required|alpha',array('required'=>'(*) Se requiere llenar este campo','alpha'=>'(*) El campo no permite números'));
			$this->form_validation->set_rules('primerApellido','primerApellido','required|alpha',array('required'=>'(*) Se requiere llenar este campo','alpha'=>'(*) El campo no permite números'));
			$this->form_validation->set_rules('segundoApellido','segundoApellido','alpha',array('alpha'=>'(*) El campo no permite números'));
			$this->form_validation->set_rules('ci','ci','required',array('required'=>'(*) Se requiere llenar este campo'));
			$this->form_validation->set_rules('expedicion','expedicion','required',array('required'=>'(*) Selecione un apción'));
			$this->form_validation->set_rules('celular','celular','numeric',array('numeric'=>'(*) valores no permitidos, ingrese solo números'));
			$this->form_validation->set_rules('telefonoInterno','telefonoInterno','numeric',array('numeric'=>'(*) valores no permitidos, ingrese solo números'));
			$this->form_validation->set_rules('correoInstitucional','correoInstitucional','required|valid_email',array('required'=>'(*) Se requiere llenar este campo','valid_email'=>'(*) Este campo requiere los parámetros de un email'));
			$this->form_validation->set_rules('idCargo','idCargo','required',array('required'=>'(*) Seleccione una opción'));
			$this->form_validation->set_rules('usuario','usuario','required|min_length[4]|alpha_numeric',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 carateres','alpha_numeric'=>'(*) Se requiere solo letras o números'));
			$this->form_validation->set_rules('tipo','tipo','required',array('required'=>'(*) Selecione un apción'));
			$this->form_validation->set_rules('contrasena','contrasena','required|min_length[4]|max_length[8]',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 caracteres','max_length'=>'(*) Se requiere máximo 8 caracteres'));

		if ($this->form_validation->run()==FALSE) {

				$listacargo=$this->Cargo_Model->listacargos();
				$data['seleccion']=$listacargo;


				$data['msg']=$this->uri->segment(3);

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
							$data['nombres']=ucwords($_POST ['nombres'],'UTF-8');
							$data['primerApellido']=ucwords($_POST ['primerApellido'],'UTF-8');
							$data['segundoApellido']=ucwords($_POST ['segundoApellido'],'UTF-8');
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
			else
			{
				redirect('usuarios/panel','refresh');
			}
	}

	public function modificar()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idEmpleado']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$idEmpleado=$_POST ['idEmpleado'];
				$data['infoempleado']=$this->Empleados_Model->recuperarempleado($idEmpleado);
				
				$listacargo=$this->Cargo_Model->listacargos();
				$data['seleccion']=$listacargo;


				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_empleado',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
				redirect('usuarios/panel','refresh');
		}
	}

	public function modificarbd()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idEmpleado']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{	
				$this->load->library('form_validation');
				$this->form_validation->set_rules('nombres','nombres','required|alpha',array('required'=>'(*) Se requiere llenar este campo','alpha'=>'(*) El campo no permite números'));
				$this->form_validation->set_rules('primerApellido','primerApellido','required|alpha',array('required'=>'(*) Se requiere llenar este campo','alpha'=>'(*) El campo no permite números'));
				$this->form_validation->set_rules('segundoApellido','segundoApellido','alpha',array('alpha'=>'(*) El campo no permite números'));
				$this->form_validation->set_rules('ci','ci','required',array('required'=>'(*) Se requiere llenar este campo'));
				$this->form_validation->set_rules('celular','celular','numeric',array('numeric'=>'(*) valores no permitidos, ingrese solo números'));
				$this->form_validation->set_rules('telefonoInterno','telefonoInterno','numeric',array('numeric'=>'(*) valores no permitidos, ingrese solo números'));
				$this->form_validation->set_rules('correoInstitucional','correoInstitucional','required|valid_email',array('required'=>'(*) Se requiere llenar este campo','valid_email'=>'(*) Este campo requiere los parámetros de un email'));
				$this->form_validation->set_rules('idCargo','idCargo','required',array('required'=>'(*) Seleccione una opción'));

				if ($this->form_validation->run()==FALSE) {
					$idEmpleado=$_POST ['idEmpleado'];
					$data['infoempleado']=$this->Empleados_Model->recuperarempleado($idEmpleado);
					
					$listacargo=$this->Cargo_Model->listacargos();
					$data['seleccion']=$listacargo;


					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_empleado',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}
				else{
					$idEmpleado=$_POST ['idEmpleado'];

					$data['nombres']=ucwords($_POST ['nombres'],'UTF-8');
					$data['primerApellido']=ucwords($_POST ['primerApellido'],'UTF-8');
					$data['segundoApellido']=ucwords($_POST ['segundoApellido'],'UTF-8');
					$data['ci']=$_POST ['ci'];
					$data['expedicion']=$_POST ['expedicion'];
					$data['celular']=$_POST ['celular'];
					$data['telefonoInterno']=$_POST ['telefonoInterno'];
					$data['correoInstitucional']=strtolower($_POST ['correoInstitucional']);
					$data['idCargo']=$_POST ['idCargo'];
					$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
					$data['idUsuariocud']=$this->session->userdata('idUsuario');
					
					$this->Empleados_Model->modificarempleado($idEmpleado,$data);
					redirect('controller_empleados/index','refresh');
				}
			}
		}
		else
		{
				redirect('usuarios/panel','refresh');
		}
	}

	public function eliminarbd($idEmpleado)
	{
		if($this->session->userdata('tipo')=='jefe')
		{

			$data['estado']='0';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idusuariocud']=$this->session->userdata('idUsuario');

			$this->Empleados_Model->modificarempleado($idEmpleado,$data);

			redirect('controller_empleados/index','refresh');
		}
		else
		{
				redirect('usuarios/panel','refresh');
		}
	}

	public function eliminados()
	{
		if($this->session->userdata('tipo')=='jefe')
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
		else
		{
				redirect('usuarios/panel','refresh');
		}
	}

	public function recuperarbd()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idEmpleado']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$idEmpleado=$_POST ['idEmpleado'];
				$data['estado']='2';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idusuariocud']=$this->session->userdata('idUsuario');

				$this->Empleados_Model->modificarempleado($idEmpleado,$data);
				redirect('controller_empleados/eliminados','refresh');
			}
		}
		else
		{
				redirect('usuarios/panel','refresh');
		}
	}
}