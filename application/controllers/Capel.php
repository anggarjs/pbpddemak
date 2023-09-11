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
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel();

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function view_capel_approved(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->load->model('capel_model');
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel_approved();
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_approved', $data, true);
		$this->load->view('beranda', $data);
	}

	function view_capel_lgkp_material(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
/* 		$this->load->model('capel_model');
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel_lgkp_material_ulp($_SESSION['kode_ulp']); */
		
		$this->load->model('capel_model');		
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_lgkp_material_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_lgkp_material();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_ulp', $data, true);
		$this->load->view('beranda', $data);
	}	
	

	function Update($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->load->model('capel_model');
		$this->load->model('material_model');
			
		$this->form_validation->set_rules('status_capel', 'Status Permohonan Pelanggan', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('nomor_surat_up3_ulp', 'Nomor Surat Persetujuan UP3', 'required');
		$this->form_validation->set_rules('tgl_persetujuan_up3', 'Tanggal Surat Persetujuan UP3', 'required');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){		

			
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;				
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';;
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_capel',$data,true);
			$this->load->view('beranda',$data);
		}
		else{	
			$data_plg = array(
				'id_status_capel'		=> $this->input->post('status_capel'),
				'nomor_surat_up3_ulp'	=> $this->input->post('nomor_surat_up3_ulp'),
				'tgl_persetujuan_up3' 	=> $this->input->post('tgl_persetujuan_up3'),
			);
			//update into database
			$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));			
			
			redirect('Capel/view_capel');			
		}
	}//end of function
	
	function Update_material($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->load->model('capel_model');
		$this->load->model('material_model');
			
		$this->form_validation->set_rules('status_material', 'Status Pengecekan Material', 'required|callback_validasi_data_list');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;
				$data['keterangan_material']	= $row->keterangan_material;
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';;
		
 			$status_material['0'] 		= "- Pilih Status Pelanggan -";
			$material 					= $this->material_model->get_status_material();
			foreach($material->result() as $row){
				$status_material[$row->id_status_material] = $row->status_material; 
			}
			$data['status_material'] 	= $status_material;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_capel_material',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			
			if($this->input->post('status_material') > 2)
				$tgl_lengkap_material	= date("Y-m-d");
			else
				$tgl_lengkap_material	= null;
			
			//update into database
			$data_plg = array(
				'id_status_material'	=> $this->input->post('status_material'),
				'keterangan_material'	=> $this->input->post('keterangan_material'),
				'tgl_lengkap_material' 	=> $tgl_lengkap_material,
			);		
			$this->capel_model->update_kondisi_material($data_plg,$this->input->post('id_capel'));

			//set to 0 status material
			$data = array(
				'status_tersedia'		=> 0,
			);			
			$this->material_model->reset_status_material($data,$this->input->post('id_capel'));
			
			//updating kondisi per material
			$data_status_tersedia		= $this->input->post('status_tersedia');
			foreach($data_status_tersedia as $row){
				if($row){
					echo $row;
					$data = array(
						'status_tersedia'		=> 1,
					);			
					$this->material_model->update_status_material($data,$row);					
				}					
			}			
			redirect('Capel/view_capel_approved');			
		}
	}//end of function
	

	function Update_progress_capel($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->load->model('capel_model');
		$this->load->model('material_model');
			
		$this->form_validation->set_rules('tgl_bayar_plgn', 'Tanggal Bayar Pelanggan', 'required');
		
		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;	
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';;
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_capel_ulp',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			//upload PDF TUG
			$new_name 					= 'TUG_'.$this->input->post('id_ulp').'_'.$this->input->post('nama_capel').'_'. $this->input->post('daya_baru').'VA.PDF';
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$this->input->post('id_ulp').'/';
			$config['allowed_types'] 	= 'pdf';
			$config['max_size'] 		= 8192;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('filetug')){			
				$data_plg = array(
					'id_status_capel' 		=> $this->input->post('status_capel'),
					'tgl_bayar_plgn' 		=> $this->input->post('tgl_bayar_plgn'),
				);				
				//update into database
				$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));			
				
				redirect('Capel/view_capel_ulp');				
			}
/* 			else{
				$data['nama_user'] 			= $_SESSION['username'];
                $data['error'] = array('error' => $this->upload->display_errors());
				$data['content'] 			= $this->load->view('view_kosongan',$data,true);
				$this->load->view('beranda',$data);
			} */
			
		}
	}//end of function
	
	function validasi_data_list($str){
		if ($str == '0'){				
			$this->form_validation->set_message('validasi_data_list', 'Silakan memilih salah satu pilihan yang ada pada daftar %s terlebih dahulu');
			return FALSE;
		}
		else		
			return TRUE;
	}//end of function	
}<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index(){
		$this->session->sess_destroy(); 
		$this->load->view('welcome_message');
	}
}
