<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_hallazgos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe')
		{
			$listaprogramas=$this->Programas_Model->programas();
			$data['programatrabajo']=$listaprogramas;

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
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->PlanAnualTrabajo_Model->agregaractividad($data);

		redirect('controller_actividades/index','refresh');
	}

		
	public function modificar()
	{
		$data['info']=$this->Observaciones_Model->vistaobservaciones($_POST ['idhallazgo']);

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

		$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$data['observaciones']=$listaobservaciones;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/view_observaciones',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');

		
	}

	public function eliminarbd()
	{
		$idPlan=$_POST ['idPlan'];
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


}
