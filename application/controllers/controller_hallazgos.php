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
			error_reporting(0);
			if ($_POST ['idhallazgo']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$hallazgos=$this->Observaciones_Model->recuperarobservaciones($_POST ['idhallazgo']);
				$data['info']=$hallazgos;

				$listampa=$this->Observaciones_Model->empleados();
				$data['seleccion']=$listampa;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_hallazgo',$data);
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
	{	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idhallazgo']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('observacion','observacion','required',array('required'=>'(*) Se requiere llenar este campo'));
				if ($this->form_validation->run()==FALSE) {
					$hallazgos=$this->Observaciones_Model->recuperarobservaciones($_POST ['idhallazgo']);
					$data['info']=$hallazgos;

					$listampa=$this->Observaciones_Model->empleados();
					$data['seleccion']=$listampa;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_hallazgo',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				} else
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
	        	}
            }
		else
		{
			redirect('usuarios/panel','refresh');
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
if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{


			$hallazgos=$this->Observaciones_Model->enviadosdescargos();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgosenviadosuai',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
	}
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}

	public function observacionesenviadasdescargos()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{

			error_reporting(0);
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listaobservaciones=$this->Observaciones_Model->observacionesenviadasdescargos($_POST ['idmpa']);
				$data['observaciones']=$listaobservaciones;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_observacionesenviadasuai',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function revisiondescargo()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$hallazgos=$this->Observaciones_Model->revisiondescargos();
			$data['programatrabajo']=$hallazgos;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_hallazgosrevisiondescargos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
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
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{
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


	public function observacionesenviadas()
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{
			$listaobservaciones=$this->Observaciones_Model->observacionesenviadas($_POST ['idmpa']);
			$data['observaciones']=$listaobservaciones;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_observacionesenviadas',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
	}

	public function observacionesconcluidas()
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{
			$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
			$data['observaciones']=$listaobservaciones;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_observacionesConcluidas',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
	}


	public function observacionerevisiondescargos()
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{

			$listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
			$data['observaciones']=$listaobservaciones;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_observacionesrevisiondescargos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
	}



	public function eliminar()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idprograma']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listaactividades=$this->Programas_Model->recuperarprograma($_POST ['idprograma']);
				$data['actividades']=$listaactividades;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_eliminarobservacion',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
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
			if ($_POST ['idprograma']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{

				$this->load->library('form_validation');
				$this->form_validation->set_rules('verificacion','verificacion','required',array('required'=>'(*) Seleccione una opción'));

				if ($this->form_validation->run()==FALSE) {

				$listaactividades=$this->Programas_Model->recuperarprograma($_POST ['idprograma']);
				$data['actividades']=$listaactividades;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_eliminarobservacion',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');

				} else
				{
					$idprograma=$_POST ['idprograma'];

					$nombrearchivo=$idprograma.".pdf";	
					$config['upload_path']='./uploads/respaldoPrograma';
					$config['file_name']=$nombrearchivo;
					$direccion="./uploads/respaldoPrograma/".$nombrearchivo;
					if (file_exists($direccion)) {
						unlink($direccion);
					}

					$config['allowed_types']='pdf|xlsx|zip|rar|jpg|png';
					$this->load->library('upload',$config);
					
			        if (!$this->upload->do_upload()) {
			            $data['verificacionActividad']=$_POST ['verificacion'];
			            $data['respaldo'] = 'Sin Respaldo';
			            $data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['idUsuario']=$this->session->userdata('idUsuario');

						$this->Programas_Model->modificarprograma($idprograma,$data);

						$data2['estado']='0';
						$data2['idUsuario']=$this->session->userdata('idUsuario');
						$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$this->Observaciones_Model->modificarobservacion($_POST ['idhallazgo'],$data2);

				        $listaobservaciones=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
						$data['observaciones']=$listaobservaciones;

						$this->load->view('recursos/headergentelella');
						$this->load->view('recursos/sidebargentelella');
						$this->load->view('recursos/topbargentelella');
						$this->load->view('read/view_observaciones',$data);
						$this->load->view('recursos/creditosgentelella');
						$this->load->view('recursos/footergentelella');

			       	}
					else {
				        $data['verificacionActividad']=$_POST ['verificacion'];
				        $data['respaldo'] = $nombrearchivo;
				        $data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['idUsuario']=$this->session->userdata('idUsuario');

				        $this->Programas_Model->modificarprograma($idprograma,$data);
				        $this->upload->data();

				      	$data2['estado']='0';
						$data2['idUsuario']=$this->session->userdata('idUsuario');
						$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$this->Observaciones_Model->modificarobservacion($_POST ['idhallazgo'],$data2);

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
			}
		}
			
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}


	public function observacioneseliminadas()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idmpa']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listaobs=$this->Observaciones_Model->observacioneseliminadas($_POST ['idmpa']);
				$data['observaciones']=$listaobs;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_observacionesEliminadas',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		} 
			
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}

	// MÉTODO PARA LA VISTA PREVIA DE RECUPARCIÓN DE LA OBSERVACIÓN ELIMINADA

	public function recupararobs()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idprograma']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$listaactividades=$this->Programas_Model->recuperarprograma($_POST ['idprograma']);
				$data['actividades']=$listaactividades;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_recuperarobservacion',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}

		} 
			
		else
		{
			redirect('usuarios/panel','refresh');
		}

	}

	// MÉTODO PARA ACTUALIZAR LA OBSERVACIÓN ELIMINADA

	public function recupararobservacion()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			error_reporting(0);
			if ($_POST ['idprograma']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('verificacion','verificacion','required',array('required'=>'(*) Seleccione una opción'));

				if ($this->form_validation->run()==FALSE) {

				$listaactividades=$this->Programas_Model->recuperarprograma($_POST ['idprograma']);
				$data['actividades']=$listaactividades;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('delete/view_recuperarobservacion',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');

				} else
				{
					$idprograma=$_POST ['idprograma'];

					$nombrearchivo=$idprograma.".pdf";	
					$config['upload_path']='./uploads/respaldoPrograma';
					$config['file_name']=$nombrearchivo;
					$direccion="./uploads/respaldoPrograma/".$nombrearchivo;
					if (file_exists($direccion)) {
						unlink($direccion);
					}

					$config['allowed_types']='pdf|xlsx|zip|rar|jpg|png';
					$this->load->library('upload',$config);
					
			        if (!$this->upload->do_upload()) {
			            $data['verificacionActividad']=$_POST ['verificacion'];
			            $data['respaldo'] = 'Sin Respaldo';
			            $data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['idUsuario']=$this->session->userdata('idUsuario');

						$this->Programas_Model->modificarprograma($idprograma,$data);

						$data2['estado']='1';
						$data2['idUsuario']=$this->session->userdata('idUsuario');
						$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$this->Observaciones_Model->modificarobservacion($_POST ['idhallazgo'],$data2);

				        $listaobs=$this->Observaciones_Model->observacioneseliminadas($_POST ['idmpa']);
						$data['observaciones']=$listaobs;

						$this->load->view('recursos/headergentelella');
						$this->load->view('recursos/sidebargentelella');
						$this->load->view('recursos/topbargentelella');
						$this->load->view('delete/view_observacionesEliminadas',$data);
						$this->load->view('recursos/creditosgentelella');
						$this->load->view('recursos/footergentelella');

			       	}
					else {
				        $data['verificacionActividad']=$_POST ['verificacion'];
				        $data['respaldo'] = $nombrearchivo;
				        $data['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$data['idUsuario']=$this->session->userdata('idUsuario');

				        $this->Programas_Model->modificarprograma($idprograma,$data);
				        $this->upload->data();

				      	$data2['estado']='1';
						$data2['idUsuario']=$this->session->userdata('idUsuario');
						$data2['fechaActualizacion']=date("Y-m-d (H:i:s)");
						$this->Observaciones_Model->modificarobservacion($_POST ['idhallazgo'],$data2);

				       	$listaobs=$this->Observaciones_Model->observacioneseliminadas($_POST ['idmpa']);
						$data['observaciones']=$listaobs;

						$this->load->view('recursos/headergentelella');
						$this->load->view('recursos/sidebargentelella');
						$this->load->view('recursos/topbargentelella');
						$this->load->view('delete/view_observacionesEliminadas',$data);
						$this->load->view('recursos/creditosgentelella');
						$this->load->view('recursos/footergentelella');
					}
				}
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
			$obs=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
			$obs=$obs->result();

			$this->pdf=new Pdf();
			$this->pdf->addPage('L','letter');
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Observaciones");
			
			$this->pdf->SetLeftMargin(20);
			$this->pdf->SetRightMargin(20);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Ln(14);
			$actividad=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
			$actividad=$actividad->result();
			foreach ($actividad as $rowa) {
				$numeroInforme=$rowa->informe;
			}
			$this->pdf->Cell(0,10,utf8_decode($numeroInforme),0,0,'C',1);
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
	      		$plazo=formatearFecha($row->plazoAccionCorrectiva);
	          	$responsable=$row->responsable;

	          	$empleados=$this->Observaciones_Model->empleadoresponsable($responsable);
	            $empleado=$empleados->result();
	            foreach ($empleado as $rowa) {
	              $empleado= $rowa->nombres.' '.$rowa->primerApellido.' '.$rowa->segundoApellido;
	            }
	          $this->pdf->SetFont('Arial','',10);
	          $this->pdf->Cell(10,5,$num,'TBLR',0,'C',0);
	          $this->pdf->Cell(70,5,utf8_decode($descripcion),'TBLR',0,'L',false);
	          $this->pdf->Cell(30,5,utf8_decode($priorizacion),'TBLR',0,'C',false);
	          $this->pdf->Cell(60,5,utf8_decode($accionCorrectiva),'TBLR',0,'L',false);
	          $this->pdf->Cell(30,5,utf8_decode($plazo),'TBLR',0,'C',false);
	          $this->pdf->Cell(40,5,utf8_decode($empleado),'TBLR',0,'L',false);
	          $this->pdf->Ln();

	          $num++;
			}

			$this->pdf->Output("DetalleObservaciones.pdf","I");
			}
		}
		else
		{
			redirect('controller_hallazgos/index','refresh');
		}

	}


	//MODIFICAR ESTE MÉTODO PARA OBSERVACIONES PREVIAS FECHA 15/11/2022

	public function reportepdfprevio()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='auditado')
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{
				$obs=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
				$obs=$obs->result();

				$this->pdf=new Pdf();
				$this->pdf->addPage('L','letter');
				$this->pdf->AliasNbPages();
				$this->pdf->SetTitle("Observaciones");
				
				$this->pdf->SetLeftMargin(20);
				$this->pdf->SetRightMargin(20);
				$this->pdf->SetFillColor(210,210,210);
				$this->pdf->SetFont('Arial','B',11);
				$this->pdf->Ln(14);
				$actividad=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
				$actividad=$actividad->result();
				foreach ($actividad as $rowa) {
					$numeroInforme=$rowa->informe;
				}
				$this->pdf->Cell(0,10,utf8_decode($numeroInforme),0,0,'C',1);
				$this->pdf->Ln(15);
				$this->pdf->Cell(0,5,utf8_decode('DETALLE DE OBSERVACIONES DE AUDITORÍA INTERNA'),0,0,'C',false);

				$this->pdf->Ln(8); //margin para el espaciado
				$this->pdf->SetFont('Arial','B',10);

				$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
				$this->pdf->Cell(199,8,utf8_decode('Detalle Observación'),'LTBR',0,'C',0);
				$this->pdf->Cell(30,8,utf8_decode('Atención'),'LTBR',1,'C',0);
				
				$num=1;
				foreach ($obs as $row) {
					$descripcion=$row->descripcionHallazgo;
		      		$priorizacion=$row->prioridadAtencion;
		          $this->pdf->SetFont('Arial','',10);
		          $this->pdf->Cell(10,5,$num,'TBLR',0,'C',0);
		          $this->pdf->Cell(199,5,utf8_decode($descripcion),'TBLR',0,'L',false);
		          $this->pdf->Cell(30,5,utf8_decode($priorizacion),'TBLR',0,'C',false);
		                   
		          $this->pdf->Ln();

		          $num++;
				}

				$this->pdf->Output("DetalleObservaciones.pdf","I");
			}
		}
		else
		{
			redirect('controller_hallazgos/index','refresh');
		}

	}


	public function comentario()
	{
		if($this->session->userdata('tipo')=='auditado' )
		{
		error_reporting(0);
		if ($_POST ['idhallazgo']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else{
				$data['info']=$this->Observaciones_Model->vistaobservaciones($_POST ['idhallazgo']);

				$empleados=$this->Observaciones_Model->empleados();
				$data['empleado']=$empleados;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('update/modificar_observacion',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
			}
		}
		else
		{
			redirect('controller_hallazgos/index','refresh');
		}
	}


	public function insertarcomentario()
	{
		if($this->session->userdata('tipo')=='auditado' )
		{
			error_reporting(0);
			if ($_POST ['idhallazgo']=='') {
				redirect('controller_panelprincipal/index','refresh');
			} else
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('comentario','comentario','required',array('required'=>'(*) Se requiere llenar este campo'));
				$this->form_validation->set_rules('fecha','fecha','required',array('required'=>'(*) Se requiere llenar este campo'));
				$this->form_validation->set_rules('responsable','responsable','required',array('required'=>'(*) Se requiere llenar este campo'));

				if ($this->form_validation->run()==FALSE) {
					$data['info']=$this->Observaciones_Model->vistaobservaciones($_POST ['idhallazgo']);

					$empleados=$this->Observaciones_Model->empleados();
					$data['empleado']=$empleados;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('update/modificar_observacion',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}else
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
			}
		}
		else
		{
			redirect('controller_hallazgos/index','refresh');
		}

		
	}



	public function revision()
	{
		error_reporting(0);
		if ($_POST ['idmpa']=='') {
			redirect('controller_panelprincipal/index','refresh');
		} else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('proceso','proceso','required',array('required'=>'(*) Se requiere llenar este campo'));
			if ($this->form_validation->run()==FALSE) {
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
				} else{
					$hallazgos=$this->Observaciones_Model->enviados();
					$data['programatrabajo']=$hallazgos;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_hallazgosenviados',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
				}

			} else {
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

				redirect('controller_hallazgos/enrevision','refresh');
		        break;
		      case '4':
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

	}


}
