<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\OAuth;
	use League\OAuth2\Client\Provider\Google;	
/* 	use Hayageek\OAuth2\Client\Provider\Yahoo; */

class Test extends CI_Controller {
	function index(){
		if(isset($_SESSION['username']))
			redirect('Input/upload_rab');
		else
			redirect('Welcome');		
	}

	
	function Test_email(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');		
		
 		$this->form_validation->set_rules('nomor_persetujuan', 'Tanggal Surat Diterima', 'required');

		// Setting Error Message
		$this->form_validation->set_message('required', 'Error, Silahkan mengisi data %s');
		// Setting Delimiter
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		
		if($this->form_validation->run() == FALSE){
		
			
			$data['nama_user'] 		= $_SESSION['username'];
			$data['content'] 		= $this->load->view('RAB/form_test_email',$data,true);
			$this->load->view('beranda',$data);
		}
		else{
			$mail = new PHPMailer(true);
			 
			$g_smtp_oauthUserEmail 		= 'konstruksiup3demak@gmail.com';
			$g_smtp_oauthClientId 		= '356379914807-r9qkoa5qbn380e5j90hlanohk02gjuuk.apps.googleusercontent.com';
			$g_smtp_oauthClientSecret 	= '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';
			$g_smtp_oauthRefreshToken 	= '1//0ghZKMBggoNuPCgYIARAAGBASNgF-L9IrknZsbsbtfJd_Voi9VYVDCB16CpJ01Qd6rxGs7inQLhJZFvmWdSLbaLR3rptzJ3KKjA';			 
			
			try {
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
				

				$mail->setFrom('konstruksiup3demak@yahoo.com', 'Nama Email');
				$mail->addAddress('angga.rajasa@pln.co.id', 'Nama Email');

				$mail->isHTML(true);
				$mail->Subject = 'TEST EMAIL';

				$mail->Body    = "TEST";
				$mail->send();
				
				echo 'Sukses Kirim Email';
				// isi pesan jika telah berhasil terkirim
			} catch (Exception $e) {
				echo $mail->ErrorInfo;
			}
		}
	}
	
}