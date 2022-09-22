<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class actualizarusuario extends CI_Controller {

	public function vista()
	{
		$this->load->view('recursos/headergentelella');
		$this->load->view('actualizarlogin');
		$this->load->view('recursos/footergentelella');
	}

	public function vista2()
	{
		$data['msg']=$this->uri->segment(3);
		$this->load->view('recursos/headergentelella');
		$this->load->view('login',$data); //se aumenta el data del segmento
		$this->load->view('recursos/footergentelella');
	}

	public function index()
	{
		$data['msg']=$this->uri->segment(3); //se entiende que se recuperará el segmento 3 de del controlador
		if($this->session->userdata('usuario')) //si existe se va al panel y carga la lista del plan
		{  
			//el usuario ya esta logueado redireccionamos al panel
			redirect('actualizarusuario/panel','refresh');
		}
		else //en caso de que no esté abierto pasa para poner usuario
		{
			//el ususario no está logueado
			$this->load->view('recursos/headergentelella');
			$this->load->view('actualizarlogin');
			$this->load->view('recursos/footergentelella');
		}
	}

	public function validar()
	{	
		$usuario=$_POST['usuario'];
		$contrasena=MD5($_POST['contrasena']);


		$consulta=$this->Usuario_Model->validar($usuario,$contrasena);

		if($consulta->num_rows()>0)
		{
			//tenemos una validación efectiva
			foreach ($consulta->result() as $row) 
			{
				$this->session->set_userdata('idUsuario',$row->idUsuario);
				$this->session->set_userdata('usuario',$row->usuario);


				

			}

			$idUsuario=$this->session->set_userdata('idUsuario');
			$data['contrasena']=$_POST ['repitaContrasena'];
				$data['usuarioQueRegistra']=$this->session->userdata('idUsuario');
				$data['estado']='2';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

				$this->Usuario_Model->actualizarcontrasena($idUsuario,$data);

				redirect('actualizarusuario/vista2/2','refresh');
		}
		else
		{
			//No hay validación efectiva y redirigimos a login
			redirect('actualizarusuario/index/2','refresh');
		}	
	}

	/*public function panel()
	{
		if($this->session->userdata('usuario'))
		{
			$idUsuario=$this->session->set_userdata('idUsuario');

			$data['contrasena']=$_POST ['repitaContrasena'];
			$data['usuarioQueRegistra']=$this->session->userdata('idUsuario');
			$data['estado']='1';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

			$this->Usuario_Model->actualizarcontrasena($idUsuario,$data);

			
		}
		else
		{
			redirect('actualizarusuario/index','refresh');
			
		}
	}*/

}
