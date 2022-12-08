<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


	function __construct()
	{
		parent::__construct();;
		if($this->session->userdata('userDetails')){
			return redirect(base_url('dashboard'));
		}

		$this->load->view('prelogin/common/login_header');
		
			
		
	}

	public function index()
	{
		$this->load->view('prelogin/signin');
		
		
		
	}

	
}
