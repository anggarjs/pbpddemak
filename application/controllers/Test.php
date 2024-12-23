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
			redirect('Test/Test_email');
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
			 $this->load->model('google_model');
			 
			// -- setting config email --
			foreach ($this->google_model->get_data_oauth_google()->result() as $row) {
				$g_smtp_oauthClientId			= $row->client_id_google;
				$g_smtp_oauthClientSecret		= $row->secret_key_google;
				$g_smtp_oauthRefreshToken		= $row->refresh_token_google;
				$g_smtp_oauthUserEmail 			= $row->email_google;
				$wa_token			 			= $row->token_whatssap;
			}
			 
					 
			
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
				

				$mail->setFrom($g_smtp_oauthUserEmail, '');
				$mail->addAddress($this->input->post('nomor_persetujuan'), '');
				$mail->AddCC('rajasa.angga@gmail.com', '');
		

				/* $mail->isHTML(true); */
				$mail->Subject = $this->input->post('nomor_persetujuan');
				
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
				<p class=MsoNormal>Berikut kami informasikan terdapat permohonanan PBPD dari ULP 123 dengan rincian data sebagai berikut :</p>';			

				//setting footer content
				$msg	.= '
				<br>
				<p class=MsoNormal>Terima kasih<o:p></o:p></p>
				<p class=MsoNormal><b><span style=\'color:#FF6600\'>Mail System PBPD UP3 Demak</span></b></span></p>
				<p class=MsoNormal><o:p>&nbsp;</o:p></p>
				</div>
				</body>
				</html>';

				$teks_email		= 'ANGGA';
				

				$mail->Body    	= $teks_email;
				//$mail->send();
				
				echo $msg;
				echo 'Sukses Kirim Email';
				// isi pesan jika telah berhasil terkirim
				
				$curl = curl_init();
				
				$teks_wa		= '*DENGAN HORMAT,*
Berikut kami informasikan terdapat permohonanan PBPD dari ULP Demak dengan rincian data sebagai berikut :
				';
/* 				$teks_wa		.= 'Berikut kami informasikan terdapat permohonanan PBPD dari ULP Demak dengan rincian data sebagai berikut :
				
				'; */

				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://api.fonnte.com/send',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => array(
				'target' => '',
				'message' => $teks_wa, 
				'countryCode' => '62', //optional
				),
				CURLOPT_HTTPHEADER => array(
				'Authorization: '.$wa_token //change TOKEN to your actual token
				),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				echo $response;				
				
				
			} catch (Exception $e) {
				echo $mail->ErrorInfo;
			}
		}
	}
	
}