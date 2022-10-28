<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_actividades extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listaactividades=$this->PlanAnualTrabajo_Model->actividades();
			$data['plananualtrabajo']=$listaactividades;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_actividades',$data);
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

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_actividad');
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
		$idPlan=$_POST ['idPlan'];
		$data['infoactividad']=$this->PlanAnualTrabajo_Model->recuperaractividad($idPlan);


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('update/modificar_actividad',$data);
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
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
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

	public function eliminarbd($idPlan)
	{
		
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

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
		$this->load->view('delete/view_ActividadesEliminadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function recuperarbd()
	{
		$IdPlan=$_POST ['idPlan'];
		$data['estado']='1';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

		$this->PlanAnualTrabajo_Model->modificaractividad($IdPlan,$data);
		redirect('controller_actividades/eliminados','refresh');

	}



	// ----------------------REPORTES -------------------------------

	public function pendientes()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$actividadespendientes=$this->PlanAnualTrabajo_Model->pendientes();
			$data['pendientes']=$actividadespendientes;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('reportes/view_actividadespendientes',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function pendientespdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{

			$req=$this->PlanAnualTrabajo_Model->pendientes();
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Actividades Pendientes");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(0,10,utf8_decode('DETALLE DE ACTIVIDADES PENDIENTES'),0,1,'C',1);
			$this->pdf->Ln(5);

			$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
			$this->pdf->Cell(149,8,utf8_decode('Informe'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Inicio'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Conclusión'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Priorización'),1,1,'C',0);

			
			$num=1;
			foreach ($req as $row) {

			
				$informe=$row->informe;
				$inicio=$row->fechaInicio;
				$conclusion=$row->fechaConclusion;
				$priorizacion=$row->gradoPriorizacion;
	          
	          $this->pdf->SetFont('Arial','',10);
	          $this->pdf->Cell(10,7,$num,1,0,'C',0);
	          $this->pdf->Cell(149,7,utf8_decode($informe),1,0,'L',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	          $this->pdf->Cell(30,7,utf8_decode($priorizacion),1,0,'C',false);
	                  
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Pendientes.pdf","I");
			}
			else
			{
				redirect('controller_panelprincipal/index','refresh');
			}

	}

	public function ejecutadas()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$ejecucion=$this->PlanAnualTrabajo_Model->ejecutadas();
			$data['ejecutadas']=$ejecucion;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('reportes/view_actividadesejecutadas',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function ejecutadaspdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{

			$req=$this->PlanAnualTrabajo_Model->ejecutadas();
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Actividades Ejecutadas");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(0,10,utf8_decode('DETALLE DE ACTIVIDADES EJECUTADAS'),0,1,'C',1);
			$this->pdf->Ln(5);

			$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Nro. Informe'),1,0,'C',0);
			$this->pdf->Cell(149,8,utf8_decode('Informe'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Inicio'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Conclusión'),1,1,'C',0);

			
			$num=1;
			foreach ($req as $row) {

				$nroinforme=$row->numeroInforme;
				$informe=$row->informe;
				$inicio=$row->fechaInicio;
				$conclusion=$row->fechaConclusion;
	          
	          $this->pdf->SetFont('Arial','',10);
	          $this->pdf->Cell(10,7,$num,1,0,'C',0);
	          $this->pdf->Cell(30,7,utf8_decode($nroinforme),1,0,'C',false);
	          $this->pdf->Cell(149,7,utf8_decode($informe),1,0,'L',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	                  
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Ejecutadas.pdf","I");
			}
			else
			{
				redirect('controller_panelprincipal/index','refresh');
			}
	}


	public function enprocesoporempleado()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$actividadespendientes=$this->PlanAnualTrabajo_Model->pendientes();
			$data['pendientes']=$actividadespendientes;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('reportes/view_actividadespendientes',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function ejecutadasporempleado()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$ejecutadasempleados=$this->PlanAnualTrabajo_Model->ejecutadas();
			$data['ejecutadas']=$ejecutadasempleados;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('reportes/view_ejecutadasporempleado',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function porempleadopdf()
	{
		
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{

			$req=$this->PlanAnualTrabajo_Model->ejecutadas();
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Ejecutadas Por Empleado");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(0,10,utf8_decode('DETALLE DE ACTIVIDADES EJECUTADAS POR EMPLEADO'),0,1,'C',1);
			$this->pdf->Ln(5);

			$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
			$this->pdf->Cell(50,8,utf8_decode('Nombres(s) y Apellido(s)'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Nro. Informe'),1,0,'C',0);
			$this->pdf->Cell(100,8,utf8_decode('Informe'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Inicio'),1,0,'C',0);
			$this->pdf->Cell(30,8,utf8_decode('Conclusión'),1,1,'C',0);

			
			$num=1;
			foreach ($req as $row) {

				$nombre=$row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;
				$nroinforme=$row->numeroInforme;
				$informe=$row->informe;
				$inicio=$row->fechaInicio;
				$conclusion=$row->fechaConclusion;
	          
	          $this->pdf->SetFont('Arial','',10);
	          $this->pdf->Cell(10,7,$num,1,0,'C',0);
	          $this->pdf->Cell(50,7,utf8_decode($nombre),1,0,'L',false);
	          $this->pdf->Cell(30,7,utf8_decode($nroinforme),1,0,'C',false);
	          $this->pdf->Cell(100,7,utf8_decode($informe),1,0,'L',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
	          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	                  
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Ejecutadas_por_Empleados.pdf","I");
			}
			else
			{
				redirect('controller_panelprincipal/index','refresh');
			}
	}




}
