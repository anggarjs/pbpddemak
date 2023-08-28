<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
class Input extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

	public function index(){
		if(isset($_SESSION['username']))
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
}
