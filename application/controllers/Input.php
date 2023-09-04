<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Input extends CI_Controller
{
	function index()
	{
		if (isset($_SESSION['username']))
			redirect('Input/upload_rab');
		else
			redirect('Welcome');
	}

	
	function upload_rab(){
		$data['nama_user'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('form_upload_rab',$data,true);
		$this->load->view('beranda',$data);
	}
	
	public function proses_upload_rab(){
		$config['upload_path'] = base_url() . 'assets/uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			$pilihan_ulp[''] 		= "- Pilih ULP -";
			$ulp 					= $this->users_model->get_data_ulp();
			foreach($ulp->result() as $row){
				$pilihan_ulp[$row->id_ulp] = $row->nama_ulp; 
			}
			$data['pilihan_ulp'] 	= $pilihan_ulp;	
			
			$data['nama_user'] 		= $_SESSION['username'];
			$data['content'] 		= $this->load->view('form_upload_rab',$data,true);
			$this->load->view('beranda',$data);
		}
		else{		
			$path 						= 'uploads/'.$this->input->post('pilihan_ulp').'/';
			$new_name 					= 'Temporary'.$_SESSION['nama_user'];
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$this->input->post('pilihan_ulp').'/';
			$config['allowed_types'] 	= 'xlsx|xls|pdf';
			$config['max_size'] 		= 8192;
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
				$nama_pelanggan 	= $spreadsheet->getSheetByName('DATA')->getCell('D14')->getValue();
				$dayalama		 	= $spreadsheet->getSheetByName('DATA')->getCell('D17')->getValue()*1000;
				$dayabaru		 	= $spreadsheet->getSheetByName('DATA')->getCell('D20')->getCalculatedValue()*1000;
				$biaya_sambung		= str_replace('.','',$spreadsheet->getSheetByName('DATA')->getCell('D9')->getCalculatedValue());
				$temp_biaya_invest	= $spreadsheet->getSheetByName('DATA')->getCell('D10')->getValue();

				if(strstr($temp_biaya_invest,'=')==true)
					$biaya_invest 	= floor($spreadsheet->getSheetByName('DATA')->getCell('D10')->getOldCalculatedValue());
				
				$data_plg = array(
					'id_ulp'				=> $this->input->post('pilihan_ulp'),
					'id_status_capel'		=> 1,
					'nomor_surat_ulp_up3'	=> $this->input->post('no_surat_ke_up3'),
					'nama_capel' 			=> trim($nama_pelanggan),
					'daya_lama' 			=> $dayalama,
					'daya_baru' 			=> $dayabaru,
					'biaya_penyambungan' 	=> $biaya_sambung,
					'biaya_investasi' 		=> $biaya_invest,
					'tgl_surat_plgn' 		=> $this->input->post('tgl_mohon_plgn'),
					'tgl_ams_up3' 			=> $this->input->post('tgl_ams_up3'),					
				);
				$this->konfirmasi($data_plg);
/* 				
				//get id capel
				$id_capel					= $this->capel_model->cek_capel(trim($nama_pelanggan),$dayabaru)->row()->id_capel;
				
				//get data MDU
				$start_data					= 16;
				$akhir_data					= 100;
				for ($i = $start_data;$i<=$akhir_data;$i++) {
					$temp_data_material		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('C'.(string)$i)->getValue();
					if(strstr($temp_data_material,'=')==true)
						$data_material 		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('C'.(string)$i)->getOldCalculatedValue();
					
					$temp_vol_material		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('F'.(string)$i)->getValue();
					if(strstr($temp_vol_material,'=')==true)
						$vol_material 		= $spreadsheet->getSheetByName('REKAP MDU')->getCell('F'.(string)$i)->getOldCalculatedValue();
									
					
					
					//get_id_detail mdu
					$id_detail_mdu			= $this->material_model->cek_id_mdu($data_material)->row()->id_detail_mdu;
					
					//insert
					if($vol_material){
					$data = array(
						'id_detail_mdu'		=> $id_detail_mdu,
						'id_capel'			=> $id_capel,
						'volume_mdu'		=> $vol_material,
					);				
					//insert into database
					//$this->material_model->insert_kebutuhan_mdu($data);
					}
				} */
				
				
				
				
				//rename file
				$new_name 					= 'RAB_'.$this->input->post('pilihan_ulp').'_'.trim($nama_pelanggan).'_'. $dayabaru.'KVA.xlsx';
				$path_new_file				= $path.$new_name;
				rename($file_name,$path_new_file);
				
				//redirect('Input/konfirmasi/'.$data_plg);			
			}//end if
		}
	}
	
}
