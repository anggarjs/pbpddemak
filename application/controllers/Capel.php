<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Capel extends CI_Controller{
        public function index(){
            $data['nama_user'] = $_SESSION['username'];
            $data['content'] = $this->load->view('capel/view_all_capel', $data, true);
            $this->load->view('beranda', $data);
        }
    }
?>