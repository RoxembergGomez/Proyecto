<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_subprocesos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor' )
		{
			$listasubproceso=$this->Subprocesos_Model->subprocesos();
			$data['subproceso']=$listasubproceso;

			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('read/view_subprocesos',$data);
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}


	public function agregarprevio()
	{
		$idProceso=$_POST ['idProceso'];
		$data['infoid']=$this->Subprocesos_Model->recuperaridproceso($idProceso);

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('create/add_subprocesos',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');

	}
	
	public function agregar()
	{
		redirect('controller_subprocesos/agregarprevio','refresh');
	}

	public function agregarbdd()
	{
		if(isset($_POST['insertar']))

      {
        $items1 = ($_POST['descripcionSubProceso[]']);
        $items2 = ($_POST['clasificacionCriticidad[]']);
        $items3 = ($_POST['idUsuario[]']);
        $items4 = ($_POST['idProceso[]']);

        while(true) {

            $data['descripcionSubProceso'] = current($items1);
            $data['clasificacionCriticidad'] = current($items2);
           $data['idUsuario']  = current($items3);
            $data['idProceso']  = current($items4);

            ////// ASIGNAR A VARIABLES ///////////////////
            /*$idp=NULL;
            $id=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
            $carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
            $gru=(( $item4 !== false) ? $item4 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='('.$id.',"'.$nom.'","'.$carr.'","'.$gru.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valor= substr($valores, 0, -1);

            $this->db->query("INSERT INTO subproceso (descripcionSubProceso, clasificacionCriticidad, idUsuario,idProceso)
					VALUES $valor");*/
          $this->Subprocesos_Model->agregarsubproceso($data);
           // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
           }
          
    }

		redirect('controller_subprocesos/index','refresh');

	}

	public function eliminarbd()
	{
		$idPlan=$_POST ['IdPlan'];
		

		$this->Plan_Model->eliminaractividad($idPlan);

		redirect('Plan/index','refresh');
	}

	public function modificar()
	{
		$idPlan=$_POST ['IdPlan'];
		$data['infoactividad']=$this->Plan_Model->recuperaractividad($idPlan);


		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('modificar_actividad',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function modificarbd()
	{
		$IdPlan=$_POST ['idPlan'];
		$data['informe']=$_POST ['informe'];
		$data['objetivos']=$_POST ['objetivos'];
		$data['fechaInicio']=$_POST ['fechaInicio'];
		$data['fechaConclusion']=$_POST ['fechaConclusion'];
		$data['gradoPriorizacion']=$_POST ['gradoPriorizacion'];

		//formato en que se guarda los archivos
		$nombrearchivo=$IdPlan.".pdf";
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
		
		$this->Plan_Model->modificaractividad($IdPlan,$data);
		$this->upload->data();
		redirect('Plan/index','refresh');
	}

	public function deshabilitarbd()
	{
		$idPlan=$_POST ['IdPlan'];
		$data['habilitado']='0';

		$this->Plan_Model->modificaractividad($idPlan,$data);

		redirect('Plan/index','refresh');
	}

	public function deshabilitados()
	{
		$listaactividades=$this->Plan_Model->actividadesdeshabilitadas();
		$data['plan_anual']=$listaactividades;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('listaactividadesdeshabilitadas',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	public function habilitarbd()
	{
		$IdPlan=$_POST ['idPlan'];
		$data['habilitado']='1';

		$this->Plan_Model->modificaractividad($IdPlan,$data);
		redirect('Plan/deshabilitados','refresh');

	}


}
