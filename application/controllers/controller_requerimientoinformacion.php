<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_requerimientoinformacion extends CI_Controller {

	public function agregar()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$unidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
				$data['lista']=$unidadnegocio;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('create/add_requerimientoinformacion',$data);
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
		
		$dataPost = json_decode(file_get_contents('php://input'));
		$data['data']=$dataPost->data;
		$response = $this->RequerimientoInformacion_Model->agregarRequerimiento($data);
		if($response){	
			echo json_encode(["status" => true]);
		}else{
			echo json_encode(["status" => false]);
		}
		
	}


	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			$req=$this->RequerimientoInformacion_Model->vistaRequerimiento();
			$data['requerimiento']=$req;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_requerimientoinformacion',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function cerrados()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			$req=$this->RequerimientoInformacion_Model->requerimientoCerrados();
			$data['requerimiento']=$req;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_requerimientoinformacioncerrados',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function unidadRequerimiento()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$reque=$this->RequerimientoInformacion_Model->unidadRequerimiento($_POST['idmpa']);
				$data['detallereq']=$reque;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_detallerequerimiento',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function detallerequerimiento()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$reque=$this->RequerimientoInformacion_Model->reporteRequerimiento($_POST['idunidad'],$_POST['idmpa']);
				$data['reportereq']=$reque;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_reporterequerimiento',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function reportepdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{

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
			$this->pdf->Ln(14);
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

			$this->pdf->Output("DetalleRequerimiento.pdf","I");
			}
		}
		else
		{
			redirect('controller_requerimientoinformacion/index','refresh');
		}

	}

	

	public function modificar()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST['idrequerimiento']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{

				$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
				$data['unidadnegocio']=$listaunidadnegocio;

				$data['info']=$this->RequerimientoInformacion_Model->recuperarRequerimiento($_POST['idrequerimiento']);

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_requerimiento',$data);
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
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST['idrequerimiento']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('suproceso','suproceso','required',array('required'=>'(*) Se requiere llenar este campo'));

				if ($this->form_validation->run()==FALSE) {
					$listaunidadnegocio=$this->UnidadNegocio_Model->unidadnegocio();
					$data['unidadnegocio']=$listaunidadnegocio;

					$data['info']=$this->RequerimientoInformacion_Model->recuperarRequerimiento($_POST['idrequerimiento']);

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_requerimiento',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}
				else{
					$data['requerimientoInformacion']=$_POST ['suproceso'];
					$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
					$data['idUsuario']=$this->session->userdata('idUsuario');
					$data['idUnidadNegocio']=$_POST ['gradocriticidad'];

					$this->RequerimientoInformacion_Model->modificarrequerimiento($_POST['idrequerimiento'],$data);

					$reque=$this->RequerimientoInformacion_Model->reporteRequerimiento($_POST['idunidad'],$_POST['idmpa']);
					$data['reportereq']=$reque;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_reporterequerimiento',$data);
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

	public function eliminarbd()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST['idrequerimiento']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
		
				$data['estado']='0';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->RequerimientoInformacion_Model->modificarrequerimiento($_POST['idrequerimiento'],$data);

				$reque=$this->RequerimientoInformacion_Model->reporteRequerimiento($_POST['idunidad'],$_POST['idmpa']);
				$data['reportereq']=$reque;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_reporterequerimiento',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function eliminados()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$reque=$this->RequerimientoInformacion_Model->requerimientoeliminados($_POST['idunidad'],$_POST['idmpa']);
				$data['reportereq']=$reque;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_reporterequerimientoEliminados',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function recuperarbd()
	{

		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST['idrequerimiento']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$data['estado']='1';
				$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
				$data['idUsuario']=$this->session->userdata('idUsuario');

				$this->RequerimientoInformacion_Model->modificarrequerimiento($_POST['idrequerimiento'],$data);

				$reque=$this->RequerimientoInformacion_Model->requerimientoeliminados($_POST['idunidad'],$_POST['idmpa']);
				$data['reportereq']=$reque;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_reporterequerimientoEliminados',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}else
		{
			redirect('usuarios/panel','refresh');
		}

	}


	public function revision()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{

				$this->load->library('form_validation');
				$this->form_validation->set_rules('proceso','proceso1','required',array('required'=>'(*) Seleccione..'));

				if ($this->form_validation->run()==FALSE) { 

					$req=$this->RequerimientoInformacion_Model->vistaRequerimiento();
					$data['requerimiento']=$req;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_requerimientoinformacion',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');

				} else {


						$estado= $_POST ['proceso'];
						switch ($estado) {
				      case '1':
				        $data['estadoRequerimiento']='1';
						$data['idUsuario']=$this->session->userdata('idUsuario');
						$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						
						$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);
						redirect('controller_requerimientoinformacion/index','refresh');
				        break;

				      case '2':
				        $data['estadoRequerimiento']='2';
						$data['idUsuario']=$this->session->userdata('idUsuario');
						$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						
						$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

						redirect('controller_requerimientoinformacion/index','refresh');
				        break;
				      case '3':
				        $data['estadoRequerimiento']='3';
						$data['idUsuario']=$this->session->userdata('idUsuario');
						$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						
						$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

						redirect('controller_requerimientoinformacion/index','refresh');
				       break;
				      
				      default:
				        break;
		   	 		}
		   	 	}
				
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

}
