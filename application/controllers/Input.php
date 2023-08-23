<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {


	public function index(){
		if(isset($_SESSION['username']))
			redirect('Input/upload_rab');
		else
			redirect('Welcome');
	}
	
	function upload_rab(){
	
		$data[] 			= '';
		$data['content'] 	= $this->load->view('form_upload_rab',$data,true);
		$this->load->view('beranda',$data);	
	}
}
