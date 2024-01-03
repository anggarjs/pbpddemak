<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logistik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capel_model');
        $this->load->model('material_model');
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
				$id_material_rusak	= $this->material_model->cek_material_rusak(trim($this->input->post('no_pole_material_rusak')),$this->input->post('pilihan_tipe_trafo'))->row()->id_material_rusak;				
				
				//$this->send_WA($id_material_rusak,$this->input->post('pilihan_ulp'));
				//redirect('Capel/view_capel_bermohon');
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
	
	function send_WA($id_capel,$id_ulp){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$wa_token				=	$this->google_model->get_data_oauth_google()->row()->token_whatssap;
		
		foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
			$nama_awal					= $row->srt_nama_capel;
			$alamat_awal				= $row->srt_alamat_capel;	
			$daya_awal					= $row->srt_daya_awal_capel;
			$tgl_mohon					= $row->tgl_surat_diterima;
			$nama_ulp					= $row->nama_ulp;
		}
		
		//-----------------------------------------------------------------------setting teks WA
		//setting to email
		$target			= '';
		foreach ($this->users_model->get_data_user_by_ulp($id_ulp)->result() as $row) {
			if($row->phone_number)
			$target		.= $row->phone_number.',';
		}		

		foreach ($this->users_model->get_data_user_by_role('1')->result() as $row) {
			if($row->phone_number)
				$target		.= $row->phone_number.',';
		}
		
		$target			= substr_replace($target,"",-1);
		$curl 			= curl_init();
		
		$teks_wa		= '[INFO MATERIAL RUSAK]
		
*DENGAN HORMAT,*

Berikut kami informasikan terdapat permohonan material pengganti dari '.$nama_ulp.' dengan rincian sebagai berikut :

*No Pole Trafo Rusak :*
'.$nama_awal.'	

*Tipe Trafo :*
'.number_format($daya_awal).' VA 

*Merk Trafo :*
'.number_format($daya_awal).' VA 

*Tanggal Trafo Rusak :*
'.date_format(date_create($tgl_mohon),"d-m-Y").' 

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