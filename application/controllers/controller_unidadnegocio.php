<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_unidadnegocio extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
			$data['unidadnegocio']=$listaunidadnegocio;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_unidadnegocio',$data);
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
			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('create/add_unidadnegocio');
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
			$this->form_validation->set_rules('unidadnegocio','unidadnegocio','required',array('required'=>'(*) Se requiere llenar este campo'));

			if ($this->form_validation->run()==FALSE) {
				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_unidadnegocio');
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			} 
			else {
				$data['lineaNegocio']=mb_strtoupper($_POST ['unidadnegocio'],'UTF-8');
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->UnidadNegocio_Model->agregarunidadnegocio($data);
				redirect('controller_unidadnegocio/index','refresh');
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
			$idUnidadNegocio=$_POST ['idUnidadNegocio'];
			$data['infounidadnegocio']=$this->UnidadNegocio_Model->recuperarunidadnegocio($idUnidadNegocio);

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('update/modificar_unidadnegocio',$data);
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
			$this->form_validation->set_rules('unidadnegocio','unidadnegocio','required',array('required'=>'(*) Se requiere llenar este campo'));

			if ($this->form_validation->run()==FALSE) {
				$idUnidadNegocio=$_POST ['idUnidadNegocio'];
				$data['infounidadnegocio']=$this->UnidadNegocio_Model->recuperarunidadnegocio($idUnidadNegocio);

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_unidadnegocio',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			} 
			else {
				$idUnidadNegocio=$_POST ['idUnidadNegocio'];
				$data['lineaNegocio']=mb_strtoupper($_POST ['unidadnegocio'],'UTF-8');
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->UnidadNegocio_Model->modificarunidadnegocio($idUnidadNegocio,$data);
				redirect('controller_unidadnegocio/index','refresh');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function eliminarbd($idUnidadNegocio)
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$data['estado']='0';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');

			$this->UnidadNegocio_Model->modificarunidadnegocio($idUnidadNegocio,$data);
			redirect('controller_unidadnegocio/index','refresh');
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
			$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocioeliminados();
			$data['unidadnegocio']=$listaunidadnegocio;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('delete/view_UnidadnegocioEliminados',$data);
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
			$idUnidadNegocio=$_POST ['idUnidadNegocio'];
			$data['estado']='1';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');

			$this->UnidadNegocio_Model->modificarunidadnegocio($idUnidadNegocio,$data);
			redirect('controller_unidadnegocio/eliminados','refresh');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}
}
