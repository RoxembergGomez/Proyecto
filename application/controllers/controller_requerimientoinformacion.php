<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_actividades extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listaactividades=$this->Plan_Model->actividades();
			$data['plan_anual']=$listaactividades;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('view_actividades',$data);
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
		$listaactividades=$this->Plan_Model->actividades();
		$data['plan_anual']=$listaactividades;


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('add_actividad');
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{
		$this->load->library('form_validation'); //esto puede ser cargado en libreria en el autoload

		$this->form_validation->set_rules('informe','Informe a Presentar','required|min_length[5]|max_length[12]',array('required'=>'se requiere el informe a realizar','min_length'=>'al menos 5 carateres','max_length'=>'maximo 5 caracteres'));//tal como esta asignado en el formulario//Alias//campo requerido ()//Mensajes de error//dentro del array para personnalizar

		//para validación de los otros imput se puede repetir lo mismo pero y cambiar en vista para recuperar los datos erroneo, y personalizar los mensajes

		//VALIDADCIÓN DEL PASSWORD INCOMPLETO VERICAR CON FOTO
		$this->form_validation->set_rules('clave','passwor del estudiante','required|matches[clave2]',array('required'=>'se requiere el informe a realizar','min_length'=>'al menos 5 carateres','max_length'=>'maximo 5 caracteres'));
		//

		$this->form_validation->set_rules('edad','edad del estudiante','required|greater_than[17]',array('required'=>'se requiere el informe a realizar','min_length'=>'al menos 5 carateres','max_length'=>'maximo 5 caracteres'));

		if ($this->form_validation->run()==FALSE) {
		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('add_actividad');
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
		}
		else
		{

			//ES CORRECTO LA VALIDACIÓN
		$data['informe']=$_POST ['informe'];
		$data['objetivos']=$_POST ['objetivos'];
		$data['fechaInicio']=$_POST ['fechaInicio'];
		$data['fechaConclusion']=$_POST ['fechaConclusion'];
		$data['gradoPriorizacion']=$_POST ['gradoPriorizacion'];

		$this->Plan_Model->agregaractividad($data);

		redirect('Plan/index','refresh');
		}

		
	}

	public function eliminarbd()
	{
		$idPlan=$_POST ['IdPlan'];
		

		$this->Plan_Model->eliminaractividad($idPlan);

		redirect('Plan/index','refresh');
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
