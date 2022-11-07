<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_hallazgos extends CI_Controller {

	public function pendiente()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$hallazgos=$this->Observaciones_Model->pendientes();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function modificar()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{

			$hallazgos=$this->Observaciones_Model->recuperarobservaciones($_POST ['idhallazgo']);
			$data['info']=$hallazgos;

			$listampa=$this->Empleados_Model->empleados();
			$data['seleccion']=$listampa;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('update/modificar_hallazgo',$data);
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
		
		$idprograma=$_POST ['idhallazgo'];

		$anexo=$idprograma.".xlsx";
		$config2['upload_path']='./uploads/anexosObservacion';
		$config2['file_name']=$anexo;
		$direccion2="./uploads/anexosObservacion/".$anexo;
		if (file_exists($direccion2)) {
			unlink($direccion2);
			}
		$config2['allowed_types']='xlsx';
		$this->load->library('upload',$config2);
        
           	if (!$this->upload->do_upload()) {

	        	$data['descripcionHallazgo']=$_POST ['observacion'];
            	$data['prioridadAtencion'] = $_POST ['prioridad'];
            	$data['anexo'] = 'Sin Anexo';
            	$data['idUsuario']=$this->session->userdata('idUsuario');
            	$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
            	$data['idProgramaTrabajo'] = $_POST ['idprograma'];
            	$data['idEmpleado'] = $_POST ['idEmpleado'];


            	$this->Observaciones_Model->modificarobservacion($_POST['idhallazgo'],$data);

            	$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
				$data['observaciones']=$listaobservaciones;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_observaciones',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');

            	} else {

            	$data['descripcionHallazgo']=$_POST ['observacion'];
            	$data['prioridadAtencion'] = $_POST ['prioridad'];
            	$data['anexo'] = $anexo;
            	$data['idProgramaTrabajo'] = $_POST ['idprograma'];
            	$data['idEmpleado'] = $_POST ['idEmpleado'];
            	$data['idUsuario']=$this->session->userdata('idUsuario');

            	$this->Observaciones_Model->modificarobservacion($_POST['idhallazgo'],$data);
            	$this->upload->data();

            	$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
				$data['observaciones']=$listaobservaciones;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_observaciones',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');

            }
	}





	public function enrevision()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$hallazgos=$this->Observaciones_Model->revision();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgosrevision',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function enviado()
	{
		if($this->session->userdata('tipo')=='auditado' )
		{

			$hallazgos=$this->Observaciones_Model->enviados();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgosenviados',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

//PARA ENVÍOS A DESCARGOS UAI
	public function enviadosdescargosuai()
	{


			$hallazgos=$this->Observaciones_Model->enviadosdescargos();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgosenviados',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');

	}

	public function observacionesenviadasdescargos()
	{

		$listaobservaciones=$this->Observaciones_Model->observacionesenviadasdescargos($_POST ['idmpa']);
		$data['observaciones']=$listaobservaciones;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/view_observacionesenviadasuai',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}


	public function concluidos()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='auditado' )
		{
			$hallazgos=$this->Observaciones_Model->concluidos();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgosconcluidos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}



	public function observaciones()
	{

		$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$data['observaciones']=$listaobservaciones;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/view_observaciones',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}


	public function observacionesenviadas()
	{

		$listaobservaciones=$this->Observaciones_Model->observacionesenviadas($_POST ['idmpa']);
		$data['observaciones']=$listaobservaciones;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/view_observacionesenviadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function observacionesconcluidas()
	{

		$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$data['observaciones']=$listaobservaciones;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/view_observacionesConcluidas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}


	public function reportepdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
	{

		$obs=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$obs=$obs->result(); //convertir a array bidemencional

		$this->pdf=new Pdf();
		$this->pdf->addPage('L','letter');
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Observaciones"); //título en el encabezado
		
		$this->pdf->SetLeftMargin(20); //margen izquierdo
		$this->pdf->SetRightMargin(20); //margen derecho
		$this->pdf->SetFillColor(210,210,210); //color de fondo
		$this->pdf->SetFont('Arial','B',11); //tipo de letra
		$actividad=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$actividad=$actividad->result();
		foreach ($actividad as $rowa) {
			$numeroInforme=$rowa->informe;
		}
		$this->pdf->Cell(0,10,utf8_decode($numeroInforme),0,0,'C',1);
		//$this->pdf->Cell(0,10,'DETALLE DE OBSERVACIONES',0,0,'C',1);
		//ANCHO/ALTO/TEXTO/BORDE/ORDEN SIG CELDA/ALINEACIÓN PUEDE SER L IQUIERDA, C CENTRO, R DERECHA/FILL 0NO 1SI
		//ORDEN SIG CELDA 0 DERE, 1 SIG LINEA, 2 DEBAJO
		$this->pdf->Ln(15);
		$this->pdf->Cell(0,5,utf8_decode('DETALLE DE OBSERVACIONES DE AUDITORÍA INTERNA'),0,0,'C',false);

		$this->pdf->Ln(8); //margin para el espaciado
		$this->pdf->SetFont('Arial','B',10);

		$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
		$this->pdf->Cell(70,8,utf8_decode('Detalle Observación'),'LTBR',0,'C',0);
		$this->pdf->Cell(30,8,utf8_decode('Atención'),'LTBR',0,'C',0);
		$this->pdf->Cell(60,8,utf8_decode('Acción Correctiva'),'LTBR',0,'C',0);
		$this->pdf->Cell(30,8,utf8_decode('Plazo Propuesto'),'LTBR',0,'C',0);
		$this->pdf->Cell(40,8,utf8_decode('Responsable'),'TBLR',1,'C',0);

		

		
		$num=1;
		foreach ($obs as $row) {
			$descripcion=$row->descripcionHallazgo;
      		$priorizacion=$row->prioridadAtencion;
      		$accionCorrectiva=$row->comentarioResponsable;
      		$plazo=$row->plazoAccionCorrectiva;
          	$responsable=$row->responsable;

          
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->Cell(10,5,$num,'TBLR',0,'C',0);
          $this->pdf->Cell(70,5,utf8_decode($descripcion),'TBLR',0,'L',false);
          $this->pdf->Cell(30,5,utf8_decode($priorizacion),'TBLR',0,'C',false);
          $this->pdf->Cell(60,5,utf8_decode($accionCorrectiva),'TBLR',0,'L',false);
          $this->pdf->Cell(30,5,utf8_decode($plazo),'TBLR',0,'C',false);
          $this->pdf->Cell(40,5,utf8_decode($responsable),'TBLR',0,'L',false);
          
         
          $this->pdf->Ln();

          $num++;
		}

		$this->pdf->Output("DetalleObservaciones.pdf","I");
		}
		else
		{
			redirect('controller_hallazgos/index','refresh');
		}

	}


	public function comentario()
	{
		$data['info']=$this->Observaciones_Model->vistaobservaciones($_POST ['idhallazgo']);

		$empleados=$this->Empleados_Model->empleados();
		$data['empleado']=$empleados;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('update/modificar_observacion',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}



	public function insertarcomentario()
	{

		$data['comentarioResponsable']=$_POST ['comentario'];
		$data['plazoAccionCorrectiva']=$_POST ['fecha'];
		$data['responsable']=$_POST ['responsable'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');
		
		$this->Observaciones_Model->comentarios($_POST ['idhallazgo'],$data);

		$listaobservaciones=$this->Observaciones_Model->observacionesenviadas($_POST ['idmpa']);
		$data['observaciones']=$listaobservaciones;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/view_observacionesenviadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');

		
	}



	public function revision()
	{
		$estado= $_POST ['proceso'];
		switch ($estado) {
      case '1':
        $data['estadoProceso']='1';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_hallazgos/enrevision','refresh');
        break;

      case '2':
        $data['estadoProceso']='2';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_hallazgos/pendiente','refresh');
        break;
      case '3':
        $data['estadoProceso']='3';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_hallazgos/enviado','refresh');
        break;
      case '4':
        $data['estadoProceso']='4';
        $data['estadoPrograma']='4';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		$data2['estadoEjecucion']='3';
		$data2['idUsuario']=$this->session->userdata('idUsuario');
		$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->PlanAnualTrabajo_Model->modificaractividad($_POST ['idpat'],$data2);

		redirect('controller_hallazgos/enrevision','refresh');
       break;
       case '5':
        $data['estadoProceso']='5';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_hallazgos/enviado','refresh');
        break;
      
      default:
        break;
    }
		
	}


}
