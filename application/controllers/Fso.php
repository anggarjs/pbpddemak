<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fso extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		/* $this->load->model('users_model'); */
		$this->load->model('capel_model');
		$this->load->model('fso_model');
	}

	function index()
	{
	} //end index

	//form untuk upload rab dari surat permohonan
	function Upload_excel(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		/* $this->form_validation->set_rules('status_perluasan', 'Status Perluasan', 'required|callback_validasi_data_list'); */
		$this->form_validation->set_rules('pilihan_ulp', 'Asal Unit Kerja', 'required|callback_validasi_data_list');

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

			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Fso/form_upload_anomali',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$data['id_ulp']					= $this->input->post('pilihan_ulp');
			
			//setting penamaan file
			$path 							= 'uploads/'.$data['id_ulp'].'/';
			$new_name 						= 'Temporary_Koord_FSO'.$_SESSION['nama_user'];
			$config['file_name'] 			= $new_name;
			
			$config['upload_path']			= './uploads/'.$data['id_ulp'].'/';
			$config['allowed_types'] 		= 'xlsx|xls';
			$config['max_size'] 			= 16384;
			
			//jika ada file eksisting, maka hapus file eksisting
			$file_name 					= $path.'Temporary_Koord_FSO'.$_SESSION['nama_user'].'.xlsx';
			if(file_exists($file_name)) {
				unlink($path.'Temporary_Koord_FSO'.$_SESSION['nama_user'].'.xlsx');
			}			
			$this->load->library('upload', $config);		


			if ($this->upload->do_upload('filerab')){	
				$arr_file 			= explode('.', $file_name);
				$extension 			= end($arr_file);
				if('csv' == $extension) 
					$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				else 
					$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();				
					
				//load file and get data
				$reader->setReadDataOnly(TRUE);
				$spreadsheet 			= $reader->load($file_name);
				
				$start_data					= 6;
				$akhir_data					= 1300;
				for ($i = $start_data;$i<=$akhir_data;$i++) {
					
					$tgl_pasang			= $spreadsheet->getSheetByName('Worksheet')->getCell('B'.(string)$i)->getValue();
					$nama_plgn			= $spreadsheet->getSheetByName('Worksheet')->getCell('D'.(string)$i)->getValue();
					$lat				= $spreadsheet->getSheetByName('Worksheet')->getCell('H'.(string)$i)->getValue();
					$long				= $spreadsheet->getSheetByName('Worksheet')->getCell('I'.(string)$i)->getValue();
					$nama_petugas		= $spreadsheet->getSheetByName('Worksheet')->getCell('J'.(string)$i)->getValue();
					$alamat_plgn		= $spreadsheet->getSheetByName('Worksheet')->getCell('G'.(string)$i)->getValue();
					$idpelanggan		= $spreadsheet->getSheetByName('Worksheet')->getCell('C'.(string)$i)->getValue();
					$tarif				= $spreadsheet->getSheetByName('Worksheet')->getCell('E'.(string)$i)->getValue();
					$daya				= $spreadsheet->getSheetByName('Worksheet')->getCell('F'.(string)$i)->getValue();					
					
					$data_plg = array(
						'id_ulp'				=> $data['id_ulp'],
						'nama_plgn' 			=> $nama_plgn,
						'lat' 					=> $lat,
						'longt' 				=> $long,
						'tgl_penyambungan' 		=> $tgl_pasang,
						'nama_petugas' 			=> $nama_petugas,
						'alamat_plgn' 			=> $alamat_plgn,
						'idpelanggan' 			=> $idpelanggan,
						'tarif' 				=> $tarif,
						'daya' 					=> $daya,						
						
						
						
					);
					
					if(!is_null($alamat_plgn))
						$this->fso_model->insert_to_temporary($data_plg);
					else
						break; 
				}//end looping data

			}//end if		
		}//end else controller form
	}//end of function
	
	function View_anomali_lat(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['anomali_lat'] 		= $this->fso_model->get_anomali_lat();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('fso/View_anomali_lat', $data, true);
		$this->load->view('beranda', $data);
	} //end of function	
	
    function detail_plgn_by_lat($lat){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['detail_plgn_by_lat'] = $this->fso_model->detail_plgn_by_lat($lat);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Fso/View_detail_lat', $data, true);
		$this->load->view('beranda', $data);
    }
	
	function view_anomali_long(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['anomali_lat'] 		= $this->fso_model->get_anomali_longt();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('fso/View_anomali_longt', $data, true);
		$this->load->view('beranda', $data);
	} //end of function	
	
    function detail_plgn_by_longt($longt){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['detail_plgn_by_longt'] = $this->fso_model->detail_plgn_by_longt($longt);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Fso/View_detail_longt', $data, true);
		$this->load->view('beranda', $data);
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
