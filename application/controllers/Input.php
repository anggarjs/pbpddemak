<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Input extends CI_Controller {
	function index(){
		if(isset($_SESSION['username']))
			redirect('Input/upload_rab');
		else
			redirect('Welcome');		
	}

	
	function upload_rab(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');		
		
		$this->load->model('capel_model');
		$this->load->model('users_model');
		$this->load->model('material_model');
		
		if($this->input->post('filerab'))
			$this->form_validation->set_rules('filerab', 'File Upload', 'callback_file_check');
		
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
			$ulp 					= $this->users_model->get_data_ulp();
			foreach($ulp->result() as $row){
				$pilihan_ulp[$row->id_ulp] = $row->nama_ulp; 
			}
			$data['pilihan_ulp'] 	= $pilihan_ulp;	
			
			$data['nama_user'] 		= $_SESSION['username'];
			$data['content'] 		= $this->load->view('RAB/form_upload_rab',$data,true);
			$this->load->view('beranda',$data);
		}
		else{		
			$path 						= 'uploads/'.$this->input->post('pilihan_ulp').'/';
			$new_name 					= 'Temporary'.$_SESSION['nama_user'];
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/'.$this->input->post('pilihan_ulp').'/';
			$config['allowed_types'] 	= 'xlsx|xls';
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
				);
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
								/* 'status_tersedia'	=> 1, */
							);
							//insert database
							$this->material_model->insert_kebutuhan_mdu($data);
						}
					}
				}//end reading volume MDU

				//parsing to konfirmasi upload
				$this->konfirmasi($data_plg,$array_data_material,$file_name,$id_capel);		
			}//end if
		}
	}
	
	function konfirmasi($data_plg,$array_data_material,$file_name,$id_capel){
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
		$this->capel_model->hapus_capel($id_capel);
		
		redirect('Input');
	}
	
	function Simpan_Upload($ulp,$dayabaru){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$path 						= 'uploads/'.$ulp.'/';
		//path old file
		$file_name 					= $path.'Temporary'.$_SESSION['nama_user'].'.xlsx';

		//rename file
		$new_name 					= 'RAB_'.$ulp.'_'.$_SESSION['nama_capel'].'_'. $dayabaru.'VA.xlsx';
		$path_new_file				= $path.$new_name;
		rename($file_name,$path_new_file);
			
		redirect('Capel/View_capel');
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