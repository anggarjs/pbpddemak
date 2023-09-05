<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capel extends CI_Controller {
	function index(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');	
	}

	function view_capel(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->load->model('capel_model');
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel();
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel', $data, true);
		$this->load->view('beranda', $data);
	}	

	function Atur_data_capel(){
		
	}//end of function	
	
}