<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_programas extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listaprogramas=$this->Programas_Model->programas();
			$data['programatrabajo']=$listaprogramas;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_programatrabajo',$data);
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

		$idproceso=$_POST ['idPlanAnual'];
		$subprocesos=$this->Programas_Model->selectsubproceso($idproceso);
		$data['infoidplan']=$subprocesos;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_programatrabajo',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{
		$dataPost = json_decode(file_get_contents('php://input'));
		$data['data']=$dataPost->data;
		
		$response = $this->Programas_Model->agregarprograma($data);
		if($response){	
			
			echo json_encode(["status" => true]);
		}else{
			echo json_encode(["status" => false]);
		}
	}

	public function modificar()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['infoempleado']=$this->Empleados_Model->recuperarempleado($idEmpleado);
		
		$listacargo=$this->Empleados_Model->seleccion();
		$data['seleccion']=$listacargo;


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('update/modificar_empleado',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];

		$data['nombres']=mb_strtoupper($_POST ['nombres'],'UTF-8');
		$data['primerApellido']=mb_strtoupper($_POST ['primerApellido'],'UTF-8');
		$data['segundoApellido']=mb_strtoupper($_POST ['segundoApellido'],'UTF-8');
		$data['ci']=$_POST ['ci'];
		$data['expedicion']=$_POST ['expedicion'];
		$data['celular']=$_POST ['celular'];
		$data['telefonoInterno']=$_POST ['telefonoInterno'];
		$data['correoInstitucional']=strtolower($_POST ['correoInstitucional']);
		$data['idCargo']=$_POST ['idCargo'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');
		
		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/index','refresh');
	}

	public function eliminarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Empleados_Model->modificarempleado($idEmpleado,$data);

		redirect('controller_Empleados/index','refresh');
	}

	public function eliminados()
	{
		$listaempleados=$this->Empleados_Model->empleadoseliminados();
		$data['empleados']=$listaempleados;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('delete/view_EmpleadosEliminados',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function recuperarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['estado']='1';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/eliminados','refresh');

	}


}

