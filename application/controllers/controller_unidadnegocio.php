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
		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_unidadnegocio');
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{
		
		$data['lineaNegocio']=$_POST ['unidadnegocio'];
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->UnidadNegocio_Model->agregarunidadnegocio($data);
		redirect('controller_unidadnegocio/index','refresh');
		
	}

	public function modificar()
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

	public function modificarbd()
	{
		$idUnidadNegocio=$_POST ['idUnidadNegocio'];
		$data['lineaNegocio']=$_POST ['unidadnegocio'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->UnidadNegocio_Model->modificarunidadnegocio($idUnidadNegocio,$data);
		redirect('controller_unidadnegocio/index','refresh');
	}

	public function eliminarbd()
	{
		$idUnidadNegocio=$_POST ['idUnidadNegocio'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->UnidadNegocio_Model->modificarunidadnegocio($idUnidadNegocio,$data);
		redirect('controller_unidadnegocio/index','refresh');
	}

	public function eliminados()
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

	public function recuperarbd()
	{
		$idUnidadNegocio=$_POST ['idUnidadNegocio'];
		$data['estado']='1';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->UnidadNegocio_Model->modificarunidadnegocio($idUnidadNegocio,$data);
		redirect('controller_unidadnegocio/eliminados','refresh');

	}
}
