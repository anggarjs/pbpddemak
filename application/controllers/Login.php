<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function index(){
		
	}//end index
	
	function cek_login(){		
		$this->load->model('users_model');
		$cek_login			= $this->users_model->cek_login($this->input->post('username'),md5($this->input->post('password')))->num_rows();
		$cek_login2			= $this->users_model->cek_login($this->input->post('username'),md5($this->input->post('password')));
		foreach ($cek_login2->result() as $data){
			$role			= $data->id_role;
		}
		
		//setting session
		$arr_file 			= explode('.', $this->input->post('username'));

		$newdata = array(
			'kode_ulp'		=> $arr_file[0],
			'username' 		=> $this->input->post('username'),
			'nama_user' 	=> end($arr_file),
			'role_user' 	=> $role,
		);
		$this->session->set_userdata($newdata);
		
		
		if($cek_login > 0){
			if($role != 2)
				redirect('Input');
			else
				redirect('Capel/view_capel');
		}
		else
			redirect('Welcome');
	}
	
	function logout(){
		$this->session->sess_destroy(); 
		redirect('Welcome');
	}
}
?>
