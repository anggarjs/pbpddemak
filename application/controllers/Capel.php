<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capel extends CI_Controller {
	function index(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');	
	}

	function view_capel(){
		if(!isset($_SESSION['username']))
			redirect('Welcome');

		
	}	


	
}