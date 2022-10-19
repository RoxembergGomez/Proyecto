<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observacion extends CI_Controller {

	public function index()
	{

		$obs=$this->Observacion_Model->observaciones();
		$data['observacion']=$obs;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('listaobservaciones',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregar()
	{
		$obs=$this->Observacion_Model->observaciones();
		$data['observacion']=$obs;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('add_observacion');
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{
		$data['titulo']=$_POST ['titulo'];
		$data['priorizacion']=$_POST ['priorizacion'];
		$data['condicion']=$_POST ['condicion'];
		$data['criterio']=$_POST ['criterio'];
		$data['causa']=$_POST ['causa'];
		$data['efecto']=$_POST ['efecto'];
		$data['recomendacion']=$_POST ['recomendacion'];

		$this->Observacion_Model->agregarobservacion($data);

		redirect('Observacion/index','refresh');
	}

	public function eliminarbd()
	{
		$idObservacion=$_POST ['idObservacion'];
		

		$this->Observacion_Model->eliminarobservacion($idObservacion);

		redirect('Observacion/index','refresh');
	}

	public function modificar()
	{
		$idObservacion=$_POST ['idObservacion'];
		$data['infoobservacion']=$this->Observacion_Model->recuperarobservacion($idObservacion);

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('modificar_observacion',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$idObservacion=$_POST ['idObservacion'];
		$data['titulo']=$_POST ['titulo'];
		$data['priorizacion']=$_POST ['priorizacion'];
		$data['condicion']=$_POST ['condicion'];
		$data['criterio']=$_POST ['criterio'];
		$data['causa']=$_POST ['causa'];
		$data['efecto']=$_POST ['efecto'];
		$data['recomendacion']=$_POST ['recomendacion'];

		$this->Observacion_Model->modificarobservacion($idObservacion,$data);
		redirect('Observacion/index','refresh');
	}

	public function deshabilitarbd()
	{
		$idObservacion=$_POST ['idObservacion'];
		$data['habilitado']='0';

		$this->Observacion_Model->modificarobservacion($idObservacion,$data);

		redirect('observacion/index','refresh');
	}

	public function deshabilitados()
	{
		$listobs=$this->Observacion_Model->observacionesdeshabilitadas();
		$data['observacion']=$listobs;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('listaobservacionesdeshabilitadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function habilitarbd()
	{
		$idObservacion=$_POST ['idObservacion'];
		$data['habilitado']='1';

		$this->Observacion_Model->modificarobservacion($idObservacion,$data);
		redirect('observacion/deshabilitados','refresh');

	}

	public function listapdf()
	{
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
		$obs=$this->Observacion_Model->observaciones();
		$obs=$obs->result(); //convertir a array bidemencional

		$this->pdf=new Pdf();
		$this->pdf->addPage('L','letter');
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Observaciones"); //título en el encabezado
		//$this->pdf->SetTopMargin(0);
		$this->pdf->SetLeftMargin(20); //margen izquierdo
		$this->pdf->SetRightMargin(20); //margen derecho
		$this->pdf->SetFillColor(210,210,210); //color de fondo
		$this->pdf->SetFont('Arial','B',11); //tipo de letra
		$this->pdf->Cell(30); //Configuración de celda
		$this->pdf->Cell(120,10,'OBSERVACIONES',0,0,'C',1);
		//ANCHO/ALTO/TEXTO/BORDE/ORDEN SIG CELDA/ALINEACIÓN PUEDE SER L IQUIERDA, C CENTRO, R DERECHA/FILL 0NO 1SI
		//ORDEN SIG CELDA 0 DERE, 1 SIG LINEA, 2 DEBAJO

		$this->pdf->Ln(15); //margin para el espaciado
		$this->pdf->SetFont('Arial','',10);
		
		$num=1;
		foreach ($obs as $row) {
			$titulo=$row->titulo;
      		$priorizacion=$row->priorizacion;
      		$condicion=$row->condicion;
      		$criterio=$row->criterio;
          	$causa=$row->causa;
          	$efecto=$row->efecto;
          	$recomendacion=$row->recomendacion;

          $this->pdf->MultiCell(0,5,utf8_decode($num.'.  '.$titulo.' '.'(Atención - '.$priorizacion.')'),0,'L',false);
          $this->pdf->Ln(2);
          $this->pdf->SetFont('Arial','B',10);
          $this->pdf->MultiCell(0,5,utf8_decode('Condición'),0,'L',false);
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->MultiCell(0,5,utf8_decode($condicion),0,'L',false);
          $this->pdf->SetFont('Arial','B',10);
          $this->pdf->Ln(2);
          $this->pdf->MultiCell(0,5,utf8_decode('Criterio'),0,'L',false);
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->MultiCell(0,5,utf8_decode($criterio),0,'L',false);
          $this->pdf->SetFont('Arial','B',10);
          $this->pdf->Ln(2);
          $this->pdf->MultiCell(0,5,utf8_decode('Causa'),0,'L',false);
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->MultiCell(0,5,utf8_decode($causa),0,'L',false);
          $this->pdf->SetFont('Arial','B',10);
          $this->pdf->Ln(2);
          $this->pdf->MultiCell(0,5,utf8_decode('Efecto'),0,'L',false);
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->MultiCell(0,5,utf8_decode($efecto),0,'L',false);
          $this->pdf->SetFont('Arial','B',10);
          $this->pdf->Ln(2);
          $this->pdf->MultiCell(0,5,utf8_decode('Recomendación'),0,'L',false);
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->MultiCell(0,5,utf8_decode($recomendacion),0,'L',false);
          $this->pdf->SetFont('Arial','B',10);
          $this->pdf->MultiCell(0,5,utf8_decode('Comentario y plan de acción del responsable de área'),0,'L',false);
          $this->pdf->Ln(3);
          $this->pdf->MultiCell(0,5,utf8_decode('Plazo propuesto y responsable del plan de acción'),0,'L',false);
         
          $this->pdf->Ln(10);
          $this->pdf->SetFont('Arial','',10);

          $num++;
		}
		$this->pdf->Output("listaobservaciones.pdf","I");
		}
		else
		{
			redirect('Observacion/index','refresh');
		}

	}


}
