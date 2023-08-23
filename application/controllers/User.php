<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function index(){
		
	}//end index
	
	function Tambah(){		
		$this->load->model('users_model');
		$users 		= $this->users_model->get_all_untuk_login();
		
		//setting session
		$newdata = array(
			'username' 		=> $this->input->post('username'),
		);
		$this->session->set_userdata($newdata);
				
		//cek username dan password
		foreach ($users->result() as $row){
			if($this->input->post('username') == $row->nama_user && md5($this->input->post('password')) == $row->pass_user)
				redirect('Input');			
			else
				redirect('Welcome');			
		}
		
		$data[] 			= '';
		$data['content'] 	= $this->load->view('form_tambah_user',$data,true);
		$this->load->view('beranda',$data);			
	}
	
	function logout(){
		$this->session->sess_destroy(); 
		redirect('Welcome');
	}
}
?>
