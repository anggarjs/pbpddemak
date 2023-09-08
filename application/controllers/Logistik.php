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
        $data['nama_user'] = $_SESSION['username'];
        $data['content'] = $this->load->view('logistik/view_all_logistik', $data, true);
        $this->load->view('beranda', $data);
    }
}
