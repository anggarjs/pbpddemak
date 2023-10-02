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

class Capel extends CI_Controller {
	function index(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');	
	}
	
	public function __construct(){
        parent::__construct();
        $this->load->model('capel_model');
        $this->load->model('material_model');
		$this->load->model('google_model');
		$this->load->model('users_model');
    }
	
	function view_capel_bermohon(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_bermohon_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_bermohon();

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_bermohon', $data, true);
		$this->load->view('beranda', $data);
	}

	function view_capel(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel();

		$data['title'] = "Data Capel Disetujui";
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function view_capel_approved(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel_approved();
		
		$data['title'] = 'Pengecekan Material';
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_approved', $data, true);
		$this->load->view('beranda', $data);
	}

	function view_capel_lgkp_material(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
				
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_lgkp_material_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_lgkp_material();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_ulp', $data, true);
		$this->load->view('beranda', $data);
	}	
	
	function view_capel_sudah_bayar(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_sudah_bayar_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_sudah_bayar();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_sudah_bayar', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function Update($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

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
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;	
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				$data['keterangan_material']	= $row->keterangan_material;	
				$data['tgl_peremajaan']			= $row->tgl_peremajaan;			
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
			
			$data['title'] = "Data Detail Capel";
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
	
	function Update_permohonan($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$this->form_validation->set_rules('status_perluasan', 'Status Perluasan', 'required|callback_validasi_data_list');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){			
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['srt_nama_capel']			= $row->srt_nama_capel;
				$data['srt_daya_awal_capel']	= $row->srt_daya_awal_capel;
				$data['srt_alamat_capel']		= $row->srt_alamat_capel;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['srt_no_ams_capel']		= $row->srt_no_ams_capel;
				$data['id_status_perluasan']	= $row->status_perluasan;
			}
			$data['id_capel']			= $id_capel;

			$path 						= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']			= $path.'SRT_PLGN_an_'.$data['srt_nama_capel'].'_'.$data['srt_daya_awal_capel'].'VA.pdf';;
		
			$status_perluasan['0'] 		= "- Pilih Status Perluasan -";
 			$status_perluasan['1'] 		= "Tidak Perluasan";
			$status_perluasan['2'] 		= "Perlu Perluasan JTR";
			$status_perluasan['3'] 		= "Perlu Perluasan JTM dgn Trafo";			
			$data['status_perluasan'] 	= $status_perluasan;

			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_permohonan',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			foreach ($this->capel_model->get_data_capel($this->input->post('id_capel'))->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['srt_nama_capel']			= $row->srt_nama_capel;
				$data['srt_daya_awal_capel']	= $row->srt_daya_awal_capel;
				$data['srt_alamat_capel']		= $row->srt_alamat_capel;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['srt_no_ams_capel']		= $row->srt_no_ams_capel;
				$data['id_status_perluasan']	= $row->status_perluasan;
			}
			$id_capel					= $this->input->post('id_capel');
			

			$path 						= 'uploads/'.$data['id_ulp'].'/';
			$new_name 					= 'Temporary'.$_SESSION['nama_user'];
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$data['id_ulp'].'/';
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
					'id_ulp'				=> $data['id_ulp'],
					'nama_capel' 			=> trim($nama_pelanggan),
					'daya_lama' 			=> $dayalama,
					'daya_baru' 			=> $dayabaru,
					'biaya_penyambungan' 	=> $biaya_sambung,
					'biaya_investasi' 		=> $biaya_invest,
					'tgl_entry_aplikasi' 	=> date("Y-m-d"),
					'status_perluasan'		=> $this->input->post('status_perluasan'),
				);

				//cek apakah sudah pernah ada capel sebelumnya
				$cek_capel_awal				= $this->capel_model->cek_capel(trim($nama_pelanggan),$dayabaru)->num_rows();
				if($cek_capel_awal > 0){
					//delete temporary file
					$path 					= 'uploads/'.$data['id_ulp'].'/';
					unlink($path.'Temporary'.$_SESSION['nama_user'].'.xlsx');
					$this->session->set_userdata('alert_upload_excel','Data Pelanggan Atas Nama '.trim($nama_pelanggan).' Sudah Pernah Upload Hasil Survei');
					redirect('Capel/Update_permohonan/'.$id_capel);	
				}
				
				//cek apakah menggunakan HSS 2022
				$new_var_tahun_hss		= explode(' ',$spreadsheet->getSheetByName('HARGA SATUAN')->getCell('I5')->getValue()); 
				if($new_var_tahun_hss[2] < 2023){					
					$path 					= 'uploads/'.$data['id_ulp'].'/';
					unlink($path.'Temporary'.$_SESSION['nama_user'].'.xlsx');
					$this->session->set_userdata('alert_upload_excel','Data Pelanggan Atas Nama '.trim($nama_pelanggan).' Menggunakan HSS sebelum tahun 2023');
					edirect('Capel/Update_permohonan/'.$id_capel);	
				}				
				// END OF HANDLER UPLOAD RAB  ------------------------------------------------------------ //

				//updating into database
				$this->capel_model->update_capel($data_plg,$id_capel);
				
				//set session nama capel ketika simpan konfirmasi rab
				$newdata2 = array(
					'nama_capel' 			=> trim($nama_pelanggan),
				);
				$this->session->set_userdata($newdata2);
				
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
				$this->konfirmasi_upload($data_plg,$array_data_material,$file_name,$id_capel,$array_data_tibet);				
			}
		}
	}//end of function
	
	function konfirmasi_upload($array_data_material,$file_name,$id_capel,$array_data_tibet){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		foreach ($this->capel_model->get_data_capel($this->input->post('id_capel'))->result() as $row) {
			$data['id_ulp']					= $row->id_ulp;
			$data['nama_capel']				= $row->nama_capel;
			$data['biaya_investasi']		= $row->biaya_investasi;
			$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
			$data['daya_lama']				= $row->daya_lama;
			$data['daya_baru']				= $row->daya_baru;
			$data['biaya_penyambungan']		= $row->biaya_penyambungan;
		}		
		
/* 		$data['biaya_penyambungan']		= $data_plg['biaya_penyambungan'];
		$data['id_ulp']					= $data_plg['id_ulp'];
		$data['nama_capel']				= $data_plg['nama_capel'];
		$data['daya_lama']				= $data_plg['daya_lama'];
		$data['daya_baru']				= $data_plg['daya_baru'];
		$data['biaya_penyambungan']		= $data_plg['biaya_penyambungan'];
		$data['biaya_investasi']		= $data_plg['biaya_investasi'];
		$data['tgl_surat_diterima']		= $data_plg['tgl_surat_diterima'];
		$data['tgl_persetujuan']		= $data_plg['tgl_persetujuan'];
		$data['nomor_persetujuan']		= $data_plg['nomor_persetujuan']; */
		$data['path_file']				= $file_name;
		$data['id_capel']				= $id_capel;
	
		$data['data_material']			= $array_data_material;
		$data['data_tibet']				= $array_data_tibet;
	

		$data['nama_user'] 				= $_SESSION['username'];
		$data['content'] 				= $this->load->view('RAB/form_konfirmasi_rab',$data,true);
		$this->load->view('beranda',$data);
	}	
	
	function Update_material($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
			
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
			
			$data['title'] = 'Update Progres Capel';
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
					/* echo $row; */
					$data = array(
						'status_tersedia'		=> 1,
					);			
					$this->material_model->update_status_material($data,$row);					
				}					
			}
			
			if($this->input->post('status_material') > 2){
				$header		= 'PBPD Material Lengkap';
				$this->send_email($header,$this->input->post('id_capel')); 			
			}
			
			redirect('Capel/view_capel_approved');			
		}
	}//end of function
	
	function Update_progress_capel($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

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
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				$data['keterangan_material']	= $row->keterangan_material;
				$data['no_reservasi_ago']		= $row->no_reservasi_ago;	
				$data['tgl_reservasi_ago']		= $row->tgl_reservasi_ago;
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_pembayaran',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$data_plg = array(
				'id_status_capel' 		=> $this->input->post('status_capel'),
				'tgl_bayar_plgn' 		=> $this->input->post('tgl_bayar_plgn'),
				'no_reservasi_ago' 		=> $this->input->post('no_reservasi_ago'),
				'tgl_reservasi_ago' 	=> $this->input->post('tgl_reservasi_ago'),				
			);	
			
			//update into database
			$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));		
			redirect('Capel/view_capel_lgkp_material');			
		}
	}//end of function
	
	function Update_peremajaan($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
			
		$this->form_validation->set_rules('tgl_peremajaan', 'Tanggal Peremajaan Pelanggan', 'required');
		
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
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;	
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				$data['keterangan_material']	= $row->keterangan_material;	
				$data['tgl_peremajaan']			= $row->tgl_peremajaan;
				
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_peremajaan',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$data_plg = array(
				'id_status_capel' 		=> $this->input->post('status_capel'),
				'tgl_peremajaan' 		=> $this->input->post('tgl_peremajaan'),
			);				
			//update into database
			$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));			
			
			redirect('Capel/view_capel_sudah_bayar');	
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
	
	function send_email($header,$id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$mail = new PHPMailer(true);
		 
		// -- setting config email --
		foreach ($this->google_model->get_data_oauth_google()->result() as $row) {
			$g_smtp_oauthClientId			= $row->client_id_google;
			$g_smtp_oauthClientSecret		= $row->secret_key_google;
			$g_smtp_oauthRefreshToken		= $row->refresh_token_google;
			$g_smtp_oauthUserEmail 			= $row->email_google;			
		}
		
		foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
			$nama_capel						= $row->nama_capel;
			$daya_baru						= $row->daya_baru;	
			$nama_ulp						= $row->nama_ulp;
			$biaya_penyambungan				= $row->biaya_penyambungan;	
			$biaya_investasi				= $row->biaya_investasi;
			$status_material				= $row->status_material;	
			$keterangan_material			= $row->keterangan_material;
			$id_ulp							= $row->id_ulp;
			$tgl_lengkap_material			= $row->tgl_lengkap_material;		
		}
		
		$new_date		= date('Y-m-d', strtotime($tgl_lengkap_material .' +14 day'));
		$new_date2		= date_format(date_create($new_date),"d-m-Y");
		/* echo $new_date2; */
		
		$mail->isSMTP();
		$mail->Host 		= 'smtp.gmail.com'; // host
		$mail->SMTPAuth 	= true;	
		$mail->SMTPSecure 	= 'ssl';
		$mail->Port 		= 465; //smtp port
		$mail->AuthType 	= 'XOAUTH2';
		
		$provider = new Google(
			[
			'clientId' 			=> $g_smtp_oauthClientId,
			'clientSecret' 		=> $g_smtp_oauthClientSecret,
			]
		);				
		$mail->setOAuth(
			new OAuth(
				[
				'provider' 		=> $provider,
				'clientId' 		=> $g_smtp_oauthClientId,
				'clientSecret' 	=> $g_smtp_oauthClientSecret,
				'refreshToken' 	=> $g_smtp_oauthRefreshToken,
				'userName' 		=> $g_smtp_oauthUserEmail,
				]
			)
		);	
		
		$mail->setFrom($g_smtp_oauthUserEmail, 'Mail System PBPD UP3 Demak');

		//setting to email
		foreach ($this->users_model->get_data_user_by_ulp($id_ulp)->result() as $row) {	
			$mail->addAddress($row->email_user, '');
			$mail->addAddress($row->email_user2, '');
		}		
		
		//setting CC email
		foreach ($this->users_model->get_data_user_by_role('3')->result() as $row) {
			/* echo $row->email_user.' CC <br>'; */
			$mail->AddCC($row->email_user, '');
		}
		foreach ($this->users_model->get_data_user_by_role('1')->result() as $row) {
			$mail->AddCC($row->email_user, '');
			//$mail->addAddress($row->email_user, '');
			echo $row->email_user.'<br>';
		}
		foreach ($this->users_model->get_data_user_by_role('5')->result() as $row) {
			$mail->AddCC($row->email_user, '');
			
		}		
		
		$mail->isHTML(true);
		$mail->Subject = 'Status Lengkap Material PBPD '.$nama_ulp;
		
		//setting style dan header content
		$msg		= '<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
		<meta name=Generator content="Microsoft Word 12 (filtered medium)">
		<style>
		<!--
		 /* Font Definitions */
		 @font-face
			{font-family:Wingdings;
			panose-1:5 0 0 0 0 0 0 0 0 0;}
		@font-face
			{font-family:Wingdings;
			panose-1:5 0 0 0 0 0 0 0 0 0;}
		@font-face
			{font-family:Calibri;
			panose-1:2 15 5 2 2 2 4 3 2 4;}
		 /* Style Definitions */
		 p.MsoNormal, li.MsoNormal, div.MsoNormal
			{margin:0cm;
			margin-bottom:.0001pt;
			font-size:11.0pt;
			font-family:"Calibri","sans-serif";}
		a:link, span.MsoHyperlink
			{mso-style-priority:99;
			color:blue;
			text-decoration:underline;}
		a:visited, span.MsoHyperlinkFollowed
			{mso-style-priority:99;
			color:purple;
			text-decoration:underline;}
		span.EmailStyle17
			{mso-style-type:personal-compose;
			font-family:"Calibri","sans-serif";
			color:windowtext;}
		.MsoChpDefault
			{mso-style-type:export-only;}
		@page Section1
			{size:612.0pt 792.0pt;
			margin:72.0pt 72.0pt 72.0pt 72.0pt;}
		div.Section1
			{page:Section1;}
		-->
		</style>
		<!--[if gte mso 9]><xml>
		 <o:shapedefaults v:ext="edit" spidmax="1026" />
		</xml><![endif]--><!--[if gte mso 9]><xml>
		 <o:shapelayout v:ext="edit">
		  <o:idmap v:ext="edit" data="1" />
		 </o:shapelayout></xml><![endif]-->
		</head>

		<body lang=EN-US link=blue vlink=purple>

		<div class=Section1>

		<p class=MsoNormal><b>DENGAN HORMAT,</b></p>
		<br>
		<p class=MsoNormal>Berikut kami informasikan permohonanan PBPD dari '.$nama_ulp.' telah <b>lengkap material</b> dengan rincian sebagai berikut :<br><br></p>';
		
		//set content
		$msg	.='	
		
		<p class=MsoNormal><b>Nama Pelanggan : </b><br>
		'.$nama_capel.'<br></p><br>		
		<p class=MsoNormal><b>Daya Pelanggan :</b><br>
		'.number_format($daya_baru).' VA <br></p><br>
		<p class=MsoNormal><b>Biaya Penyambungan :</b><br>
		'.number_format($biaya_penyambungan).'<br></p><br>		
		<p class=MsoNormal><b>Biaya Investasi :</b><br>
		'.number_format($biaya_investasi).'<br></p><br>
		<p class=MsoNormal><b>Status Material : </b><br>
		'.$status_material.'<br></p><br>		
		<p class=MsoNormal><b>Keterangan Material : </b><br>
		'.$keterangan_material.'<br></p><br>
		<p class=MsoNormal><b>Username Updater : </b><br>
		'.$_SESSION['username'].'<br></p><br>			

		<p class=MsoNormal>Umur kelengkapan material adalah 14 hari sejak email berikut dikirimkan atau berakhir pada : '.$new_date2.' </p>
		<p class=MsoNormal>Mohon pelanggan membayar sebelum berakhir umur material</p><br>	
		';
		
		//setting footer content
		$msg	.= '
		<br>
		<p class=MsoNormal>Terima kasih</p>
		<p class=MsoNormal><b>Mail System PBPD UP3 Demak</b></p>
		
		</div>
		</body>
		</html>';
		
		echo $msg;

		$mail->Body    = $msg;
		$mail->send();
		

	}
}
