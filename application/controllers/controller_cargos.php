<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_cargos extends CI_Controller {

	public function index()
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
	}

	public function agregar()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
			$data['seleccion']=$listaunidadnegocio;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('create/add_cargo',$data);
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
			$this->form_validation->set_rules('cargo','cargo','required',array('required'=>'(*) Se requiere llenar este campo'));
			$this->form_validation->set_rules('idUnidadNegocio','idUnidadNegocio','required',array('required'=>'(*) Seleccione una unidad de negocio'));

			if ($this->form_validation->run()==FALSE) {
				$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
				$data['seleccion']=$listaunidadnegocio;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_cargo',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
			else {
				$data['denominacionCargo']=mb_strtoupper($_POST ['cargo'],'UTF-8');
				$data['idUsuario']=$this->session->userdata('idUsuario');
				$data['idUnidadNegocio']=mb_strtoupper($_POST ['idUnidadNegocio'],'UTF-8');
				$this->Cargo_Model->agregarcargo($data);
				redirect('controller_cargos/index','refresh');
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
			if ($_POST ['idCargo']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
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
			if ($_POST ['idCargo']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('cargo','cargo','required',array('required'=>'(*) Se requiere llenar este campo'));
				$this->form_validation->set_rules('idUnidadNegocio','idUnidadNegocio','required',array('required'=>'(*) Seleccione una unidad de negocio'));

				if ($this->form_validation->run()==FALSE) {
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
				else{
					$idCargo=$_POST ['idCargo'];
					$data['denominacionCargo']=$_POST ['cargo'];
					$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
					$data['idUsuario']=$this->session->userdata('idUsuario');
					$data['idUnidadNegocio']=$_POST ['idUnidadNegocio'];

					$this->Cargo_Model->modificarcargo($idCargo,$data);
					redirect('controller_cargos/index','refresh');	
					}
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
		
	}

	public function eliminarbd($idCargo)
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$data['estado']='0';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');

			$this->Cargo_Model->modificarcargo($idCargo,$data);
			redirect('controller_cargos/index','refresh');
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
			$listadecargo=$this->Cargo_Model->cargoseliminados();
			$data['cargo']=$listadecargo;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('delete/view_CargoEliminados',$data);
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
		{error_reporting(0);
			if ($_POST ['idCargo']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$idCargo=$_POST ['idCargo'];
				$data['estado']='1';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->Cargo_Model->modificarcargo($idCargo,$data);
				redirect('controller_cargos/eliminados','refresh');	
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}


}
