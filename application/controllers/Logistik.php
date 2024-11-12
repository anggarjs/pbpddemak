<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logistik extends CI_Controller
{
	public function __construct(){
        parent::__construct();
        $this->load->model('capel_model');
        $this->load->model('material_model');
		$this->load->model('google_model');
		$this->load->model('users_model');
    }
	
    public function materialkurangPBPD(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');		
		
        $data['nama_detail_mdu_search'] 	= $this->input->get('nama_detail_mdu');
        // $data['id_detail_mdu'] = $this->material_model->id_detail_mdu();
        $data['search_mdu']				 	= $this->material_model->search_material_kurang($data['nama_detail_mdu_search']);
        $data['nama_user'] 					= $_SESSION['username'];

        $data['content'] 					= $this->load->view('logistik/view_all_logistik', $data, true);
        $this->load->view('beranda', $data);
    }

	function view_material_kurang(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_material_kurang();
		
       
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_all_material_kurang', $data, true);
        $this->load->view('beranda', $data);		
	}
	
	function view_material_kurang_per_plgn(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_material_kurang_per_plgn();
		
       
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_all_material_kurang_per_plgn', $data, true);
        $this->load->view('beranda', $data);		
	}	
	
	function view_tiang_siap_bayar(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_tibet_kurang();
		
       
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_tiang_siap_bayar', $data, true);
        $this->load->view('beranda', $data);		
	}	
	
    function detailTibet_kurang($id_detail_mdu){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['material_kurang'] 	= $this->material_model->detail_tibet_kurang($id_detail_mdu);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Logistik/view_detail_tibet', $data, true);
		$this->load->view('beranda', $data);
    }	
	
	function view_material_lengkap(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_material_lengkap();
		
       
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_all_material_lengkap', $data, true);
        $this->load->view('beranda', $data);		
	}
	
    function detailMaterial_kurang($id_detail_mdu){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['material_kurang'] 	= $this->material_model->detail_material_kurang($id_detail_mdu);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Logistik/view_detail_logistik', $data, true);
		$this->load->view('beranda', $data);
    }

    function detailMaterial_lengkap($id_detail_mdu){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['material_kurang'] 	= $this->material_model->detail_material_lengkap($id_detail_mdu);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Logistik/view_detail_plg_lengkap', $data, true);
		$this->load->view('beranda', $data);
    }
	
	function View_plgn_lengkap(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel_lengkap();
		

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('Logistik/view_all_capel_lengkap', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function upload_trafo_rusak(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->form_validation->set_rules('pilihan_ulp', 'Asal Unit Kerja', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('pilihan_tipe_trafo', 'Pilihan Tipe Material', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('pilihan_merk_trafo', 'Pilihan Merk Material', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('no_pole_trafo', 'No Pole Lokasi Material', 'required');
 		$this->form_validation->set_rules('tgl_trafo_rusak', 'Tanggal Material Rusak', 'required');		


		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			$pilihan_ulp[''] 		= "- Pilih ULP -";
			$ulp 					= $this->capel_model->get_data_ulp();
			foreach($ulp->result() as $row){
				$pilihan_ulp[$row->id_ulp] = $row->nama_ulp; 
			}
			$data['pilihan_ulp'] 	= $pilihan_ulp;
			
			$pilihan_tipe_trafo[''] 		= "- Pilih Tipe Trafo -";
			$ulp 					= $this->material_model->get_tipe_trafo();
			foreach($ulp->result() as $row){
				$pilihan_tipe_trafo[$row->id_detail_mdu] = $row->nama_detail_mdu; 
			}
			$data['pilihan_tipe_trafo'] 	= $pilihan_tipe_trafo;
			
			$pilihan_merk_trafo[''] 		= "- Pilih Merk Trafo -";
			$ulp 					= $this->material_model->get_merk_trafo();
			foreach($ulp->result() as $row){
				$pilihan_merk_trafo[$row->id_merk_material] = $row->nama_merk_material; 
			}
			$data['pilihan_merk_trafo'] 	= $pilihan_merk_trafo;					

			$data['nama_user'] 		= $_SESSION['username'];
			$data['content'] 		= $this->load->view('Logistik/form_upload_trafo_rusak',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			//cek apakah sudah pernah ada capel sebelumnya
/* 			$cek_capel_awal				= $this->capel_model->cek_capel_bermohon(trim($this->input->post('no_pole_trafo')),$this->input->post('srt_daya_awal_capel'))->num_rows();
			if($cek_capel_awal > 0){
				$this->session->set_userdata('alert_upload','Data Surat Pelanggan Atas Nama '.trim($this->input->post('srt_nama_capel')).' Sudah Pernah Upload');
				redirect('Input/upload_surat');					
			} */				
			
			$path 						= 'uploads/'.$this->input->post('pilihan_ulp').'/';
			$new_name 					= 'BA_KRONOLOGIS_'.$this->input->post('no_pole_trafo').'_'.$this->input->post('pilihan_tipe_trafo');
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$this->input->post('pilihan_ulp').'/';
			$config['allowed_types'] 	= 'pdf';
			$config['max_size'] 		= 16384;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('filesurat')){

				$data_material_rusak = array(
					'id_ulp'						=> $this->input->post('pilihan_ulp'),
					'no_pole_material_rusak' 		=> $this->input->post('no_pole_trafo'),
					'tgl_material_rusak' 			=> $this->input->post('tgl_trafo_rusak'),
					'id_merk_material'				=> $this->input->post('pilihan_merk_trafo'),
					'id_detail_mdu'					=> $this->input->post('pilihan_tipe_trafo'),
					'tgl_entry_di_aplikasi' 		=> date("Y-m-d"),
				);
				
				//insert into database
				$this->material_model->insert_material_rusak($data_material_rusak);
				
				//get id capel
				$id_material_rusak	= $this->material_model->cek_material_rusak(trim($this->input->post('no_pole_trafo')),$this->input->post('pilihan_tipe_trafo'))->row()->id_material_rusak;				
				
				$this->send_WA($id_material_rusak,$this->input->post('pilihan_ulp'));
				redirect('Logistik/view_material_rusak');
			}
		}
	}	
	
	function rollback_material(){
		$delete_items = $this->input->post('check');
		if ($delete_items) {
			foreach ($delete_items as $item) {
				$data_plg = array(
					'id_status_material'	=> 1,
				);	
				$this->capel_model->update_kondisi_material($data_plg,$item);
				
				$data_material = array(
					'status_tersedia'		=> 0,
				);	
				$this->material_model->rollback_material($data_material,$item);
			}			
			redirect('Logistik/View_plgn_lengkap');
		} 
	}
	
	function validasi_data_list($str){
		if ($str == '0'){				
			$this->form_validation->set_message('validasi_data_list', 'Silakan memilih salah satu pilihan yang ada pada daftar %s terlebih dahulu');
			return FALSE;
		}
		else		
			return TRUE;
	}//end of function	
	
	function view_material_rusak(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
				
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->material_model->get_all_material_rusak_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->material_model->get_all_material_rusak();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('Logistik/view_material_rusak', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function Update_Material_Rusak($id_material_rusak){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$this->form_validation->set_rules('tgl_diganti_material', 'Tanggal Penggantian Material', 'required');
		$this->form_validation->set_rules('catatan_vendor_retur', 'Vendor Retur Material', 'required');
		
		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			foreach ($this->material_model->get_data_material_rusak($id_material_rusak)->result() as $row) {
				$data['id_ulp']						= $row->id_ulp;
				$data['no_pole_material_rusak']		= $row->no_pole_material_rusak;
				$data['nama_detail_mdu']			= $row->nama_detail_mdu;
				$data['tgl_material_rusak']			= $row->tgl_material_rusak;
				$data['id_detail_mdu']				= $row->id_detail_mdu;
				$data['id_status_material_rusak']	= $row->id_status_material_rusak;
				$data['tgl_diganti_material']		= $row->tgl_diganti_material;
				$data['tgl_material_retur']			= $row->tgl_material_retur;		
				$data['catatan_vendor_retur']		= $row->catatan_vendor_retur;		
				$data['nama_merk_material']			= $row->nama_merk_material;		
			}
			

			$data['id_material_rusak']			= $id_material_rusak;

 			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'BA_KRONOLOGIS_'.$data['no_pole_material_rusak'].'_'. $data['id_detail_mdu'].'.pdf';
		
 			//$status_material['0'] 		= "- Pilih Status Material -";
			$capel 					= $this->material_model->get_status_material_rusak();
			foreach($capel->result() as $row){
				$status_material[$row->id_status_material_rusak] = $row->status_material_rusak; 
			}
			$data['status_material'] 	= $status_material; 
			
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Logistik/form_update_material_rusak',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$data_plg = array(

				'tgl_diganti_material' 		=> $this->input->post('tgl_diganti_material'),
				'tgl_material_retur' 		=> $this->input->post('tgl_material_retur'),
				'catatan_vendor_retur' 		=> $this->input->post('catatan_vendor_retur'),
				'id_status_material_rusak' 	=> $this->input->post('status_material'),						
			);	
			
			//update into database
			$this->material_model->update_material_rusak($data_plg,$this->input->post('id_material_rusak'));		
			redirect('Logistik/view_material_rusak');
		}
	}//end of function	
	
	function send_WA($id_material_rusak,$id_ulp){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$wa_token						=	$this->google_model->get_data_oauth_google()->row()->token_whatssap;
		
		foreach ($this->material_model->get_data_material_rusak($id_material_rusak)->result() as $row) {
			$no_pole_material_rusak		= $row->no_pole_material_rusak;
			$nama_detail_mdu			= $row->nama_detail_mdu;	
			$tgl_material_rusak			= $row->tgl_material_rusak;
			$nama_ulp					= $row->nama_ulp;
		}
		
		//-----------------------------------------------------------------------setting teks WA
		//setting to email
		$target			= '';
/* 		foreach ($this->users_model->get_data_user_by_ulp($id_ulp)->result() as $row) {
			if($row->phone_number)
			$target		.= $row->phone_number.',';
		} */

		foreach ($this->users_model->get_data_user_by_role('1')->result() as $row) {
			if($row->phone_number)
				$target		.= $row->phone_number.',';
		}
		
		$target			= substr_replace($target,"",-1);
		$curl 			= curl_init();
		
		$teks_wa		= '[INFO MATERIAL RUSAK]
		
*DENGAN HORMAT,*

Berikut kami informasikan terdapat permohonan material pengganti dari '.$nama_ulp.' dengan rincian sebagai berikut :

*No Pole Material Rusak :*
'.$no_pole_material_rusak.'	

*Tipe Material Rusak :*
'.$nama_detail_mdu.'

*Tanggal Material Rusak :*
'.date_format(date_create($tgl_material_rusak),"d-m-Y").' 

*Username Uploader :*
'.$_SESSION['username'].'

*Terima kasih*
WA System Apps PLN UP3 Demak
		';

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.fonnte.com/send',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array(
			'target' 		=> $target,
			'message' 		=> $teks_wa, 
			'countryCode' 	=> '62', //optional
		),
		CURLOPT_HTTPHEADER => array(
		'Authorization: '.$wa_token //change TOKEN to your actual token
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);	
		//echo $response;	
	}	
}