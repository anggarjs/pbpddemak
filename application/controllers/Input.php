<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	//load libary of excel reader
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
	//load library of email
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\OAuth;
	use League\OAuth2\Client\Provider\Google;	

class Input extends CI_Controller {
	function index(){
		if(isset($_SESSION['username']))
			redirect('Input/upload_rab');
		else
			redirect('Welcome');		
	}
	
	public function __construct(){
        parent::__construct();
        $this->load->model('capel_model');
        $this->load->model('material_model');
		$this->load->model('google_model');
		$this->load->model('users_model');
    }
	
	function upload_surat(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$this->form_validation->set_rules('pilihan_ulp', 'Asal Unit Kerja', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('srt_nama_capel', 'Nama Calon Pelanggan', 'required');
		$this->form_validation->set_rules('srt_no_ams_capel', 'Nomor Surat AMS Surat Plgn', 'required');
		$this->form_validation->set_rules('srt_daya_awal_capel', 'Daya Awal Capel', 'required');
 		$this->form_validation->set_rules('tgl_surat_diterima', 'Tanggal Surat Diterima', 'required');

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

			$data['nama_user'] 		= $_SESSION['username'];
			$data['content'] 		= $this->load->view('RAB/form_upload_surat',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			//cek apakah sudah pernah ada capel sebelumnya
			$cek_capel_awal				= $this->capel_model->cek_capel_bermohon(trim($this->input->post('srt_nama_capel')),$this->input->post('srt_daya_awal_capel'))->num_rows();
			if($cek_capel_awal > 0){
				$this->session->set_userdata('alert_upload','Data Surat Pelanggan Atas Nama '.trim($this->input->post('srt_nama_capel')).' Sudah Pernah Upload');
				redirect('Input/upload_surat');					
			}				
			
			$path 						= 'uploads/'.$this->input->post('pilihan_ulp').'/';
			$new_name 					= 'SRT_PLGN_an_'.$this->input->post('srt_nama_capel').'_'.$this->input->post('srt_daya_awal_capel').'VA';
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$this->input->post('pilihan_ulp').'/';
			$config['allowed_types'] 	= 'pdf';
			$config['max_size'] 		= 16384;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('filesurat')){

				$data_plg = array(
					'id_ulp'					=> $this->input->post('pilihan_ulp'),
					'srt_nama_capel' 			=> $this->input->post('srt_nama_capel'),
					'srt_alamat_capel' 			=> $this->input->post('srt_alamat_capel'),
					'tgl_surat_diterima' 		=> $this->input->post('tgl_surat_diterima'),
					'srt_no_ams_capel' 			=> $this->input->post('srt_no_ams_capel'),
					'srt_daya_awal_capel' 		=> $this->input->post('srt_daya_awal_capel'),
					'srt_tgl_entry_di_aplikasi' => date("Y-m-d"),
					'id_status_capel' 			=> 0,
				);
				
				//insert into database
				$this->capel_model->insert_capel($data_plg);
				
				//get id capel
				$id_capel					= $this->capel_model->cek_surat_capel(trim($this->input->post('srt_nama_capel')),$this->input->post('srt_daya_awal_capel'))->row()->id_capel;				
				
				$this->send_WA($id_capel,$this->input->post('pilihan_ulp'));
				redirect('Capel/view_capel_bermohon');
			}
		}
	}

	function upload_rab(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');		
		
/* 		if($this->input->post('filerab'))
			$this->form_validation->set_rules('filerab', 'File Upload', 'callback_file_check'); */
		
		$this->form_validation->set_rules('pilihan_ulp', 'Asal Unit Kerja', 'required|callback_validasi_data_list');

		$this->form_validation->set_rules('nomor_persetujuan', 'Nomor Surat', 'required');
		$this->form_validation->set_rules('tgl_persetujuan', 'Tanggal Persetujuan Pelanggan', 'required');
 		$this->form_validation->set_rules('tgl_surat_diterima', 'Tanggal Surat Diterima', 'required');

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
		

			$data['nama_user'] 		= $_SESSION['username'];
			/* $data['content'] 		= $this->load->view('RAB/form_upload_rab',$data,true); */
			$data['content']		= '';
			$this->load->view('beranda',$data);
		}
		else{
			
			$path 						= 'uploads/'.$this->input->post('pilihan_ulp').'/';
			$new_name 					= 'Temporary'.$_SESSION['nama_user'];
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$this->input->post('pilihan_ulp').'/';
			$config['allowed_types'] 	= 'xlsx|xls';
			$config['max_size'] 		= 16384;
			$this->load->library('upload', $config);	
		
			if ($this->upload->do_upload('filerab')){

				$file_name 			= $path.'Temporary'.$_SESSION['nama_user'].'.xlsx';
				$arr_file 			= explode('.', $file_name);
				$extension 			= end($arr_file);
				if('csv' == $extension) 
					$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				else 
					$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();				
					
				//load file and get data
				$reader->setReadDataOnly(TRUE);
				$spreadsheet 		= $reader->load($file_name);		
				
				$dayalama		 		= $spreadsheet->getSheetByName('DATA')->getCell('D17')->getValue()*1000;
				$dayabaru		 		= $spreadsheet->getSheetByName('DATA')->getCell('D20')->getCalculatedValue()*1000;
				$biaya_sambung			= str_replace('.','',$spreadsheet->getSheetByName('DATA')->getCell('D9')->getCalculatedValue());
				
				$temp_nama_pelanggan	= $spreadsheet->getSheetByName('DATA')->getCell('D14')->getValue();
				if(strstr($temp_nama_pelanggan,'=')==true)
					$nama_pelanggan 	= $spreadsheet->getSheetByName('DATA')->getCell('D14')->getOldCalculatedValue();
				else
					$nama_pelanggan 	= $spreadsheet->getSheetByName('DATA')->getCell('D14')->getValue();			
				
				$temp_biaya_invest		= $spreadsheet->getSheetByName('DATA')->getCell('D10')->getValue();
				if(strstr($temp_biaya_invest,'=')==true)
					$biaya_invest 	= floor($spreadsheet->getSheetByName('DATA')->getCell('D10')->getOldCalculatedValue());
				
				$data_plg = array(
					'id_ulp'				=> $this->input->post('pilihan_ulp'),
					'tgl_persetujuan'		=> $this->input->post('tgl_persetujuan'),
					'nama_capel' 			=> trim($nama_pelanggan),
					'daya_lama' 			=> $dayalama,
					'daya_baru' 			=> $dayabaru,
					'biaya_penyambungan' 	=> $biaya_sambung,
					'biaya_investasi' 		=> $biaya_invest,
					'tgl_surat_diterima' 	=> $this->input->post('tgl_surat_diterima'),
					'nomor_persetujuan' 	=> $this->input->post('nomor_persetujuan'),
					'tgl_entry_aplikasi' 	=> date("Y-m-d"),
				);
				
	
				// HANDLER UPLOAD RAB ------------------------------------------------------------ //
				
				//cek apakah sudah pernah ada capel sebelumnya
				$cek_capel_awal				= $this->capel_model->cek_capel(trim($nama_pelanggan),$dayabaru)->num_rows();
				if($cek_capel_awal > 0){
					//delete temporary file
					$path 					= 'uploads/'.$this->input->post('pilihan_ulp').'/';
					unlink($path.'Temporary'.$_SESSION['nama_user'].'.xlsx');
					$this->session->set_userdata('alert_upload','Data Pelanggan Atas Nama '.trim($nama_pelanggan).' Sudah Pernah Upload');
					redirect('Input');
					
				}
				
				//cek apakah menggunakan HSS 2022
				$new_var_tahun_hss		= explode(' ',$spreadsheet->getSheetByName('HARGA SATUAN')->getCell('I5')->getValue()); 
				if($new_var_tahun_hss[2] < 2023){					
					$path 					= 'uploads/'.$this->input->post('pilihan_ulp').'/';
					unlink($path.'Temporary'.$_SESSION['nama_user'].'.xlsx');
					$this->session->set_userdata('alert_upload','Data Pelanggan Atas Nama '.trim($nama_pelanggan).' Menggunakan HSS sebelum tahun 2023');
					redirect('Input');
				}
				
				// END OF HANDLER UPLOAD RAB  ------------------------------------------------------------ //
				
				//insert into database
				$this->capel_model->insert_capel($data_plg);
				
				//set session nama capel ketika simpan konfirmasi rab
				$newdata2 = array(
					'nama_capel' 			=> trim($nama_pelanggan),
				);
				$this->session->set_userdata($newdata2);
				
				//get id capel
				$id_capel					= $this->capel_model->cek_capel(trim($nama_pelanggan),$dayabaru)->row()->id_capel;
						
				//get data MDU				
				$array_data_material 		= array();
				$start_data					= 16;
				$akhir_data					= 100;
				for ($i = $start_data;$i<=$akhir_data;$i++) {
					$temp_data_material		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('C'.(string)$i)->getValue();
					if(strstr($temp_data_material,'=')==true)
						$data_material 		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('C'.(string)$i)->getOldCalculatedValue();
					
					$temp_satuan_material	= $spreadsheet->getSheetByName('REKAP MDU')->getCell('E'.(string)$i)->getValue();
					if(strstr($temp_satuan_material,'=')==true)
						$satuan_material 	= $spreadsheet->getSheetByName('REKAP MDU')->getCell('E'.(string)$i)->getOldCalculatedValue();
										
					$temp_vol_material		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('F'.(string)$i)->getValue();
					if(strstr($temp_vol_material,'=')==true)
						$vol_material 		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('F'.(string)$i)->getOldCalculatedValue();
					
					//get_id_detail mdu
					$var_id					= '';
					$id_detail_mdu			= $this->material_model->cek_id_mdu($data_material);	
					foreach($id_detail_mdu->result() as $row){
						$var_id				= $row->id_detail_mdu;
					}

					if($var_id){
						if($vol_material){
							$array_data_material[] 	= array("nama" => $data_material, "satuan" => $satuan_material, "volume" => $vol_material);
							$data = array(
								'id_detail_mdu'		=> $var_id,
								'id_capel'			=> $id_capel,
								'volume_mdu'		=> $vol_material,
							);
							//insert database
							$this->material_model->insert_kebutuhan_mdu($data);
						}
					}
					// ----- HANDLER NAMA MATERIAL TIDAK ADA DALAM LIST -----
					else{
						$path 				= 'uploads/'.$this->input->post('pilihan_ulp').'/';
						unlink($path.'Temporary'.$_SESSION['nama_user'].'.xlsx');
						$this->session->set_userdata('alert_upload','Material '.$data_material.' Pelanggan Atas Nama '.trim($nama_pelanggan).' Tidak ada dalam Database');
						
						//rollback database
						$this->material_model->hapus_kebutuhan_mdu($id_capel);
						$this->material_model->hapus_kebutuhan_tibet($id_capel);
						$this->capel_model->hapus_capel($id_capel);
						
						redirect('Input');
					}
				}//end reading volume MDU
				
				//get data Tibet				
				$array_data_tibet	 		= array();
				$start_data					= 16;
				$akhir_data					= 30;
				for ($i = $start_data;$i<=$akhir_data;$i++) {
					$temp_data_material		= $spreadsheet->getSheetByName('REKAP TIANG')->getCell('C'.(string)$i)->getValue();
					if(strstr($temp_data_material,'=')==true)
						$data_material 		= $spreadsheet->getSheetByName('REKAP TIANG')->getCell('C'.(string)$i)->getOldCalculatedValue();
					
					$temp_satuan_material	= $spreadsheet->getSheetByName('REKAP TIANG')->getCell('E'.(string)$i)->getValue();
					if(strstr($temp_satuan_material,'=')==true)
						$satuan_material 	= $spreadsheet->getSheetByName('REKAP TIANG')->getCell('E'.(string)$i)->getOldCalculatedValue();
										
					$temp_vol_material		= $spreadsheet->getSheetByName('REKAP TIANG')->getCell('F'.(string)$i)->getValue();
					if(strstr($temp_vol_material,'=')==true)
						$vol_material 		= $spreadsheet->getSheetByName('REKAP TIANG')->getCell('F'.(string)$i)->getOldCalculatedValue();
					
					//get_id_detail mdu
					$var_id					= '';
					$id_detail_mdu			= $this->material_model->cek_id_mdu($data_material);	
					foreach($id_detail_mdu->result() as $row){
						$var_id				= $row->id_detail_mdu;
					}					

					if($var_id){
						if($vol_material){
							$array_data_tibet[] 	= array("nama" => $data_material, "satuan" => $satuan_material, "volume" => $vol_material);
							$data = array(
								'id_detail_mdu'		=> $var_id,
								'id_capel'			=> $id_capel,
								'volume_tibet'		=> $vol_material,
							);
							//insert database
							 $this->material_model->insert_kebutuhan_tibet($data); 
						}
					}
				}//end reading volume Tibet				

				//parsing to konfirmasi upload
				$this->konfirmasi($data_plg,$array_data_material,$file_name,$id_capel,$array_data_tibet);
			}//end if
		}
	}
		
	function konfirmasi($data_plg,$array_data_material,$file_name,$id_capel,$array_data_tibet){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['biaya_penyambungan']		= $data_plg['biaya_penyambungan'];
		$data['id_ulp']					= $data_plg['id_ulp'];
		$data['nama_capel']				= $data_plg['nama_capel'];
		$data['daya_lama']				= $data_plg['daya_lama'];
		$data['daya_baru']				= $data_plg['daya_baru'];
		$data['biaya_penyambungan']		= $data_plg['biaya_penyambungan'];
		$data['biaya_investasi']		= $data_plg['biaya_investasi'];
		$data['tgl_surat_diterima']		= $data_plg['tgl_surat_diterima'];
		$data['tgl_persetujuan']		= $data_plg['tgl_persetujuan'];
		$data['nomor_persetujuan']		= $data_plg['nomor_persetujuan'];
		$data['path_file']				= $file_name;
		$data['id_capel']				= $id_capel;
		

	
		$data['data_plg']				= $data_plg;
		$data['data_material']			= $array_data_material;
		$data['data_tibet']				= $array_data_tibet;
	

		$data['nama_user'] 				= $_SESSION['username'];
		$data['content'] 				= $this->load->view('RAB/form_konfirmasi_rab',$data,true);
		$this->load->view('beranda',$data);
	}
	
	function Batal_Upload($ulp,$id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');		
				
		$this->load->model('capel_model');
		$this->load->model('users_model');
		$this->load->model('material_model');		
		
		//delete temporary file
		$path						= './uploads/'.$ulp.'/';
		unlink($path.'Temporary'.$_SESSION['nama_user'].'.xlsx');
		
		//rollback database
		$this->material_model->hapus_kebutuhan_mdu($id_capel);
		$this->material_model->hapus_kebutuhan_tibet($id_capel);
		$this->capel_model->hapus_capel($id_capel);
		
		redirect('Input');
	}
	
	function Simpan_Upload($ulp,$dayabaru,$id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$path 						= 'uploads/'.$ulp.'/';
		//path old file
		$file_name 					= $path.'Temporary'.$_SESSION['nama_user'].'.xlsx';

		//rename file
		$new_name 					= 'RAB_'.$ulp.'_'.$_SESSION['nama_capel'].'_'. $dayabaru.'VA.xlsx';
		$path_new_file				= $path.$new_name;
		rename($file_name,$path_new_file);
		
		//sending email
		//$this->send_email($id_capel,$ulp);
					
		redirect('Capel/View_capel');
	}
	
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
/* 			if($row->phone_number)
			$target		.= $row->phone_number.','; */
		}		

		foreach ($this->users_model->get_data_user_by_role('1')->result() as $row) {
			if($row->phone_number)
				$target		.= $row->phone_number.',';
		}
		
		$target			= substr_replace($target,"",-1);
		$curl 			= curl_init();
		
		$teks_wa		= '*DENGAN HORMAT,*

Berikut kami informasikan terdapat permohonan surat dari '.$nama_ulp.' dengan rincian sebagai berikut :

*Nama Calon Pelanggan :*
'.$nama_awal.'	
*Daya Pelanggan :*
'.number_format($daya_awal).' VA 
*Tanggal Permohonan Pelanggan :*
'.date_format(date_create($tgl_mohon),"d-m-Y").' 
*Username Uploader :*
'.$_SESSION['username'].'

*Terima kasih*
WA System PBPD UP3 Demak
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
	
	function validasi_data_list($str){
		if ($str == '0'){				
			$this->form_validation->set_message('validasi_data_list', 'Silakan memilih salah satu pilihan yang ada pada daftar %s terlebih dahulu');
			return FALSE;
		}
		else		
			return TRUE;
	}//end of function

    function file_check($str){
        $allowed_mime_type_arr 		= array('application/xls','application/Xlsx');
        $mime 						= get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only xls or Xlsx.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
	}
}