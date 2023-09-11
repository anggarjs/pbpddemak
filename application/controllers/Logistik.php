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
    public function materialkurangPBPD()
    {
        $data['nama_user_pegawai'] = $_SESSION['username'];
        $data['nama_detail_mdu'] = $this->input->get('nama_detail_mdu');
        $data['search_mdu'] = $this->material_model->search_material_kurang($data['nama_detail_mdu']);
        $data['content'] = $this->load->view('logistik/view_all_logistik', $data, true);
        $this->load->view('beranda', $data);
    }
    public function detailMaterial($nama_detail_mdu){
        foreach ($this->material_model->detail_material_kurang($nama_detail_mdu) as $row) {
			$data['nama_detail_mdu'] = $row->nama_detail_mdu;
			$data['volume_mdu'] = $row->volume_mdu;
			$data['satuan'] = $row->satuan;
		}

        // $data['nama_detail_mdu'] = $nama_detail_mdu;
        $data['nama_user_pegawai'] 	= $_SESSION['username'];
		$data['content'] 	= $this->load->view('logistik/view_detail_logistik', $data, true);
		$this->load->view('beranda', $data);
    }
}
