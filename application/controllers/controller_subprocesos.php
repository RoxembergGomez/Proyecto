<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_subprocesos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			error_reporting(0);
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listasubproceso=$this->Subprocesos_Model->subprocesos($_POST ['idproceso']);
				$data['subproceso']=$listasubproceso;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_subprocesos',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function agregar()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			error_reporting(0);
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listaproceso=$this->Subprocesos_Model->subprocesoslist($_POST['idproceso']);
				$data['proceso']=$listaproceso;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_subprocesos',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}

public function agregarbdd()
	{	
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			error_reporting(0);
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('subproceso','subproceso','required',array('required'=>'(*) Se requiere llenar este campo'));
				$this->form_validation->set_rules('gradocriticidad','gradocriticidad','required',array('required'=>'(*) Seleccione una opción'));

				if ($this->form_validation->run()==FALSE) {

					$listaproceso=$this->Subprocesos_Model->subprocesoslist($_POST['idproceso']);
					$data['proceso']=$listaproceso;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('create/add_subprocesos',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}
				else{

					$data['descripcionSubProceso']=$_POST ['subproceso'];
					$data['clasificacionCriticidad']=$_POST ['gradocriticidad'];
					$data['idProceso']=$_POST ['idproceso'];
					$data['idUsuario']=$this->session->userdata('idUsuario');

					$this->Subprocesos_Model->agregarsubproceso($data);

					$listasubproceso=$this->Subprocesos_Model->subprocesos($_POST ['idproceso']);
					$data['subproceso']=$listasubproceso;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_subprocesos',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
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
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			error_reporting(0);
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{

				$data['infosubproceso']=$this->Subprocesos_Model->recuperarsubproceso($_POST ['idsubproceso']);

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_subproceso',$data);
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
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('subproceso','subproceso','required',array('required'=>'(*) Se requiere llenar este campo'));


				if ($this->form_validation->run()==FALSE) {

					$data['infosubproceso']=$this->Subprocesos_Model->recuperarsubproceso($_POST ['idsubproceso']);

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_subproceso',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}
				else{

						$data['descripcionSubProceso']=$_POST ['subproceso'];
						$data['clasificacionCriticidad']=$_POST ['gradocriticidad'];
						$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['idUsuario']=$this->session->userdata('idUsuario');
						$data['idProceso']=$_POST ['idproceso'];

						$this->Subprocesos_Model->modificasubproceso($_POST['idsubproceso'],$data);	

						$listasubproceso=$this->Subprocesos_Model->subprocesos($_POST ['idproceso']);
						$data['subproceso']=$listasubproceso;

						$this->load->view('recursos/headergentelella');
						$this->load->view('recursos/sidebargentelella');
						$this->load->view('recursos/topbargentelella');
						$this->load->view('read/view_subprocesos',$data);
						$this->load->view('recursos/creditosgentelella');
						$this->load->view('recursos/footergentelella');
					}
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}		
	}


	public function eliminarbd()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$data['estado']='0';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->Subprocesos_Model->modificasubproceso($_POST['idsubproceso'],$data);	


				$listasubproceso=$this->Subprocesos_Model->subprocesos($_POST ['idproceso']);
				$data['subproceso']=$listasubproceso;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_subprocesos',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
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
			error_reporting(0);
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listaproceso=$this->Subprocesos_Model->subprocesoeliminados($_POST['idproceso']);
				$data['subproceso']=$listaproceso;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_SubprocesosEliminados',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
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
			if ($_POST ['idproceso']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$data['estado']='1';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->Subprocesos_Model->modificasubproceso($_POST['idsubproceso'],$data);	

				$listaproceso=$this->Subprocesos_Model->subprocesoeliminados($_POST['idproceso']);
				$data['subproceso']=$listaproceso;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_SubprocesosEliminados',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}


}
