<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function index(){
		
	}//end index
	
	function Tambah(){		
		$this->load->model('users_model');

		$pilihan_ulp['0'] 		= "- Pilih ULP -";
		$ulp 					= $this->users_model->get_data_ulp();
		foreach($ulp->result() as $row){
			$pilihan_ulp[$row->id_ulp] = $row->nama_ulp; 
		}
		$data['pilihan_ulp'] 	= $pilihan_ulp;		
	
		$data['nama_user'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('form_tambah_user',$data,true);
		$this->load->view('beranda',$data);			
	}
	
	function logout(){
		$this->session->sess_destroy(); 
		redirect('Welcome');
	}
}
?>
