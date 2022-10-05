<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_observacion extends CI_Controller {

	/*public function index()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listacargos=$this->Cargo_Model->listacargos();
			$data['cargo']=$listacargos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_cargos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}*/

	public function agregar()
	{
		//$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
		//$data['seleccion']=$listaunidadnegocio;

		
		$this->load->view('create/add_observacion');
		
	}

	public function agregarbdd()
	{
		$data['denominacionCargo']=mb_strtoupper($_POST ['cargo'],'UTF-8');
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['idUnidadNegocio']=mb_strtoupper($_POST ['idUnidadNegocio'],'UTF-8');

		$this->Cargo_Model->agregarcargo($data);
		redirect('controller_cargos/index','refresh');	
	}

	/*public function modificar()
	{
		$idCargo=$_POST ['idCargo'];
		$data['infocargo']=$this->Cargo_Model->recuperarcargo($idCargo);

		$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
		$data['seleccion']=$listaunidadnegocio;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('update/modificar_cargo',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$idCargo=$_POST ['idCargo'];
		$data['denominacionCargo']=$_POST ['cargo'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['idUnidadNegocio']=$_POST ['idUnidadNegocio'];

		$this->Cargo_Model->modificarcargo($idCargo,$data);
		redirect('controller_cargos/index','refresh');
	}

	public function eliminarbd()
	{
		$idCargo=$_POST ['idCargo'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Cargo_Model->modificarcargo($idCargo,$data);
		redirect('controller_cargos/index','refresh');
	}

	public function eliminados()
	{
		$listadecargo=$this->Cargo_Model->cargoseliminados();
		$data['cargo']=$listadecargo;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('delete/view_CargoEliminados',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function recuperarbd()
	{
		$idCargo=$_POST ['idCargo'];
		$data['estado']='1';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Cargo_Model->modificarcargo($idCargo,$data);
		redirect('controller_cargos/eliminados','refresh');

	}*/


}
