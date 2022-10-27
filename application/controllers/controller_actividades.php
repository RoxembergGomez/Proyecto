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

		$req=$this->RequerimientoInformacion_Model->reporteRequerimiento($_POST['idunidad'],$_POST['idmpa']);
		$req=$req->result(); //convertir a array bidemencional

		$this->pdf=new Pdf();
		$this->pdf->addPage('P','letter');
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Observaciones"); //título en el encabezado
		
		$this->pdf->SetLeftMargin(20); //margen izquierdo
		$this->pdf->SetRightMargin(20); //margen derecho
		$this->pdf->SetFillColor(210,210,210); //color de fondo
		$this->pdf->SetFont('Arial','B',11); //tipo de letra
		$actividad=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$actividad=$actividad->result();
		foreach ($actividad as $rowa) {
			$act=$rowa->informe;
		}
		$this->pdf->Cell(0,10,utf8_decode($act),0,1,'C',1);

		
		$this->pdf->Ln(5);
		$this->pdf->Cell(15,7,utf8_decode('Fecha:'),0,0,'L',0);
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(160,7,utf8_decode(date("d/m/Y")),0,1,'L',0);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(15,7,utf8_decode('Para:'),0,0,'L',0);
		$unidad=$this->UnidadNegocio_Model->recuperarunidadnegocio($_POST ['idunidad']);
		$unidad=$unidad->result();
		foreach ($unidad as $rowu) {
			$uni=$rowu->lineaNegocio;
		}
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(175,7,utf8_decode($uni),0,1,'L',0);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(15,7,utf8_decode('De:'),0,0,'L',0);
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(160,7,utf8_decode('UNIDAD DE AUDITORÍA INTERNA'),0,1,'L',0);
		//$this->pdf->Cell(0,10,'DETALLE DE OBSERVACIONES',0,0,'C',1);
		//ANCHO/ALTO/TEXTO/BORDE/ORDEN SIG CELDA/ALINEACIÓN PUEDE SER L IQUIERDA, C CENTRO, R DERECHA/FILL 0NO 1SI
		//ORDEN SIG CELDA 0 DERE, 1 SIG LINEA, 2 DEBAJO
		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('En cumplimiento del Plan Anual de Auditoría Interna se requiere la siguiente información:'),0,'J',0);

		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Ln(5);
		$this->pdf->Cell(0,5,utf8_decode('DETALLE DE REQUERIMIENTO DE INFORMACIÓN'),0,0,'C',false);

		$this->pdf->Ln(8); //margin para el espaciado
		$this->pdf->SetFont('Arial','B',10);

		$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
		$this->pdf->Cell(165,8,utf8_decode('Requerimiento'),1,1,'C',0);

		
		$num=1;
		foreach ($req as $row) {

			$descripcion=$row->requerimientoInformacion;
          
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->Cell(10,5,$num,1,0,'C',0);
          $this->pdf->Cell(165,5,utf8_decode($descripcion),1,0,'L',false);
                  
          $this->pdf->Ln();

          $num++;
		}

		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('Nota: la información puede ser entregada en físico o digital, lo que sea de su conveniencia.'),0,'J',0);
		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('De acuerdo con nuestro compromiso de confidencialidad en vigor, podemos asegurarles que el uso de la información requerida se limita a los objetivos del trabajo de auditoría.'),0,'J',0);

		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('Atentamente:'),0,'J',0);

		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->MultiCell(0,5,utf8_decode('SUBGERENCIA NACIONAL DE AUDITORÍA INTERNA:'),0,'J',0);

		$this->pdf->Output("DetalleRequerimiento.pdf","D");
		}
		else
		{
			redirect('controller_requerimientoinformacion/index','refresh');
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

		$req=$this->RequerimientoInformacion_Model->reporteRequerimiento($_POST['idunidad'],$_POST['idmpa']);
		$req=$req->result(); //convertir a array bidemencional

		$this->pdf=new Pdf();
		$this->pdf->addPage('P','letter');
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("EjecutadasPorEmpleado"); //título en el encabezado
		
		$this->pdf->SetLeftMargin(20); //margen izquierdo
		$this->pdf->SetRightMargin(20); //margen derecho
		$this->pdf->SetFillColor(210,210,210); //color de fondo
		$this->pdf->SetFont('Arial','B',11); //tipo de letra
		$actividad=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$actividad=$actividad->result();
		foreach ($actividad as $rowa) {
			$act=$rowa->informe;
		}
		$this->pdf->Cell(0,10,utf8_decode($act),0,1,'C',1);

		
		$this->pdf->Ln(5);
		$this->pdf->Cell(15,7,utf8_decode('Fecha:'),0,0,'L',0);
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(160,7,utf8_decode(date("d/m/Y")),0,1,'L',0);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(15,7,utf8_decode('Para:'),0,0,'L',0);
		$unidad=$this->UnidadNegocio_Model->recuperarunidadnegocio($_POST ['idunidad']);
		$unidad=$unidad->result();
		foreach ($unidad as $rowu) {
			$uni=$rowu->lineaNegocio;
		}
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(175,7,utf8_decode($uni),0,1,'L',0);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(15,7,utf8_decode('De:'),0,0,'L',0);
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(160,7,utf8_decode('UNIDAD DE AUDITORÍA INTERNA'),0,1,'L',0);
		//$this->pdf->Cell(0,10,'DETALLE DE OBSERVACIONES',0,0,'C',1);
		//ANCHO/ALTO/TEXTO/BORDE/ORDEN SIG CELDA/ALINEACIÓN PUEDE SER L IQUIERDA, C CENTRO, R DERECHA/FILL 0NO 1SI
		//ORDEN SIG CELDA 0 DERE, 1 SIG LINEA, 2 DEBAJO
		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('En cumplimiento del Plan Anual de Auditoría Interna se requiere la siguiente información:'),0,'J',0);

		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Ln(5);
		$this->pdf->Cell(0,5,utf8_decode('DETALLE DE REQUERIMIENTO DE INFORMACIÓN'),0,0,'C',false);

		$this->pdf->Ln(8); //margin para el espaciado
		$this->pdf->SetFont('Arial','B',10);

		$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
		$this->pdf->Cell(165,8,utf8_decode('Requerimiento'),1,1,'C',0);

		
		$num=1;
		foreach ($req as $row) {

			$descripcion=$row->requerimientoInformacion;
          
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->Cell(10,5,$num,1,0,'C',0);
          $this->pdf->Cell(165,5,utf8_decode($descripcion),1,0,'L',false);
                  
          $this->pdf->Ln();

          $num++;
		}

		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('Nota: la información puede ser entregada en físico o digital, lo que sea de su conveniencia.'),0,'J',0);
		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('De acuerdo con nuestro compromiso de confidencialidad en vigor, podemos asegurarles que el uso de la información requerida se limita a los objetivos del trabajo de auditoría.'),0,'J',0);

		$this->pdf->Ln(5);
		$this->pdf->MultiCell(0,5,utf8_decode('Atentamente:'),0,'J',0);

		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->MultiCell(0,5,utf8_decode('SUBGERENCIA NACIONAL DE AUDITORÍA INTERNA:'),0,'J',0);

		$this->pdf->Output("EjecutadasPorEmpleado.pdf","I");
		}
		else
		{
			redirect('controller_requerimientoinformacion/index','refresh');
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
