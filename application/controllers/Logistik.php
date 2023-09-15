<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logistik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capel_model');
        $this->load->model('material_model');
    }
    public function materialkurangPBPD(){
        $data['nama_detail_mdu_search'] 	= $this->input->get('nama_detail_mdu');
        // $data['id_detail_mdu'] = $this->material_model->id_detail_mdu();
        $data['search_mdu']				 	= $this->material_model->search_material_kurang($data['nama_detail_mdu_search']);
        $data['nama_user'] 					= $_SESSION['username'];
        $data['nama_user_pegawai'] 			= $_SESSION['username'];
        $data['content'] 					= $this->load->view('logistik/view_all_logistik', $data, true);
        $this->load->view('beranda', $data);
    }
	
    public function detailMaterial($id_detail_mdu){
        $data['material_kurang'] = $this->material_model->detail_material_kurang($id_detail_mdu);
        $data['title'] = 'Data Material Belum Terpenuhi';
        $data['nama_user'] = $_SESSION['username'];
        $data['nama_user_pegawai'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('Logistik/view_detail_logistik', $data, true);
		$this->load->view('beranda', $data);
    }
	
	function view_material_kurang(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_material_kurang();
		
        $data['title'] = 'Material Kurang PBPD';
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_all_material_kurang', $data, true);
        $this->load->view('beranda', $data);		
	}
}
