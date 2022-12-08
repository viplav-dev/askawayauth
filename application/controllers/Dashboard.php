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
        $this->load->model('AccountModel');
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
        $this->sessionLogEntry();
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
        $data['password'] = $this->PasswordModel->getPassword($userId, $passwordId);
        if ($data['password']) {
            $data['password']['pswd_enc'] = $this->encryption->decrypt($data['password']['pswd_enc']);
            $data['password']['username'] = $this->encryption->decrypt($data['password']['username']);
            $this->load->view('viewPassword', $data);
        } else {
            $response = array('status' => 'false', 'msg' => messages()['passwordNotFound']);
            $this->session->set_flashdata('toaster', $response);
            return redirect(base_url('dashboard'));
        }
    }
    private function sessionLogEntry()
    {
        
        $this->inactivityLogout();
        $this->session->set_userdata('sessionLastRequestTime', time());
        $this->session->set_userdata('sessionDuration', time() - $this->session->userdata('sessionStartTime'));
        if ($this->session->userdata('sessionDuration') == 0) {
            $this->session->set_userdata('sessionDuration', 1);
        };
        $this->session->set_userdata('sessionTotalRequests', $this->session->userdata('sessionTotalRequests') + 1);
        $this->session->set_userdata(
            'sessionAvgRequests',
            ($this->session->userdata('sessionTotalRequests') / ($this->session->userdata('sessionDuration') / 60))
        );
        $array = array(
            'loginLogTotalRequests' => $this->session->userdata('sessionTotalRequests'),
            'loginLogSessionDuration' => $this->session->userdata('sessionDuration'),
            'loginLogAvgRequests' => $this->session->userdata('sessionAvgRequests'),
        );
        $this->AccountModel->updateLoginLogs($this->session->userdata('loginLogId'), $array);
    }
    private function inactivityLogout()
    {
        // if (time() - $this->session->userdata('sessionLastRequestTime') > 300) {
        //     $this->session->session_abort();
        //     $this->session->session_regenerate_id(true);
        //     $response = array('status' => 'false', 'msg' => messages()['sessionExpired']);
        //     $this->session->set_flashdata('toaster', $response);
        //     return redirect(base_url());
        // }
    }
}
