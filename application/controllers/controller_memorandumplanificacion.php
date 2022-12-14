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
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idPlan']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{

				$listampa=$this->MemorandumPlanificacion_Model->empleado();
				$data['seleccion']=$listampa;

				$data['msg']=$this->uri->segment(1);

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_memorandumplanificacion',$data);
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
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idPlan']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('numeroInforme','numeroInforme','required',array('required'=>'(*) Se requiere llenar este campo'));
				$this->form_validation->set_rules('idEmpleado','idEmpleado','required',array('required'=>'(*) Seleccione un empleado'));
				if ($this->form_validation->run()==FALSE) {

					$listampa=$this->MemorandumPlanificacion_Model->empleado();
					$data['seleccion']=$listampa;

					$data['msg']=$this->uri->segment(1);

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('create/add_memorandumplanificacion',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				} 
				else{

					$numero=mb_strtoupper($_POST ['numeroInforme'],'UTF-8');
						
					$validar=$this->MemorandumPlanificacion_Model->validar($numero);
					if($validar->num_rows()>0 || $_POST ['numeroInforme']=='UAI-P000/2022' )
					{
							$listampa=$this->MemorandumPlanificacion_Model->empleado();
							$data['seleccion']=$listampa;

							$data['msg']=$this->uri->segment(3);

							$this->load->view('recursos/headergentelella');
							$this->load->view('recursos/sidebargentelella');
							$this->load->view('recursos/topbargentelella');
							$this->load->view('create/add_memorandumplanificacion',$data);
							$this->load->view('recursos/creditosgentelella');
							$this->load->view('recursos/footergentelella');
					} else {
						$data['numeroInforme']=mb_strtoupper($_POST ['numeroInforme'],'UTF-8');
						$data['idEmpleado']=$_POST ['idEmpleado'];
						$data['idPlanAnualTrabajo']=$_POST ['idPlan'];
						$data['idUsuario']=$this->session->userdata('idUsuario');

						$this->MemorandumPlanificacion_Model->asignarmpa($data);

						$data2['estadoEjecucion']='1';

						$this->PlanAnualTrabajo_Model->modificaractividad($_POST ['idPlan'],$data2);
						redirect('controller_memorandumplanificacion/index','refresh');
					}
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
		if($this->session->userdata('tipo')=='jefe')
		{
			error_reporting(0);
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$idmpa=$_POST ['idmpa'];
				$mpa=$this->MemorandumPlanificacion_Model->recuperarmpa($idmpa);
				$data['infompa']=$mpa;

				$empleado=$this->MemorandumPlanificacion_Model->empleado();
				$data['empleado']=$empleado;
				
				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_mpa',$data);
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
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('numeroInforme','numeroInforme','required',array('required'=>'(*) Se requiere llenar este campo'));

				if ($this->form_validation->run()==FALSE) {

					$idmpa=$_POST ['idmpa'];
					$mpa=$this->MemorandumPlanificacion_Model->recuperarmpa($idmpa);
					$data['infompa']=$mpa;

					$empleado=$this->MemorandumPlanificacion_Model->empleado();
					$data['empleado']=$empleado;
					
					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_mpa',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}
				else{
					$idmpa=$_POST ['idmpa'];
					$data['numeroInforme']=$_POST ['numeroInforme'];
					$data['idEmpleado']=$_POST ['idEmpleado'];
					$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
					$data['idUsuario']=$this->session->userdata('idUsuario');
					
					$this->MemorandumPlanificacion_Model->modificarmpa($idmpa,$data);
					redirect('controller_memorandumplanificacion/index','refresh');				
				}
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

//CONTROL DE ENV??OS
	public function cerrarmpa()
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
		} else{	
		
			$data['estadoProceso']='4';
			$data['estadoPrograma']='4';
			$data['estadoRequerimiento']='4';
			$data['idUsuario']=$this->session->userdata('idUsuario');
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			
			$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

			$data2['estadoEjecucion']='3';
			$data2['idUsuario']=$this->session->userdata('idUsuario');
			$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
			
			$this->PlanAnualTrabajo_Model->modificaractividad($_POST ['idpat'],$data2);

			redirect('controller_memorandumplanificacion/index','refresh');
		}
	}


	public function enprocesopdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' ){

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
			$this->pdf->Cell(30,8,utf8_decode('Conclusi??n'),1,0,'C',0);
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