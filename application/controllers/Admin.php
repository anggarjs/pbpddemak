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
		
		$data['total_plgn']			= $this->capel_model->get_all_capel_non_peremajaan()->num_rows();
		$data['biaya_penyambungan']	= $this->capel_model->get_total('sum(biaya_penyambungan) as biaya_penyambungan')->row()->biaya_penyambungan/1000000000;
		$data['biaya_investasi']	= $this->capel_model->get_total('sum(biaya_investasi) as biaya_investasi')->row()->biaya_investasi/1000000000;
		$data['daya_lama']			= $this->capel_model->get_total('sum(daya_lama) as daya_lama')->row()->daya_lama/1000000;
		$data['daya_baru']			= $this->capel_model->get_total('sum(daya_baru) as daya_baru')->row()->daya_baru/1000000;		
		$data['delta_daya']			= $data['daya_baru']-$data['daya_lama'];
		
		$data['blm_pengecekan']		= $this->capel_model->get_total_cpl_status_material('1')->num_rows();
		$data['blm_lengkap']		= $this->capel_model->get_total_cpl_status_material('2')->num_rows();
		$data['lengkap']			= $this->capel_model->get_total_status_lengkap()->num_rows();
		
		$data['persetujuan']		= $this->capel_model->get_total_cpl_status_plgn('2')->num_rows();
		$data['pembayaran']			= $this->capel_model->get_total_cpl_status_plgn('3')->num_rows();		
		$data['peremajaan']			= $this->capel_model->get_total_cpl_status_plgn('4')->num_rows();
		
		$status_capel 				= $this->capel_model->get_status_capel_non_peremajaan();
		$data['js_script_label']	= 'labels: [';
		$data['js_script_series']	= 'series: [';
		
		foreach($status_capel->result() as $row){
			$data['js_script_label']	.= '"'.$row->status_capel.'",';		
			$total_plgn 				= $this->capel_model->get_all_status_capel($row->id_status_capel)->num_rows();
			$data['js_script_series'] 	.= $total_plgn.',';
		}
		
		$data['js_script_series']	= substr_replace($data['js_script_series'] ,"",-1);
		$data['js_script_series']  	.= '],';
		
		$data['js_script_label']	= substr_replace($data['js_script_label'] ,"",-1);
		$data['js_script_label']  	.= '],';
		$data['js_script']			= $data['js_script_series'].$data['js_script_label'];
		
	
		$data['js_series_plgn']		= 'series: [';
		foreach($this->capel_model->get_status_capel_non_peremajaan()->result() as $row){
			$data['js_series_plgn']  		.= '{';
			$data['js_series_plgn']	.= "name:'".$row->status_capel."',data: [";		
			foreach($this->capel_model->get_data_ulp()->result() as $row2){
				foreach($this->capel_model->get_status_capel_by_status_capel_dan_ulp($row->status_capel,$row2->id_ulp)->result() as $row3){
					$total_daya		= $row3->total_daya_baru-$row3->total_daya_lama;
					$total_daya		= $total_daya/1000;
					$data['js_series_plgn']		.= $total_daya.',';	
				}
				
			}
			$data['js_series_plgn']			= substr_replace($data['js_series_plgn'] ,"",-1);
			$data['js_series_plgn']  		.= ']},';
		}
 		
		$data['js_series_plgn']  	.= '],';
		
	
		$data['js_nama_ulp']		= 'categories: [';
		foreach($this->capel_model->get_data_ulp()->result() as $row){
			$data['js_nama_ulp']	.= '"'.$row->nama_ulp.'",';
		}
 		$data['js_nama_ulp']		= substr_replace($data['js_nama_ulp'] ,"",-1);
		$data['js_nama_ulp']  		.= '],';
		
		
		

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
