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
		$this->load->model('capel_model');
		$this->load->model('users_model');
		
		$this->form_validation->set_rules('pilihan_ulp', 'Asal Unit Kerja', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('no_surat_ke_up3', 'Nomor Surat', 'required');

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
			$path 						= 'uploads/';
			$new_name 					= 'Temporary';
			$config['file_name'] 		= $new_name;
			
			$config['upload_path']		= './uploads/';
			$config['allowed_types'] 	= 'xlsx|xls';
			$config['max_size'] 		= 8192;
			$this->load->library('upload', $config);	
		
			if ($this->upload->do_upload('filerab')){
				
				$file_name 			= $path.'Temporary.xlsx';
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
					$biaya_invest = floor($spreadsheet->getSheetByName('DATA')->getCell('D10')->getOldCalculatedValue());
				

				$data = array(
					'id_ulp'				=> $this->input->post('pilihan_ulp'),
					'nama_capel' 			=> trim($nama_pelanggan),
					'daya_lama' 			=> $dayalama,
					'daya_baru' 			=> $dayabaru,
					'biaya_penyambungan' 	=> $biaya_sambung,
					'biaya_investasi' 		=> $biaya_invest,	
				);				
				//insert into database
				$this->capel_model->insert_capel($data);			
				
				//rename file
				$new_name 					= $this->input->post('pilihan_ulp').'_'.trim($nama_pelanggan).'_'. $dayabaru.'KVA.xlsx';
				$path_new_file				= $path.$new_name;
				rename($file_name,$path_new_file);
				
				redirect('Input/upload_rab');			
			}//end if
		}
	}
	
	public function proses_upload_rab(){
		$config['upload_path'] = base_url() . 'assets/uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

		$this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('Input/upload_rab');
        } else {
            $uploaded_data = $this->upload->data();
            $file_path = base_url() . 'assets/uploads/' . $uploaded_data['file_name'];

            $spreadsheet = IOFactory::load($file_path);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            foreach ($data as $row) {
                $this->users_model->insert_ulp($row); // Panggil fungsi model untuk menyimpan data ke database
            }

            $this->session->set_flashdata('success', 'Data has been imported successfully.');
            redirect('Input/upload_rab');
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

	
}
