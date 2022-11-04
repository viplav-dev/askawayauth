<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Password extends CI_Controller
{


	function __construct()
	{
		parent::__construct();;
		$this->load->helper('message');
		//load encryption library
		$this->load->library('encryption');
		$this->load->model('PasswordModel');
		$this->encryption->initialize(
			array(
				'cipher' => 'aes-256',
				'mode' => 'ctr',
				'key' => $this->PasswordModel->getUserHash($this->session->userdata('userDetails')['userId'])
			)
		);
	}
	public function index()
	{
	}
	public function add()
	{

		$this->form_validation->set_rules('company', 'Company', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			$company_id = $this->input->post('company');
			$pswd_name = $this->input->post('name');
			$pswd_site = $this->input->post('url');
			$username = $this->input->post('username');
			$pswd_username = $this->encryption->encrypt($username);
			$password = $this->input->post('password');
			$pswd_notes = $this->input->post('notes');
			$pswd_enc = $this->encryption->encrypt($password);
			$pswd_userId = $this->session->userdata('userDetails')['userId'];
			$addPassword = $this->PasswordModel->addPassword($pswd_userId, $company_id, $pswd_username, $pswd_enc, $pswd_name, $pswd_site, $pswd_notes);
			if ($addPassword) {
				$response = array('status' => 'true', 'msg' => messages()['passwordAdded']);
				$this->session->set_flashdata('toaster', $response);
				return redirect(base_url('dashboard'));
			} else {
				$response = array('status' => 'false', 'msg' => messages()['passwordNotAdded']);
				$this->session->set_flashdata('toaster', $response);
				return redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['checkDetails']);
			$this->session->set_flashdata('toaster', $response);
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function delete($passwordId)
	{
		$userId = $this->session->userdata('userDetails')['userId'];
		$deletePassword = $this->PasswordModel->deletePassword( $userId,$passwordId);
		if ($deletePassword) {
			$response = array('status' => 'true', 'msg' => messages()['passwordDeleted']);
			$this->session->set_flashdata('toaster', $response);
			return redirect(base_url('dashboard'));
		} else {
			$response = array('status' => 'false', 'msg' => messages()['passwordNotDeleted']);
			$this->session->set_flashdata('toaster', $response);
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
