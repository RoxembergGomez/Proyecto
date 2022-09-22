<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_procesos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listaproceso=$this->Proceso_Model->listaprocesos();
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

	public function guest()
	{
		if($this->session->userdata('tipo')=='auditado')
		{
			$listaactividades=$this->Plan_Model->actividades();
			$data['plan_anual']=$listaactividades;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('panelprincipal',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/index','refresh');
		}
	}

	public function agregar()
	{

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('add_actividad');
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{	
		$data['informe']=$_POST ['informe'];
		$data['objetivo']=$_POST ['objetivo'];
		$data['normativa']=$_POST ['normativa'];
		$data['fechaInicio']=$_POST ['fechaInicio'];
		$data['fechaConclusion']=$_POST ['fechaConclusion'];
		$data['gradoPriorizacion']=$_POST ['gradoPriorizacion'];
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->PlanAnualTrabajo_Model->agregaractividad($data);

		redirect('controller_actividades/index','refresh');
	}

		
	public function modificar()
	{
		$idPlan=$_POST ['IdPlan'];
		$data['infoactividad']=$this->PlanAnualTrabajo_Model->recuperaractividad($idPlan);


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('modificar_actividad',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$idPlan=$_POST ['idPlan'];

		$data['informe']=$_POST ['informe'];
		$data['objetivo']=$_POST ['objetivo'];
		$data['normativa']=$_POST ['normativa'];
		$data['fechaInicio']=$_POST ['fechaInicio'];
		$data['fechaConclusion']=$_POST ['fechaConclusion'];
		$data['gradoPriorizacion']=$_POST ['gradoPriorizacion'];

		//formato en que se guarda los archivos
		$nombrearchivo=$idPlan.".pdf";
		//ruta donde se guardan los archivos
		$config['upload_path']='./uploads';
		//nombre del archivo
		$config['file_name']=$nombrearchivo;

		$direccion="./uploads/".$nombrearchivo;

		if (file_exists($direccion)) {
			unlink($direccion);
		}

		$config['allowed_types']='pdf'; //para agregar otro formato se separa con barra |tipo archivo
		$this->load->library('upload',$config);

		if (!$this->upload->do_upload()) {
			$data['error']=$this->upload->display_errors();
		}
		else{
			$data['docInforme']=$nombrearchivo;
		}


		$data['idUsuario']=$this->session->userdata('idUsuario');
		
		$this->PlanAnualTrabajo_Model->modificaractividad($idPlan,$data);
		$this->upload->data();
		redirect('controller_actividades/index','refresh');
	}

	public function eliminarbd()
	{
		$idPlan=$_POST ['idPlan'];
		$data['estado']='0';

		$this->PlanAnualTrabajo_Model->modificaractividad($idPlan,$data);

		redirect('controller_actividades/index','refresh');
	}

	public function eliminados()
	{
		$listaactividades=$this->PlanAnualTrabajo_Model->actividadeseliminadas();
		$data['plananualtrabajo']=$listaactividades;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('view_ActividadesEliminadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function recuperarbd()
	{
		$IdPlan=$_POST ['idPlan'];
		$data['estado']='1';

		$this->PlanAnualTrabajo_Model->modificaractividad($IdPlan,$data);
		redirect('controller_actividades/eliminados','refresh');

	}


}
