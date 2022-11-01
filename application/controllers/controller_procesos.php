<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_procesos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listaproceso=$this->Proceso_Model->listaprocesos($_POST['idPlan']);
			$data['proceso']=$listaproceso;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_procesos',$data);
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
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listaun=$this->UnidadNegocio_Model->unidadnegocio();
			$data['unidadnegocio']=$listaun;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('create/add_proceso',$data);
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
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('idUnidadNegocio','idUnidadNegocio','required',array('required'=>'(*) Seleccione una opción'));
			$this->form_validation->set_rules('proceso','proceso','required',array('required'=>'(*) Se requiere llenar este campo'));

			if ($this->form_validation->run()==FALSE) {
				$listaun=$this->UnidadNegocio_Model->unidadnegocio();
				$data['unidadnegocio']=$listaun;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_proceso',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
			else{

				$data['descripcionProceso']=mb_strtoupper($_POST ['proceso'],'UTF-8');
				$data['idUnidadNegocio']=$_POST ['idUnidadNegocio'];
				$data['idPlanAnualTrabajo']=$_POST ['idPlan'];
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->Proceso_Model->agregarproceso($data);

				$listaproceso=$this->Proceso_Model->listaprocesos($_POST['idPlan']);
				$data['proceso']=$listaproceso;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_procesos',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');


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
			$data['infoproceso']=$this->Proceso_Model->recuperarproceso($_POST ['idproceso']);

			$listaun=$this->UnidadNegocio_Model->unidadnegocio();
			$data['unidadnegocio']=$listaun;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('update/modificar_proceso',$data);
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
			$this->form_validation->set_rules('proceso','proceso','required',array('required'=>'(*) Se requiere llenar este campo'));

			if ($this->form_validation->run()==FALSE) {
					$data['infoproceso']=$this->Proceso_Model->recuperarproceso($_POST ['idproceso']);

					$listaun=$this->UnidadNegocio_Model->unidadnegocio();
					$data['unidadnegocio']=$listaun;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_proceso',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
			}
			else{

					$data['descripcionProceso']=$_POST ['proceso'];
					$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
					$data['idUsuario']=$this->session->userdata('idUsuario');
					$data['idUnidadNegocio']=$_POST ['idUnidadNegocio'];

					$this->Proceso_Model->modificarproceso($_POST['idproceso'],$data);	

					$listaproceso=$this->Proceso_Model->listaprocesos($_POST['idPlan']);
					$data['proceso']=$listaproceso;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_procesos',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
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

			$data['estado']='0';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');

			$this->Proceso_Model->modificarproceso($_POST ['idproceso'],$data);

			$listaproceso=$this->Proceso_Model->listaprocesos($_POST['idPlan']);
			$data['proceso']=$listaproceso;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_procesos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');	
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
			$listaproceso=$this->Proceso_Model->procesoseliminados($_POST['idPlan']);
			$data['proceso']=$listaproceso;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('delete/view_procesosEliminados',$data);
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
		
			$data['estado']='1';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');

			$this->Proceso_Model->modificarproceso($_POST ['idproceso'],$data);

			$listaproceso=$this->Proceso_Model->procesoseliminados($_POST['idPlan']);
			$data['proceso']=$listaproceso;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('delete/view_procesosEliminados',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}


}
