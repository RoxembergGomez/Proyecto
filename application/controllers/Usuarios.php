<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function index()
	{
		$data['msg']=$this->uri->segment(3); //se entiende que se recuperará el segmento 3 de del controlador
		if($this->session->userdata('usuario') AND $this->session->userdata('estado')=='1'){
			redirect('Usuarios/panel','refresh');
		
		} else {
			if ($this->session->userdata('usuario') AND $this->session->userdata('estado')=='2') {
				$this->load->view('recursos/headergentelellalogin');
				$this->load->view('actualizarlogin',$data); //se aumenta el data del segmento
				$this->load->view('recursos/footergentelellalogin');
			} else {
			$this->load->view('recursos/headergentelellalogin');
			$this->load->view('login',$data); //se aumenta el data del segmento
			$this->load->view('recursos/footergentelellalogin');
			} }
	}

	public function index2()
	{
		$data['msg']=$this->uri->segment(3); 
		if($this->session->userdata('usuario') AND $this->session->userdata('estado')=='1'){
			redirect('Usuarios/panel','refresh');
		
		} else {
			$this->load->view('recursos/headergentelellalogin');
			$this->load->view('login',$data); //se aumenta el data del segmento
			$this->load->view('recursos/footergentelellalogin');
	 }
	
	}

	public function actualizarcontrasena()
	{
		
		$this->load->library('form_validation');

		$idUsuario=$this->session->userdata('idUsuario');
		$contrasena=MD5($_POST['contrasena']);

		$consulta2=$this->Usuario_Model->validaractualizacion($idUsuario,$contrasena);
		
		if($consulta2->num_rows()>0)
		{
			
			$this->form_validation->set_rules('nuevacontrasena', 'nuevacontrasena', 'required|min_length[4]|max_length[8]',array('required'=>'(*) Se requiere llenar este campo','min_length'=>'(*) Se requiere al menos 4 caracteres','max_length'=>'(*) Se requiere máximo 8 caracteres'));
			$this->form_validation->set_rules('repitacontrasena','repitacontrasena','required|matches[nuevacontrasena]');

			if ($this->form_validation->run()==FALSE) { 
			redirect('Usuarios/index/2','refresh');
			}
			else
			{
				
				$data['contrasena']=MD5($_POST ['repitacontrasena']);
				$data['estado']='1';

				$this->Usuario_Model->actualizarcontrasena($idUsuario,$data);
				redirect('Usuarios/index2/4','refresh');		
				
			}
		}
		else 
		{
			redirect('Usuarios/index/1','refresh');
		} 
	}

	public function validar()
	{	
		$usuario=$_POST['usuario'];
		$contrasena=MD5($_POST['contrasena']);
		$estado='1';


		$consulta=$this->Usuario_Model->validar($usuario,$contrasena,$estado);

		if($consulta->num_rows()>0)
		{
			//tenemos una validación efectiva
			foreach ($consulta->result() as $row) 
			{
				$this->session->set_userdata('idUsuario',$row->idEmpleado);
				$this->session->set_userdata('usuario',$row->usuario);
				$this->session->set_userdata('tipo',$row->tipo);
				$this->session->set_userdata('estado',$row->estado);

				redirect('usuarios/panel','refresh');
			}
			
		}


		$usuario=$_POST['usuario'];
		$contrasena=MD5($_POST['contrasena']);
		$estado='2';
		$consulta=$this->Usuario_Model->validar($usuario,$contrasena,$estado);

		if($consulta->num_rows()>0)
		{
			//tenemos una validación efectiva
			foreach ($consulta->result() as $row) 
			{
				$this->session->set_userdata('idUsuario',$row->idEmpleado);
				$this->session->set_userdata('usuario',$row->usuario);
				$this->session->set_userdata('tipo',$row->tipo);
				$this->session->set_userdata('estado',$row->estado);

				redirect('usuarios/index','refresh');

			}
			
		} else {
			redirect('usuarios/index2/2','refresh');
		}	
	}

	public function panel()
	{
		if($this->session->userdata('usuario') AND $this->session->userdata('estado')=='1')
		{
			if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='auditado')
			{
				redirect('controller_panelprincipal/index','refresh'); //el usuario ya esta logueado
			}
		}  
		else {
			redirect('usuarios/index2/3','refresh');

		}


	}



	public function logout() //MÉTODO PARA CERRAR SESIÓN
	{
		$this->session->sess_destroy();
		redirect('usuarios/index/1','refresh'); //se añade un 1 como un código
		
	}
}
