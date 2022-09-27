<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_usuarios extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listausuario=$this->Usuario_Model->usuarios();
			$data['usuario']=$listausuario;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_usuarios',$data);
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
		
		$listaempleado=$this->Usuario_Model->seleccion();
		$data['seleccion']=$listaempleado;

		$data['msg']=$this->uri->segment(3);

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_usuario',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{
		if($this->session->userdata('tipo')=='jefe'){

			$this->load->library('form_validation');

			$this->form_validation->set_rules('usuario','usuario','required|min_length[4]|alpha_numeric',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 carateres','alpha_numeric'=>'(*) Se requiere solo letras o números'));

			if ($this->form_validation->run()==FALSE) {

					$listaempleado=$this->Usuario_Model->seleccion();
					$data['seleccion']=$listaempleado;
					$data['msg']=$this->uri->segment(3);
					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('create/add_usuario',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				} else{

					$usuario=strtolower($_POST ['usuario']);
					
					$validarusuario=$this->Usuario_Model->validarusuario($usuario);
					if($validarusuario->num_rows()>0)
					{
						redirect('controller_usuarios/agregar/1','refresh');
					} else {
						$contrasena=MD5($_POST ['contrasena']);
						$validarcontrasena=$this->Usuario_Model->validarcontrasena($contrasena);
						if ($validarcontrasena->num_rows()>0){
							redirect('controller_usuarios/agregar/2','refresh');
						} else{
								$data['usuario']=strtolower($_POST ['usuario']);
								$data['contrasena']=MD5($_POST ['contrasena']);
								$data['tipo']=strtolower($_POST ['tipo']);
								$data['estado']='2';
								$data['usuarioQueRegistra']=$this->session->userdata('idUsuario');
								$data['idEmpleado']=$_POST ['idEmpleado'];
						
								$this->Usuario_Model->crearusuario($data);

								$idEmpleado=$_POST ['idEmpleado'];
								$base['estado']='2';
								$base['fechaActualizacion']=date("Y-m-d (H:i:s)");

								$this->Usuario_Model->modificaridempleado($idEmpleado,$base);

								redirect('controller_usuarios/index','refresh');
						}
					}
				}
		}
	}

	public function modificar()
	{
		$idUsuario=$_POST ['idUsuario'];
		$data['infousuario']=$this->Usuario_Model->recuperarusuario($idUsuario);


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('update/modificar_usuario',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$idUsuario=$_POST ['idUsuario'];
		$data['usuario']=strtolower($_POST ['usuario']);
		$data['contrasena']=MD5($_POST ['contrasena']);
		$data['tipo']=strtolower($_POST ['tipo']);
		$data['estado']='1';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->Usuario_Model->modificarusuario($idUsuario,$data);
		
		redirect('controller_usuarios/index','refresh');
	}

	public function eliminarbd()
	{
		$idUsuario=$_POST ['idUsuario'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['usuarioQueRegistra']=$this->session->userdata('idUsuario');

		$this->Usuario_Model->modificarusuario($idUsuario,$data);

		redirect('controller_usuarios/index','refresh');
	}

	public function eliminados()
	{
		$listausuario=$this->Usuario_Model->usuarioseliminados();
		$data['usuario']=$listausuario;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('delete/view_UsuariosEliminados',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
	}

	public function recuperarbd()
	{
		$idUsuario=$_POST ['idUsuario'];
		$data['estado']='2';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['usuarioQueRegistra']=$this->session->userdata('idUsuario');

		$this->Usuario_Model->modificarusuario($idUsuario,$data);
		redirect('controller_usuarios/eliminados','refresh');

	}


}
