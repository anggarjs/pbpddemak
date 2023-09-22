<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	//load library of email
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\OAuth;
	use League\OAuth2\Client\Provider\Google;	

class Capel extends CI_Controller {
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

	function view_capel(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel();

		$data['title'] = "Data Capel Disetujui";
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function view_capel_approved(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		$data['data_capel'] 		= $this->capel_model->get_all_data_capel_approved();
		
		$data['title'] = 'Pengecekan Material';
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_approved', $data, true);
		$this->load->view('beranda', $data);
	}

	function view_capel_lgkp_material(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
				
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_lgkp_material_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_lgkp_material();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_ulp', $data, true);
		$this->load->view('beranda', $data);
	}	
	
	function view_capel_sudah_bayar(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
		
		if($_SESSION['kode_ulp'] != '52550')
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_sudah_bayar_ulp($_SESSION['kode_ulp']);
		else
			$data['data_capel'] 	= $this->capel_model->get_all_data_capel_sudah_bayar();		
		
		$data['nama_user'] 			= $_SESSION['username'];
		$data['content'] 			= $this->load->view('capel/view_all_capel_sudah_bayar', $data, true);
		$this->load->view('beranda', $data);
	}
	
	function Update($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$this->form_validation->set_rules('status_capel', 'Status Permohonan Pelanggan', 'required|callback_validasi_data_list');
		$this->form_validation->set_rules('nomor_surat_up3_ulp', 'Nomor Surat Persetujuan UP3', 'required');
		$this->form_validation->set_rules('tgl_persetujuan_up3', 'Tanggal Surat Persetujuan UP3', 'required');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){			
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;	
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				$data['keterangan_material']	= $row->keterangan_material;	
				$data['tgl_peremajaan']			= $row->tgl_peremajaan;			
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';;
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['title'] = "Data Detail Capel";
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_capel',$data,true);
			$this->load->view('beranda',$data);
		}
		else{	
			$data_plg = array(
				'id_status_capel'		=> $this->input->post('status_capel'),
				'nomor_surat_up3_ulp'	=> $this->input->post('nomor_surat_up3_ulp'),
				'tgl_persetujuan_up3' 	=> $this->input->post('tgl_persetujuan_up3'),
			);
			//update into database
			$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));			
			
			redirect('Capel/view_capel');			
		}
	}//end of function
	
	function Update_material($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
			
		$this->form_validation->set_rules('status_material', 'Status Pengecekan Material', 'required|callback_validasi_data_list');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;
				$data['keterangan_material']	= $row->keterangan_material;
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';;
		
 			$status_material['0'] 		= "- Pilih Status Pelanggan -";
			$material 					= $this->material_model->get_status_material();
			foreach($material->result() as $row){
				$status_material[$row->id_status_material] = $row->status_material; 
			}
			$data['status_material'] 	= $status_material;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['title'] = 'Update Progres Capel';
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_capel_material',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			
			if($this->input->post('status_material') > 2)
				$tgl_lengkap_material	= date("Y-m-d");
			else
				$tgl_lengkap_material	= null;
			
			//update into database
			$data_plg = array(
				'id_status_material'	=> $this->input->post('status_material'),
				'keterangan_material'	=> $this->input->post('keterangan_material'),
				'tgl_lengkap_material' 	=> $tgl_lengkap_material,
			);		
			$this->capel_model->update_kondisi_material($data_plg,$this->input->post('id_capel'));

			//set to 0 status material
			$data = array(
				'status_tersedia'		=> 0,
			);			
			$this->material_model->reset_status_material($data,$this->input->post('id_capel'));
			
			//updating kondisi per material
			$data_status_tersedia		= $this->input->post('status_tersedia');
			foreach($data_status_tersedia as $row){
				if($row){
					/* echo $row; */
					$data = array(
						'status_tersedia'		=> 1,
					);			
					$this->material_model->update_status_material($data,$row);					
				}					
			}
			
			if($this->input->post('status_material') > 2){
				$header		= 'PBPD Material Lengkap';
				$this->send_email($header,$this->input->post('id_capel')); 			
			}
			
			redirect('Capel/view_capel_approved');			
		}
	}//end of function
	
	function Update_progress_capel($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$this->form_validation->set_rules('tgl_bayar_plgn', 'Tanggal Bayar Pelanggan', 'required');
		
		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				$data['keterangan_material']	= $row->keterangan_material;
				$data['no_reservasi_ago']		= $row->no_reservasi_ago;	
				$data['tgl_reservasi_ago']		= $row->tgl_reservasi_ago;
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_pembayaran',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$data_plg = array(
				'id_status_capel' 		=> $this->input->post('status_capel'),
				'tgl_bayar_plgn' 		=> $this->input->post('tgl_bayar_plgn'),
				'no_reservasi_ago' 		=> $this->input->post('no_reservasi_ago'),
				'tgl_reservasi_ago' 	=> $this->input->post('tgl_reservasi_ago'),				
			);	
			
			//update into database
			$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));		
			/* redirect('Capel/view_capel_lgkp_material'); */			
		}
	}//end of function
	
	function Update_peremajaan($id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');
			
		$this->form_validation->set_rules('tgl_peremajaan', 'Tanggal Peremajaan Pelanggan', 'required');
		
		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
			foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
				$data['id_ulp']					= $row->id_ulp;
				$data['nama_capel']				= $row->nama_capel;
				$data['daya_lama']				= $row->daya_lama;
				$data['daya_baru']				= $row->daya_baru;
				$data['biaya_penyambungan']		= $row->biaya_penyambungan;
				$data['biaya_investasi']		= $row->biaya_investasi;
				$data['tgl_surat_diterima']		= $row->tgl_surat_diterima;
				$data['tgl_persetujuan']		= $row->tgl_persetujuan;
				$data['nomor_persetujuan']		= $row->nomor_persetujuan;
				$data['id_status_capel']		= $row->id_status_capel;
				$data['id_status_material']		= $row->id_status_material;
				$data['nomor_surat_up3_ulp']	= $row->nomor_surat_up3_ulp;
				$data['tgl_persetujuan_up3']	= $row->tgl_persetujuan_up3;
				$data['tgl_bayar_plgn']			= $row->tgl_bayar_plgn;
				$data['status_material']		= $row->status_material;	
				$data['tgl_lengkap_material']	= $row->tgl_lengkap_material;	
				$data['keterangan_material']	= $row->keterangan_material;	
				$data['tgl_peremajaan']			= $row->tgl_peremajaan;
				
			}
			$data['id_capel']					= $id_capel;

			$path 								= 'uploads/'.$data['id_ulp'].'/';
			$data['path_file']					= $path.'RAB_'.$data['id_ulp'].'_'.$data['nama_capel']	.'_'. $data['daya_baru'].'VA.xlsx';
		
 			$status_capel['0'] 		= "- Pilih Status Pelanggan -";
			$capel 					= $this->capel_model->get_status_capel();
			foreach($capel->result() as $row){
				$status_capel[$row->id_status_capel] = $row->status_capel; 
			}
			$data['status_capel'] 	= $status_capel;
			
			$data['data_material'] 		= $this->material_model->get_data_material($id_capel);
			
			$data['nama_user'] 			= $_SESSION['username'];
			$data['content'] 			= $this->load->view('Capel/form_update_peremajaan',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$data_plg = array(
				'id_status_capel' 		=> $this->input->post('status_capel'),
				'tgl_peremajaan' 		=> $this->input->post('tgl_peremajaan'),
			);				
			//update into database
			$this->capel_model->update_capel($data_plg,$this->input->post('id_capel'));			
			
			redirect('Capel/view_capel_sudah_bayar');	
		}
	}//end of function	
	
	function validasi_data_list($str){
		if ($str == '0'){				
			$this->form_validation->set_message('validasi_data_list', 'Silakan memilih salah satu pilihan yang ada pada daftar %s terlebih dahulu');
			return FALSE;
		}
		else		
			return TRUE;
	}//end of function	
	
	function send_email($header,$id_capel){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		$mail = new PHPMailer(true);
		 
		// -- setting config email --
		foreach ($this->google_model->get_data_oauth_google()->result() as $row) {
			$g_smtp_oauthClientId			= $row->client_id_google;
			$g_smtp_oauthClientSecret		= $row->secret_key_google;
			$g_smtp_oauthRefreshToken		= $row->refresh_token_google;
			$g_smtp_oauthUserEmail 			= $row->email_google;			
		}
		
		foreach ($this->capel_model->get_data_capel($id_capel)->result() as $row) {
			$nama_capel						= $row->nama_capel;
			$daya_baru						= $row->daya_baru;	
			$nama_ulp						= $row->nama_ulp;
			$biaya_penyambungan				= $row->biaya_penyambungan;	
			$biaya_investasi				= $row->biaya_investasi;
			$status_material				= $row->status_material;	
			$keterangan_material			= $row->keterangan_material;
			$id_ulp							= $row->id_ulp;
			$tgl_lengkap_material			= $row->tgl_lengkap_material;		
		}
		
		$new_date		= date('Y-m-d', strtotime($tgl_lengkap_material .' +14 day'));
		$new_date2		= date_format(date_create($new_date),"d-m-Y");
		/* echo $new_date2; */
		
		$mail->isSMTP();
		$mail->Host 		= 'smtp.gmail.com'; // host
		$mail->SMTPAuth 	= true;	
		$mail->SMTPSecure 	= 'ssl';
		$mail->Port 		= 465; //smtp port
		$mail->AuthType 	= 'XOAUTH2';
		
		$provider = new Google(
			[
			'clientId' 			=> $g_smtp_oauthClientId,
			'clientSecret' 		=> $g_smtp_oauthClientSecret,
			]
		);				
		$mail->setOAuth(
			new OAuth(
				[
				'provider' 		=> $provider,
				'clientId' 		=> $g_smtp_oauthClientId,
				'clientSecret' 	=> $g_smtp_oauthClientSecret,
				'refreshToken' 	=> $g_smtp_oauthRefreshToken,
				'userName' 		=> $g_smtp_oauthUserEmail,
				]
			)
		);	
		
		$mail->setFrom($g_smtp_oauthUserEmail, 'Mail System PBPD UP3 Demak');

		//setting to email
		foreach ($this->users_model->get_data_user_by_ulp($id_ulp)->result() as $row) {	
			/* echo $row->email_user.' TO <br>'; */
			$mail->addAddress($row->email_user, '');
		}		
		
		//setting CC email
		foreach ($this->users_model->get_data_user_by_role('3')->result() as $row) {
			/* echo $row->email_user.' CC <br>'; */
			$mail->AddCC($row->email_user, '');
		}
		foreach ($this->users_model->get_data_user_by_role('1')->result() as $row) {
			$mail->AddCC($row->email_user, '');
		}
		foreach ($this->users_model->get_data_user_by_role('5')->result() as $row) {
			$mail->AddCC($row->email_user, '');
		}		
		
		$mail->isHTML(true);
		$mail->Subject = 'Status Lengkap Material PBPD '.$nama_ulp;
		
		//setting style dan header content
		$msg		= '<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
		<meta name=Generator content="Microsoft Word 12 (filtered medium)">
		<style>
		<!--
		 /* Font Definitions */
		 @font-face
			{font-family:Wingdings;
			panose-1:5 0 0 0 0 0 0 0 0 0;}
		@font-face
			{font-family:Wingdings;
			panose-1:5 0 0 0 0 0 0 0 0 0;}
		@font-face
			{font-family:Calibri;
			panose-1:2 15 5 2 2 2 4 3 2 4;}
		 /* Style Definitions */
		 p.MsoNormal, li.MsoNormal, div.MsoNormal
			{margin:0cm;
			margin-bottom:.0001pt;
			font-size:11.0pt;
			font-family:"Calibri","sans-serif";}
		a:link, span.MsoHyperlink
			{mso-style-priority:99;
			color:blue;
			text-decoration:underline;}
		a:visited, span.MsoHyperlinkFollowed
			{mso-style-priority:99;
			color:purple;
			text-decoration:underline;}
		span.EmailStyle17
			{mso-style-type:personal-compose;
			font-family:"Calibri","sans-serif";
			color:windowtext;}
		.MsoChpDefault
			{mso-style-type:export-only;}
		@page Section1
			{size:612.0pt 792.0pt;
			margin:72.0pt 72.0pt 72.0pt 72.0pt;}
		div.Section1
			{page:Section1;}
		-->
		</style>
		<!--[if gte mso 9]><xml>
		 <o:shapedefaults v:ext="edit" spidmax="1026" />
		</xml><![endif]--><!--[if gte mso 9]><xml>
		 <o:shapelayout v:ext="edit">
		  <o:idmap v:ext="edit" data="1" />
		 </o:shapelayout></xml><![endif]-->
		</head>

		<body lang=EN-US link=blue vlink=purple>

		<div class=Section1>

		<p class=MsoNormal><b>DENGAN HORMAT,</b></p>
		<br>
		<p class=MsoNormal>Berikut kami informasikan permohonanan PBPD dari '.$nama_ulp.' telah <b>lengkap material</b> dengan rincian sebagai berikut :<br><br></p>';
		
		//set content
		$msg	.='	
		
		<p class=MsoNormal><b>Nama Pelanggan : </b><br>
		'.$nama_capel.'<br></p><br>		
		<p class=MsoNormal><b>Daya Pelanggan :</b><br>
		'.number_format($daya_baru).' VA <br></p><br>
		<p class=MsoNormal><b>Biaya Penyambungan :</b><br>
		'.number_format($biaya_penyambungan).'<br></p><br>		
		<p class=MsoNormal><b>Biaya Investasi :</b><br>
		'.number_format($biaya_investasi).'<br></p><br>
		<p class=MsoNormal><b>Status Material : </b><br>
		'.$status_material.'<br></p><br>		
		<p class=MsoNormal><b>Keterangan Material : </b><br>
		'.$keterangan_material.'<br></p><br>
		<p class=MsoNormal><b>Username Updater : </b><br>
		'.$_SESSION['username'].'<br></p><br>			

		<p class=MsoNormal>Umur kelengkapan material adalah 14 hari sejak email berikut dikirimkan atau berakhir pada : '.$new_date2.' </p>
		<p class=MsoNormal>Mohon pelanggan membayar sebelum berakhir umur material</p><br>	
		';
		
		//setting footer content
		$msg	.= '
		<br>
		<p class=MsoNormal>Terima kasih</p>
		<p class=MsoNormal><b>Mail System PBPD UP3 Demak</b></p>
		
		</div>
		</body>
		</html>';
		
	/* 	echo $msg; */

		$mail->Body    = $msg;
		$mail->send();
		

	}
}
