<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	//load library of email
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\OAuth;
	use League\OAuth2\Client\Provider\Google;	

class Admin extends CI_Controller {
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

	function view_capel_hapus(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$data['data_capel'] 		= $this->capel_model->get_all_data_capel();

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('Admin/view_all_capel_hapus', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function DashboardUP3(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['total_plgn']			= $this->capel_model->get_all_capel()->num_rows();
		$data['biaya_penyambungan']	= $this->capel_model->get_total('sum(biaya_penyambungan) as biaya_penyambungan')->row()->biaya_penyambungan/1000000;
		$data['biaya_investasi']	= $this->capel_model->get_total('sum(biaya_investasi) as biaya_investasi')->row()->biaya_investasi/1000000;
		$data['daya_lama']			= $this->capel_model->get_total('sum(daya_lama) as daya_lama')->row()->daya_lama/1000000;
		$data['daya_baru']			= $this->capel_model->get_total('sum(daya_baru) as daya_baru')->row()->daya_baru/1000000;		
		$data['delta_daya']			= $data['daya_baru']-$data['daya_lama'];

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('Admin/Dashboard_UP3', $data, true);
		$this->load->view('beranda', $data);
	}	
	
	function hapus_capel_selected(){
		$delete_items = $this->input->post('check');
		if ($delete_items) {
			foreach ($delete_items as $item) {
				/* echo $item.'<br>'; */
				$this->capel_model->hapus_capel($item);
			}			
			redirect('Admin/view_capel_hapus');
		} 
	}	
	

}
