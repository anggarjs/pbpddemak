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

		$data['data_capel'] 	= $this->capel_model->get_all_data_capel();

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('Admin/view_all_capel_hapus', $data, true);
		$this->load->view('beranda', $data);
	}
	

}
