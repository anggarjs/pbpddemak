<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function index(){
		
	}//end index
	
	function cek_login(){		
		$this->load->model('users_model');
		$users 		= $this->users_model->get_all_untuk_login();
		$valid 		= false; //kondisi awal parameter login
		
		//setting session
		$arr_file 			= explode('.', $this->input->post('username'));
		$name	 			= end($arr_file);		
		$newdata = array(
			'username' 		=> $this->input->post('username'),
			'nama_user' 	=> $name,
		);
		$this->session->set_userdata($newdata);
		
		$cek_login	= $this->users_model->cek_login($this->input->post('username'),md5($this->input->post('password')))->num_rows();
		if($cek_login > 0)
			redirect('Input');
		else
			redirect('Welcome');
	}
	
	function logout(){
		$this->session->sess_destroy(); 
		redirect('Welcome');
	}
}
?>
