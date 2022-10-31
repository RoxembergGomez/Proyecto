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

	public function modificar()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$idUsuario=$_POST ['idUsuario'];
			$data['infousuario']=$this->Usuario_Model->recuperarusuario($idUsuario);

			$data['msg']=$this->uri->segment(3);

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('update/modificar_usuario',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
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
			$this->load->library('form_validation');
			$this->form_validation->set_rules('usuario','usuario','required|min_length[4]|alpha_numeric',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 carateres','alpha_numeric'=>'(*) Se requiere solo letras o números'));
			$this->form_validation->set_rules('tipo','tipo','required',array('required'=>'(*) Selecione un apción'));
			$this->form_validation->set_rules('contrasena','contrasena','required|min_length[4]|max_length[7]',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 caracteres','max_length'=>'(*) Se requiere máximo 5 caracteres'));

			if ($this->form_validation->run()==FALSE) {
				$idUsuario=$_POST ['idUsuario'];
				$data['infousuario']=$this->Usuario_Model->recuperarusuario($idUsuario);

				$data['msg']=$this->uri->segment(3);

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_usuario',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
			else{

					$contrasena=MD5($_POST ['contrasena']);
					$validarcontrasena=$this->Usuario_Model->validarcontrasena($contrasena);
					if ($validarcontrasena->num_rows()>0){
						$idUsuario=$_POST ['idUsuario'];
						$data['infousuario']=$this->Usuario_Model->recuperarusuario($idUsuario);

						$data['msg']=$this->uri->segment(3);

						$this->load->view('recursos/headergentelella');
						$this->load->view('recursos/sidebargentelella');
						$this->load->view('recursos/topbargentelella');
						$this->load->view('update/modificar_usuario',$data);
						$this->load->view('recursos/creditosgentelella');
						$this->load->view('recursos/footergentelella');
					}else{

						$idUsuario=$_POST ['idUsuario'];
						$data['usuario']=strtolower($_POST ['usuario']);
						$data['contrasena']=MD5($_POST ['contrasena']);
						$data['tipo']=strtolower($_POST ['tipo']);
						$data['estado']='2';
						$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['idUsuariocud']=$this->session->userdata('idUsuario');
						
						$this->Usuario_Model->modificarusuario($idUsuario,$data);
						
						redirect('controller_usuarios/index','refresh');
					}
				}
			}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

}
