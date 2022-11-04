<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


    function __construct()
    {
        parent::__construct();;
        $this->load->model('DashboardModel');

        $this->load->library('encryption');
        $this->load->model('PasswordModel');
        $this->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $this->PasswordModel->getUserHash($this->session->userdata('userDetails')['userId'])
            )
        );

        $this->load->helper('message');
        if (!$this->session->userdata('userDetails')) {
            return redirect(base_url());
        }
    }
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('postlogin/common/header', $data);
        // $this->load->view('postlogin/dashboard');
        $data['passwords'] = $this->PasswordModel->getPasswords($this->session->userdata('userDetails')['userId']);
        foreach ($data['passwords'] as $key => $value) {
            $data['passwords'][$key]['pswd_enc'] = $this->encryption->decrypt($value['pswd_enc']);
            $data['passwords'][$key]['username'] = $this->encryption->decrypt($value['username']);
        }

        $this->load->view('passwordView', $data);
    }
    public function addPassword()
    {
        $data['title'] = "Add Password";
        $this->load->view('postlogin/common/header', $data);
        $data['companies'] = $this->DashboardModel->getCompanies();
        $this->load->view('addPassword', $data);
    }
    public function viewPassword($passwordId)
    {
        $data['title'] = "View Password";
        $this->load->view('postlogin/common/header', $data);
        $userId = $this->session->userdata('userDetails')['userId'];
        $data['password'] = $this->PasswordModel->getPassword($userId,$passwordId);
        if($data['password']){
            $data['password']['pswd_enc'] = $this->encryption->decrypt($data['password']['pswd_enc']);
            $data['password']['username'] = $this->encryption->decrypt($data['password']['username']);
            $this->load->view('viewPassword', $data);
        }
        else{
            $response = array('status' => 'false', 'msg' => messages()['passwordNotFound']);
			$this->session->set_flashdata('toaster', $response);
			return redirect(base_url('dashboard'));
        }
    }
}
