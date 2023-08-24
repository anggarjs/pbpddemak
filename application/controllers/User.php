<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function index(){
		
	}//end index
	
	function Tambah(){		
		$this->load->model('users_model');
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		//$this->form_validation->set_rules('pilihan_ulp', 'Klasifikasi Gangguan', 'callback_validasi_data_list');
		//$this->form_validation->set_rules('pilihan_role', 'Zona Wilayah Gangguan', 'callback_validasi_data_list');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
		
		if($this->form_validation->run() == FALSE){
			$pilihan_ulp['0'] 		= "- Pilih ULP -";
			$ulp 					= $this->users_model->get_data_ulp();
			foreach($ulp->result() as $row){
				$pilihan_ulp[$row->id_ulp] = $row->nama_ulp; 
			}
			$data['pilihan_ulp'] 	= $pilihan_ulp;	

			$pilihan_role['0'] 		= "- Pilih Role -";
			$role 					= $this->users_model->get_data_role();
			foreach($role->result() as $row){
				$pilihan_role[$row->id_role] = $row->nama_role; 
			}
			$data['pilihan_role'] 	= $pilihan_role;			
		
			$data['nama_user'] 	= $_SESSION['username'];
			$data['content'] 	= $this->load->view('form_tambah_user',$data,true);
			$this->load->view('beranda',$data);
		}//end of if
		else{
			
		}//end of else
	}//end of function
	
	function validasi_data_list($str){
		if ($str == '0'){				
			$this->form_validation->set_message('validasi_data_list', 'Silakan memilih salah satu pilihan yang ada pada daftar %s terlebih dahulu');
			return FALSE;
		}
		else		
			return TRUE;
	}//end of function
}
?>
