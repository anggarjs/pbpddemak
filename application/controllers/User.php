<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	function index()
	{
	} //end index

	function Tambah()
	{
		$this->load->model('users_model');
		$this->form_validation->set_rules('username', 'Username', 'required');
		/*$this->form_validation->set_rules('pilihan_ulp', 'Klasifikasi Gangguan', 'callback_validasi_data_list');
		$this->form_validation->set_rules('pilihan_role', 'Zona Wilayah Gangguan', 'callback_validasi_data_list');
*/

		// Setting Error Message
		$this->form_validation->set_message('required', 'Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if ($this->form_validation->run() == FALSE) {
			$pilihan_ulp[''] 		= "- Pilih ULP -";
			$ulp 					= $this->users_model->get_data_ulp();
			foreach ($ulp->result() as $row) {
				$pilihan_ulp[$row->id_ulp] = $row->nama_ulp;
			}
			$data['pilihan_ulp'] 	= $pilihan_ulp;

			$pilihan_role[''] 		= "- Pilih Role -";
			$role 					= $this->users_model->get_data_role();
			foreach ($role->result() as $row) {
				$pilihan_role[$row->id_role] = $row->nama_role;
			}
			$data['pilihan_role'] 	= $pilihan_role;

			//redirect to view
			$data['nama_user'] 	= $_SESSION['username'];
			$data['content'] 	= $this->load->view('user/form_tambah_user', $data, true);
			$this->load->view('beranda', $data);
		} //end of if

		else {
			$data = array(
				'nama_user' 			=> $this->input->post('pilihan_ulp') . '.' . trim($this->input->post('username')),
				'pass_user' 			=> md5('pbpddemak'),
				'id_ulp' 				=> $this->input->post('pilihan_ulp'),
				'id_role' 				=> $this->input->post('pilihan_role'),

			);

			//insert into database
			$this->users_model->insert_user($data);

			redirect('User/View');
		} //end of else
	} //end of function

	function View()
	{
		$this->load->model('users_model');
		$data_users 		= $this->users_model->get_all_data_user();

		$data_user[''] 		= "";
		foreach ($data_users->result() as $row) {
			$data_user[$row->id_user] = $row->nama_role;
		}
		$data['data_users'] = $data_users;

		//redirect to view
		$data['nama_user'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('user/view_all_user', $data, true);
		$this->load->view('beranda', $data);
	} //end of function


	function validasi_data_list($str)
	{
		if ($str == '0') {
			$this->form_validation->set_message('validasi_data_list', 'Silakan memilih salah satu pilihan yang ada pada daftar %s terlebih dahulu');
			return FALSE;
		} else
			return TRUE;
	} //end of function

	function Edit($id_user)
	{
		$pilihan_ulp[''] 		= "- Pilih ULP -";
		$ulp 					= $this->users_model->get_data_ulp();
		foreach ($ulp->result() as $row) {
			$pilihan_ulp[$row->id_ulp] = $row->nama_ulp;
		}
		$data['pilihan_ulp'] 	= $pilihan_ulp;

		$pilihan_role[''] 		= "- Pilih Role -";
		$role 					= $this->users_model->get_data_role();
		foreach ($role->result() as $row) {
			$pilihan_role[$row->id_role] = $row->nama_role;
		}
		$data['pilihan_role'] 	= $pilihan_role;

		//redirect to view
		$data['id_user'] = $id_user;
		$data['data_user'] = $this->users_model->pilih_data_user($id_user);
		$data['nama_user'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('user/form_edit_user', $data, true);
		$this->load->view('beranda', $data);
	}

	function proses_edit_user($id)
	{
		$this->form_validation->set_rules('username', 'Nama User', 'required', [
			'required' => '%s Harus diisi'
		]);
		$this->form_validation->set_rules('pilihan_ulp', 'Unit Kerja', 'required', [
			'required' => '%s Harus diisi'
		]);
		$this->form_validation->set_rules('pilihan_role', 'Role Kerja', 'required', [
			'required' => '%s Harus diisi'
		]);
		if ($this->form_validation->run() == FALSE) {
			$this->Edit($id);
		} else {
			$data = array(
				'nama_user' 			=> $this->input->post('pilihan_ulp') . '.' . trim($this->input->post('username')),
				'id_ulp' 				=> $this->input->post('pilihan_ulp'),
				'id_role' 				=> $this->input->post('pilihan_role'),
			);

			$this->users_model->update_user($data, $id);
			redirect('User/View');
		}
	}
}
