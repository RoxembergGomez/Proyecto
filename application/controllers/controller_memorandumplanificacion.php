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

//CONTROL DE ENVÍOS
	public function cerrarmpa()
	{
		
		$data['estadoProceso']='4';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		$data2['estadoEjecucion']='2';
		$data2['idUsuario']=$this->session->userdata('idUsuario');
		$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->PlanAnualTrabajo_Model->modificaractividad($_POST ['idpat'],$data2);

		redirect('controller_memorandumplanificacion/index','refresh');
	}


	public function enprocesopdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{

			$req=$this->MemorandumPlanificacion_Model->mpa();
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Actividades Asignadas con Responsable");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(0,10,utf8_decode('DETALLE DE ACTIVIDADES ASIGNADAS Y RESPONSABLES'),0,1,'C',1);
			$this->pdf->Ln(5);

			$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Nro. Informe'),1,0,'C',0);
			$this->pdf->Cell(100,8,utf8_decode('Informe'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Inicio'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Conclusión'),1,0,'C',0);
			$this->pdf->Cell(49,8,utf8_decode('Responsable'),1,1,'C',0);

			
			$num=1;
			foreach ($req as $row) {

			
				$nroinforme=$row->numeroInforme;
				$informe=$row->informe;
				$inicio=$row->fechaInicio;
				$conclusion=$row->fechaConclusion;
				$nombre=$row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;
	          
	          $this->pdf->SetFont('Arial','',10);
	          $this->pdf->Cell(10,7,$num,1,0,'C',0);
	          $this->pdf->Cell(30,7,utf8_decode($nroinforme),1,0,'C',false);
	          $this->pdf->Cell(100,7,utf8_decode($informe),1,0,'L',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	          $this->pdf->Cell(49,7,utf8_decode(formatearFecha($nombre)),1,0,'L',false);
	                  
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Asignadas.pdf","I");
			}
			else
			{
				redirect('controller_panelprincipal/index','refresh');
			}

	}


}