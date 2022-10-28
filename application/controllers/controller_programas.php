<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_programas extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{
			$listaprogramas=$this->Programas_Model->programas();
			$data['programatrabajo']=$listaprogramas;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_programatrabajo',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

	public function actividades()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor')
		{

			$listaactividades=$this->Programas_Model->actividades($_POST ['idmpa']);
			$data['actividades']=$listaactividades;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_ejecucionactividades',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function ejecutar()
	{
		$idPrograma=$_POST ['idprograma'];
		$data['info']=$this->Programas_Model->vistaejecucion($idPrograma);

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_ejecutar',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function ejecutaractividad()
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

	        if(isset($_POST['ejecutar'])){
	        	if ($_POST ['verificacion']=='2' || $_POST ['verificacion']=='3') {

	        		$idPrograma=$_POST ['idprograma'];
					$data['info']=$this->Programas_Model->vistaejecucion($idPrograma);

					$listampa=$this->MemorandumPlanificacion_Model->seleccion();
					$data['seleccion']=$listampa;

	        		$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('create/add_observacion',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
           		} 
           		else {
            		$listaactividades=$this->Programas_Model->actividades($_POST ['idmpa']);
					$data['actividades']=$listaactividades;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_ejecucionactividades',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
            	} 
        	}
       	}
		else {
	        $data['verificacionActividad']=$_POST ['verificacion'];
	        $data['respaldo'] = $nombrearchivo;
	        $data['fechaActualizacion']=date("Y-m-d (H:i:s)");
			$data['idUsuario']=$this->session->userdata('idUsuario');

	        $this->Programas_Model->modificarprograma($idprograma,$data);
	        $this->upload->data();

	       	if(isset($_POST['ejecutar'])){
	        	if ($_POST ['verificacion']=='2' || $_POST ['verificacion']=='3') {

	        		$idPrograma=$_POST ['idprograma'];
					$data['info']=$this->Programas_Model->vistaejecucion($idPrograma);

					$listampa=$this->MemorandumPlanificacion_Model->seleccion();
					$data['seleccion']=$listampa;

	        		$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('create/add_observacion',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
            	} else {
            		$listaactividades=$this->Programas_Model->actividades($_POST ['idmpa']);
					$data['actividades']=$listaactividades;

					$this->load->view('recursos/headergentelella');
					$this->load->view('recursos/sidebargentelella');
					$this->load->view('recursos/topbargentelella');
					$this->load->view('read/view_ejecucionactividades',$data);
					$this->load->view('recursos/creditosgentelella');
					$this->load->view('recursos/footergentelella');
            	} 
            }
        }		
	}

	public function agregarObservacion()
	{	
		
		$idprograma=$_POST ['idprograma'];

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
            	$data['idProgramaTrabajo'] = $_POST ['idprograma'];
            	$data['idEmpleado'] = $_POST ['idEmpleado'];
            	$data['idUsuario']=$this->session->userdata('idUsuario');

            	$this->Programas_Model->agregarobservacion($data);

            	$listaactividades=$this->Programas_Model->actividades($_POST ['idmpa']);
				$data['actividades']=$listaactividades;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_ejecucionactividades',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');

            	} else {

            	$data['descripcionHallazgo']=$_POST ['observacion'];
            	$data['prioridadAtencion'] = $_POST ['prioridad'];
            	$data['anexo'] = $anexo;
            	$data['idProgramaTrabajo'] = $_POST ['idprograma'];
            	$data['idEmpleado'] = $_POST ['idEmpleado'];
            	$data['idUsuario']=$this->session->userdata('idUsuario');

            	$this->Programas_Model->agregarobservacion($data);
            	$this->upload->data();

            	$listaactividades=$this->Programas_Model->actividades($_POST ['idmpa']);
				$data['actividades']=$listaactividades;

				$this->load->view('recursos/headergentelella');
				$this->load->view('recursos/sidebargentelella');
				$this->load->view('recursos/topbargentelella');
				$this->load->view('read/view_ejecucionactividades',$data);
				$this->load->view('recursos/creditosgentelella');
				$this->load->view('recursos/footergentelella');
            }
	}

	public function agregar()
	{
		$idproceso=$_POST ['idPlanAnual'];
		$subprocesos=$this->Programas_Model->selectsubproceso($idproceso);
		$data['infoidplan']=$subprocesos;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_programatrabajo',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function agregarbdd()
	{
		$dataPost = json_decode(file_get_contents('php://input'));
		$data['data']=$dataPost->data;
		
		$response = $this->Programas_Model->agregarprograma($data);
		if($response){	
			
			echo json_encode(["status" => true]);
		}else{
			echo json_encode(["status" => false]);
		}
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

		$data['nombres']=mb_strtoupper($_POST ['nombres'],'UTF-8');
		$data['primerApellido']=mb_strtoupper($_POST ['primerApellido'],'UTF-8');
		$data['segundoApellido']=mb_strtoupper($_POST ['segundoApellido'],'UTF-8');
		$data['ci']=$_POST ['ci'];
		$data['expedicion']=$_POST ['expedicion'];
		$data['celular']=$_POST ['celular'];
		$data['telefonoInterno']=$_POST ['telefonoInterno'];
		$data['correoInstitucional']=strtolower($_POST ['correoInstitucional']);
		$data['idCargo']=$_POST ['idCargo'];
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');
		
		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/index','refresh');
	}

	public function eliminarbd()
	{
		$idEmpleado=$_POST ['idEmpleado'];
		$data['estado']='0';
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		$data['idUsuario']=$this->session->userdata('idUsuario');

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
		$data['idUsuario']=$this->session->userdata('idUsuario');

		$this->Empleados_Model->modificarempleado($idEmpleado,$data);
		redirect('controller_empleados/eliminados','refresh');

	}



	public function revision()
	{
		$estado= $_POST ['proceso'];
		switch ($estado) {
      case '1':
        $data['estadoPrograma']='1';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_programas/index','refresh');
        break;

      case '2':
        $data['estadoPrograma']='2';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_programas/index','refresh');
        break;
      case '3':
        $data['estadoPrograma']='3';
		$data['idUsuario']=$this->session->userdata('idUsuario');
		$data['fechaActualizacion']=date("Y-m-d (H:i:s)");
		
		$this->MemorandumPlanificacion_Model->modificarmpa($_POST ['idmpa'],$data);

		redirect('controller_programas/index','refresh');
       break;
      
      default:
        break;
    }
		
	}




	public function actividadespdf()
	{
		
	if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
	{

		$programas=$this->Programas_Model->actividades($_POST ['idmpa']);
		$programas=$programas->result(); //convertir a array bidemencional

		$this->pdf=new Pdf();
		$this->pdf->addPage('P','letter');
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Detalle de Actividades por Auditoría"); //título en el encabezado
		
		$this->pdf->SetLeftMargin(20); //margen izquierdo
		$this->pdf->SetRightMargin(20); //margen derecho
		$this->pdf->SetFillColor(210,210,210); //color de fondo
		$this->pdf->SetFont('Arial','B',11); //tipo de letra
		$actividad=$this->Observaciones_Model->observaciones($_POST ['idmpa']);
		$actividad=$actividad->result();
		foreach ($actividad as $rowa) {
			$act=$rowa->informe;
			$nro=$rowa->numeroInforme;
		}
		$this->pdf->Cell(0,10,utf8_decode($act),0,1,'C',1);

		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(35,10,utf8_decode('Nro. De Informe:'),0,0,'L',0);
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(50,10,utf8_decode($nro),0,1,'L',0);

		$this->pdf->Ln(3); //margin para el espaciado
		$this->pdf->SetFont('Arial','B',10);

		$this->pdf->Cell(10,8,'Nro.','LTRB',0,'C',0);
		$this->pdf->Cell(115,8,utf8_decode('Programa de Trabajo'),1,0,'C',0);
		$this->pdf->Cell(50,8,utf8_decode('Ref. P/T'),1,1,'C',0);

		
		$num=1;
		foreach ($programas as $row) {

			$descripcion=$row->actividad;
          
          $this->pdf->SetFont('Arial','',10);
          $this->pdf->Cell(10,10,$num,1,0,'C',0);
          $this->pdf->Cell(115,10,utf8_decode($descripcion),1,0,'L',false);
          $this->pdf->Cell(50,10,utf8_decode(''),1,0,'L',false);
                  
          $this->pdf->Ln();

          $num++;
		}


		$this->pdf->Output("Programa_de_Trabajo.pdf","I");
		}
		else
		{
			redirect('controller_requerimientoinformacion/index','refresh');
		}

	}


}

