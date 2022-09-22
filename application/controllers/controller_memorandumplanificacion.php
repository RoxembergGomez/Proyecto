<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_memorandumplanificacion extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			$listampa=$this->MemorandumPlanificacion_Model->mpa();
			$data['memorandumplanificacion']=$listampa;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_memorandumplanificacion',$data);
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
		/*$idc=$this->MemorandumPlanificacion_Model->selectcargo();
		$data['consul']=$idc;*/
         		
		//$idCargo='1';

		$idPlan=$_POST ['idPlan'];
		$data['infoid']=$this->MemorandumPlanificacion_Model->recuperaridPlan($idPlan);

		$listampa=$this->MemorandumPlanificacion_Model->seleccion();
		$data['seleccion']=$listampa;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_memorandumplanificacion',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{	

		$data['numeroInforme']=$_POST ['numeroInforme'];
		$data['idEmpleado']=$_POST ['idEmpleado'];
		$data['idPlanAnualTrabajo']=$_POST ['idPlan'];
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->MemorandumPlanificacion_Model->asignarmpa($data);
		redirect('controller_memorandumplanificacion/index','refresh');

		
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

		$data['nombres']=$_POST ['nombres'];
		$data['primerApellido']=$_POST ['primerApellido'];
		$data['segundoApellido']=$_POST ['segundoApellido'];
		$data['ci']=$_POST ['ci'];
		$data['expedicion']=$_POST ['expedicion'];
		$data['celular']=$_POST ['celular'];
		$data['telefonoInterno']=$_POST ['telefonoInterno'];
		$data['correoInstitucional']=$_POST ['correoInstitucional'];
		$data['idCargo']=$_POST ['idCargo'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/index','refresh');
	}

	public function eliminarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

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

		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/eliminados','refresh');

	}


}