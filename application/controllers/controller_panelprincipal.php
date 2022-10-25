<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_panelprincipal extends CI_Controller {

	public function index()
	{
		$porempleado=$this->PlanAnualTrabajo_Model->enprocesoporempleado();
		$data['proceso']=$porempleado;

		$this->load->view('recursos/headergentelella');
		$this->load->view('recursos/sidebargentelella');
		$this->load->view('recursos/topbargentelella');
		$this->load->view('read/panelprincipal',$data);
		$this->load->view('recursos/creditosgentelella');
		$this->load->view('recursos/footergentelella');
	}

	
}
