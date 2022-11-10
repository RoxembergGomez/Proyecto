<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_actividades extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listaactividades=$this->PlanAnualTrabajo_Model->actividades();
			$data['plananualtrabajo']=$listaactividades;

			$listampa=$this->MemorandumPlanificacion_Model->empleado();
			$data['seleccion']=$listampa;

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
		if($this->session->userdata('tipo')=='jefe')
		{
			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('create/add_actividad');
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
		if($this->session->userdata('tipo')=='jefe')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('informe','informe','required',array('required'=>'(*) Se requiere llenar este campo'));
			$this->form_validation->set_rules('objetivo','objetivo','required',array('required'=>'(*) Se requiere llenar este campo'));
			$this->form_validation->set_rules('normativa','normativa','required',array('required'=>'(*) Se requiere llenar este campo'));
			$this->form_validation->set_rules('fechaInicio','fechaInicio','required',array('required'=>'(*) Inserte una fecha'));
			$this->form_validation->set_rules('fechaConclusion','fechaConclusion','required',array('required'=>'(*) Inserte una fecha'));
			$this->form_validation->set_rules('gradoPriorizacion','gradoPriorizacion','required',array('required'=>'(*) Seleccione un grado de priorización'));

			if ($this->form_validation->run()==FALSE) {
				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_actividad');
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			} else{

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
			$idPlan=$_POST ['idPlan'];
			$data['infoactividad']=$this->PlanAnualTrabajo_Model->recuperaractividad($idPlan);

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('update/modificar_actividad',$data);
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
			$idPlan=$_POST ['idPlan'];

			$data['informe']=$_POST ['informe'];
			$data['objetivo']=$_POST ['objetivo'];
			$data['normativa']=$_POST ['normativa'];
			$data['fechaInicio']=$_POST ['fechaInicio'];
			$data['fechaConclusion']=$_POST ['fechaConclusion'];
			$data['gradoPriorizacion']=$_POST ['gradoPriorizacion'];
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');
			
			$this->PlanAnualTrabajo_Model->modificaractividad($idPlan,$data);
			redirect('controller_actividades/index','refresh');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function eliminarbd($idPlan)
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$data['estado']='0';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

			$this->PlanAnualTrabajo_Model->modificaractividad($idPlan,$data);
			redirect('controller_actividades/index','refresh');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function eliminados()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
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
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function recuperarbd()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$IdPlan=$_POST ['idPlan'];
			$data['estado']='1';
			$data['fechaActualizacion']=date("Y-m-d (H:i:s)");

			$this->PlanAnualTrabajo_Model->modificaractividad($IdPlan,$data);
			redirect('controller_actividades/eliminados','refresh');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}



	// ----------------------REPORTES -------------------------------

	public function pendientes()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
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
			$this->pdf->Ln(14);
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
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')

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
			$this->pdf->Ln(14);
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

	public function reporteporempleado()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('idEmpleado','idEmpleado','required',array('required'=>'(*) Seleccione un empleado'));
			$this->form_validation->set_rules('estadoEjecucion','estadoEjecucion','required',array('required'=>'(*) Seleccione un estado'));
			if ($this->form_validation->run()==FALSE) {

				$listaactividades=$this->PlanAnualTrabajo_Model->actividades();
				$data['plananualtrabajo']=$listaactividades;

				$listampa=$this->MemorandumPlanificacion_Model->empleado();
				$data['seleccion']=$listampa;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_actividades',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
				} 
			else{
				$empleado=$_POST['idEmpleado'];
				$estado=$_POST['estadoEjecucion'];

				if ($estado=='1') {

					$ejecutadasempleados=$this->PlanAnualTrabajo_Model->ejecutadasporestado($estado,$empleado);
					$data['ejecutadas']=$ejecutadasempleados;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('reportes/view_ejecutadasporempleado',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				} else
				if ($estado=='3') {
					$ejecutadasempleados=$this->PlanAnualTrabajo_Model->ejecutadasporestado($estado,$empleado);
					$data['ejecutadas']=$ejecutadasempleados;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('reportes/view_ejecutadasporempleado',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}
				else if ($estado=='4'){

					$ejecutadasempleados=$this->PlanAnualTrabajo_Model->generalporempleado($empleado);
					$data['ejecutadas']=$ejecutadasempleados;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('reportes/view_ejecutadasporempleado',$data);
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

	public function reporteporempleadopdf()
	{
		
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$empleado=$_POST['idEmpleado'];
			$estado=$_POST['estadoEjecucion'];


			if ($estado=='1') {
			$req=$this->PlanAnualTrabajo_Model->ejecutadasporestado($estado,$empleado);
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Ejecutadas Por Empleado");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Ln(14);
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

				$countnombre=strlen($nombre);
				$countinforme=strlen($informe);

				if ($countnombre<=21 && $countinforme<=61) {
		          $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,7,$num,1,0,'C',0);
		          $this->pdf->Cell(50,7,utf8_decode($nombre),1,0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode($nroinforme),1,0,'C',false);
		          $this->pdf->Cell(100,7,utf8_decode($informe),1,0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	          	} else
	          	if (($countnombre>=22 && $countnombre<=44) || ($countinforme>=62 && $countinforme<=124)) {

	          	  $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,7,$num,'TLR',0,'C',0);
		          $nombre1=substr($nombre,0,21);
		          $informe1=substr($informe,0,61);
		          $this->pdf->Cell(50,7,utf8_decode($nombre1),'TLR',0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode($nroinforme),'TLR',0,'C',false);
		          $this->pdf->Cell(100,7,utf8_decode($informe1),'TLR',0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),'TLR',0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),'TLR',1,'C',false);
		          $this->pdf->Cell(10,7,'','BLR',0,'C',0);
	         	  $nombre2=substr($nombre,21,$countnombre);
		          $this->pdf->Cell(50,7,utf8_decode($nombre2),'BLR',0,'L',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
	         	  $informe2=substr($informe,61,$countinforme);
		          $this->pdf->Cell(100,7,utf8_decode($informe2),'BLR',0,'L',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
	          	}
	                  
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Ejecutadas_por_Empleados.pdf","I");
			}


			if ($estado=='2') {

			$req=$this->PlanAnualTrabajo_Model->ejecutadasporestado($estado,$empleado);
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Ejecutadas Por Empleado");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Ln(14);
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

				$countnombre=strlen($nombre);
				$countinforme=strlen($informe);

				if ($countnombre<=21 && $countinforme<=61) {
		          $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,7,$num,1,0,'C',0);
		          $this->pdf->Cell(50,7,utf8_decode($nombre),1,0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode($nroinforme),1,0,'C',false);
		          $this->pdf->Cell(100,7,utf8_decode($informe),1,0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	          	} else
	          	if (($countnombre>=22 && $countnombre<=44) || ($countinforme>=62 && $countinforme<=124)) {

	          	  $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,7,$num,'TLR',0,'C',0);
		          $nombre1=substr($nombre,0,21);
		          $informe1=substr($informe,0,61);
		          $this->pdf->Cell(50,7,utf8_decode($nombre1),'TLR',0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode($nroinforme),'TLR',0,'C',false);
		          $this->pdf->Cell(100,7,utf8_decode($informe1),'TLR',0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),'TLR',0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),'TLR',1,'C',false);
		          $this->pdf->Cell(10,7,'','BLR',0,'C',0);
	         	  $nombre2=substr($nombre,21,$countnombre);
		          $this->pdf->Cell(50,7,utf8_decode($nombre2),'BLR',0,'L',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
	         	  $informe2=substr($informe,61,$countinforme);
		          $this->pdf->Cell(100,7,utf8_decode($informe2),'BLR',0,'L',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
	          	}
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Ejecutadas_por_Empleados.pdf","I");

			}

			if ($estado=='4') {

			$req=$this->PlanAnualTrabajo_Model->PlanAnualTrabajo_Model->generalporempleado($empleado);
			$req=$req->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Ejecutadas Por Empleado");
			
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Ln(14);
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

				$countnombre=strlen($nombre);
				$countinforme=strlen($informe);

				if ($countnombre<=21 && $countinforme<=61) {
		          $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,7,$num,1,0,'C',0);
		          $this->pdf->Cell(50,7,utf8_decode($nombre),1,0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode($nroinforme),1,0,'C',false);
		          $this->pdf->Cell(100,7,utf8_decode($informe),1,0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),1,0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),1,0,'C',false);
	          	} else
	          	if (($countnombre>=22 && $countnombre<=44) || ($countinforme>=62 && $countinforme<=124)) {

	          	  $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,7,$num,'TLR',0,'C',0);
		          $nombre1=substr($nombre,0,21);
		          $informe1=substr($informe,0,61);
		          $this->pdf->Cell(50,7,utf8_decode($nombre1),'TLR',0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode($nroinforme),'TLR',0,'C',false);
		          $this->pdf->Cell(100,7,utf8_decode($informe1),'TLR',0,'L',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($inicio)),'TLR',0,'C',false);
		          $this->pdf->Cell(30,7,utf8_decode(formatearFecha($conclusion)),'TLR',1,'C',false);
		          $this->pdf->Cell(10,7,'','BLR',0,'C',0);
	         	  $nombre2=substr($nombre,21,$countnombre);
		          $this->pdf->Cell(50,7,utf8_decode($nombre2),'BLR',0,'L',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
	         	  $informe2=substr($informe,61,$countinforme);
		          $this->pdf->Cell(100,7,utf8_decode($informe2),'BLR',0,'L',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
		          $this->pdf->Cell(30,7,'','BLR',0,'C',false);
	          	}
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("Detalle_de_Actividades_Ejecutadas_por_Empleados.pdf","I");
			}


		}
		else
		{
				redirect('controller_panelprincipal/index','refresh');
		}
	}

}
