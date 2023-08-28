<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Capel extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('users_model');
        }

        public function index(){
            $data['nama_user'] = $_SESSION['username'];
            $data['content'] = $this->load->view('capel/view_all_capel', $data, true);
            $this->load->view('beranda', $data);
        }
        public function Tambah(){
            $this->form_validation->set_rules('nama_capel', 'Nama Capel', 'required');
            $this->form_validation->set_rules('daya_capel', 'Daya Capel', 'required');
            $this->form_validation->set_rules('biaya_penyambungan', 'Biaya Penyambungan', 'required');
            $this->form_validation->set_rules('biaya_investasi', 'Biaya Penyambungan', 'required');

            if ($this->form_validation->run() == false) {
                $pilihan_ulp[''] = "-Pilih ULP-";
            }

            $data['nama_user'] = $_SESSION['username'];
            $data['content'] = $this->load->view('capel/form_tambah_capel', $data, true);
            $this->load->view('beranda', $data);
        }
    }
?>