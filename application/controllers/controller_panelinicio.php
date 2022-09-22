<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_panelinicio extends CI_Controller {

	public function index()
	{
		
			$this->load->view('recursos/headergentelella');
			$this->load->view('recursos/sidebargentelella');
			$this->load->view('recursos/topbargentelella');
			$this->load->view('panelinical');
			$this->load->view('recursos/creditosgentelella');
			$this->load->view('recursos/footergentelella');
		
	}
}
