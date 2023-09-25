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
		if(!isset($_SESSION['username']))
			redirect('Welcome');		
		
        $data['nama_detail_mdu_search'] 	= $this->input->get('nama_detail_mdu');
        // $data['id_detail_mdu'] = $this->material_model->id_detail_mdu();
        $data['search_mdu']				 	= $this->material_model->search_material_kurang($data['nama_detail_mdu_search']);
        $data['nama_user'] 					= $_SESSION['username'];

        $data['content'] 					= $this->load->view('logistik/view_all_logistik', $data, true);
        $this->load->view('beranda', $data);
    }

	function view_material_kurang(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_material_kurang();
		
       
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_all_material_kurang', $data, true);
        $this->load->view('beranda', $data);		
	}
	
	function view_material_lengkap(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 	= $this->material_model->get_material_lengkap();
		
       
		$data['nama_user'] 		= $_SESSION['username'];
        $data['content'] 		= $this->load->view('logistik/view_all_material_lengkap', $data, true);
        $this->load->view('beranda', $data);		
	}
	
    function detailMaterial_kurang($id_detail_mdu){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['material_kurang'] 	= $this->material_model->detail_material_kurang($id_detail_mdu);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Logistik/view_detail_logistik', $data, true);
		$this->load->view('beranda', $data);
    }

    function detailMaterial_lengkap($id_detail_mdu){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
        $data['material_kurang'] 	= $this->material_model->detail_material_lengkap($id_detail_mdu);
        
        
		$data['nama_user'] 			= $_SESSION['username'];  
		$data['content'] 			= $this->load->view('Logistik/view_detail_plg_lengkap', $data, true);
		$this->load->view('beranda', $data);
    }
	
	function View_plgn_lengkap(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel_lengkap();
		

		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('Logistik/view_all_capel_lengkap', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function rollback_material(){
		$delete_items = $this->input->post('check');
		if ($delete_items) {
			foreach ($delete_items as $item) {
				$data_plg = array(
					'id_status_material'	=> 1,
				);	
				$this->capel_model->update_kondisi_material($data_plg,$item);
				
				$data_material = array(
					'status_tersedia'		=> 0,
				);	
				$this->material_model->rollback_material($data_material,$item);
			}			
			redirect('Logistik/View_plgn_lengkap');
		} 
	}	
}