<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Capel extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('users_model');
        }

        public function index(){
            $data_capel = $this->users_model->get_all_data_capel();

            $capel[''] = '';
            foreach ($data_capel->result() as $c) {
                $capel[$c->id_capel]  = $c->nama_ulp;
            }
            $data['data_capel'] = $data_capel;

            $data['nama_user'] = $_SESSION['username'];
            $data['content'] = $this->load->view('capel/view_all_capel', $data, true);
            $this->load->view('beranda', $data);
        }
        public function Tambah(){
            $this->form_validation->set_rules('nama_capel', 'Nama Capel', 'required', [
                'required' => '%s Harus diisi'
            ]);
            $this->form_validation->set_rules('daya_capel', 'Daya Capel', 'required', [
                'required' => '%s Harus diisi'
            ]);
            $this->form_validation->set_rules('biaya_penyambungan', 'Biaya Penyambungan', 'required', [
                'required' => '%s Harus diisi'
            ]);
            $this->form_validation->set_rules('biaya_investasi', 'Biaya Investasi', 'required', [
                'required' => '%s Harus diisi'
            ]);

            if ($this->form_validation->run() == FALSE) {
                $pilihan_ulp[''] = "-Pilih ULP-";
                $ulp = $this->users_model->get_data_ulp();

                foreach ($ulp->result() as $u) {
                    $pilihan_ulp[$u->id_ulp] = $u->nama_ulp;
                }
                $data['pilihan_ulp'] = $pilihan_ulp;
            }else{
                $data = [
                    'id_ulp' => $this->input->post('pilihan_ulp'),
                    'nama_capel' => $this->input->post('nama_capel'),
                    'daya_capel' => $this->input->post('daya_capel'),
                    'biaya_penyambungan' => $this->input->post('biaya_penyambungan'),
                    'biaya_investasi' => $this->input->post('biaya_investasi'),
                ];
                $this->users_model->insert_capel($data);
                redirect('Capel');
            }

            $data['nama_user'] = $_SESSION['username'];
            $data['content'] = $this->load->view('capel/form_tambah_capel', $data, true);
            $this->load->view('beranda', $data);
        }
    }
?>