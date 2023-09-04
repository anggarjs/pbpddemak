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


	function upload_rab()
	{
		$data['nama_user'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('form_upload_rab', $data, true);
		$this->load->view('beranda', $data);
	}

	public function proses_upload_rab()
	{
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

	function Upload_rab2()
	{
		$path = 'uploads/';
		$new_name = 'Temporary';
		$config['file_name'] = $new_name;

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('filerab')) {
			$file_name = $path . 'Temporary.xlsx';
			$arr_file = explode('.', $file_name);
			$extension = end($arr_file);
			if ('csv' == $extension)
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			else
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

			$spreadsheet = $reader->load($file_name);
			$sheet_data = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet_data as $row) {
				$this->users_model->insert_ulp($row); // Panggil fungsi model untuk menyimpan data ke database
			}
		}
	}
}
