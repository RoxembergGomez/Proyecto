<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_actualizarusuario extends CI_Controller {

	public function index()
	{
		
			$this->load->view('recursos/headergentelella');
			$this->load->view('actualizarlogin');
			$this->load->view('recursos/footergentelella');
	}

	public function modificar()
	{
		$idPlan=$_POST ['IdPlan'];
		$data['infoactividad']=$this->Plan_Model->recuperaractividad($idPlan);


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('modificar_actividad',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$IdPlan=$_POST ['idPlan'];
		$data['informe']=$_POST ['informe'];
		$data['objetivos']=$_POST ['objetivos'];
		$data['fechaInicio']=$_POST ['fechaInicio'];
		$data['fechaConclusion']=$_POST ['fechaConclusion'];
		$data['gradoPriorizacion']=$_POST ['gradoPriorizacion'];

		//formato en que se guarda los archivos
		$nombrearchivo=$IdPlan.".pdf";
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
		
		$this->Plan_Model->modificaractividad($IdPlan,$data);
		$this->upload->data();
		redirect('Plan/index','refresh');
	}

	public function deshabilitarbd()
	{
		$idPlan=$_POST ['IdPlan'];
		$data['habilitado']='0';

		$this->Plan_Model->modificaractividad($idPlan,$data);

		redirect('Plan/index','refresh');
	}

	public function deshabilitados()
	{
		$listaactividades=$this->Plan_Model->actividadesdeshabilitadas();
		$data['plan_anual']=$listaactividades;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('listaactividadesdeshabilitadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function habilitarbd()
	{
		$IdPlan=$_POST ['idPlan'];
		$data['habilitado']='1';

		$this->Plan_Model->modificaractividad($IdPlan,$data);
		redirect('Plan/deshabilitados','refresh');

	}


}
