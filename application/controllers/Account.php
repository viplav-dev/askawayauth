<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{


	function __construct()
	{
		parent::__construct();;
		$this->load->helper('message');
		//load encryption library
		$this->load->library('encryption');
		$this->load->model('AccountModel');
		$this->load->library('user_agent');
	}

	public function termsOfService()
	{
		$data['title'] = "Terms of Service";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('termsOfService');
	}
	public function privacyPolicy()
	{
		$data['title'] = "Sign In";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('privacyPolicy');
	}
	
	public function index()
	{

		$this->load->view('prelogin/common/login_header');
	}

	public function signin()
	{
		$this->checkSession();
		$data['title'] = "Sign In";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('prelogin/signin');;
	}
	public function signup()
	{
		$this->checkSession();
		$data['title'] = "Sign Up";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('prelogin/signup');
	}
	public function oneTimeLogin()
	{
		$this->checkSession();
		$data['title'] = "One Time Login";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('prelogin/one_time_login');
	}
	public function onetimeLoginLinkSent()
	{
		$this->checkSession();
		$data['title'] = "One Time Login";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('prelogin/one_time_login_link_sent');
	}
	public function oneTimeLoginCheck()
	{
		$this->checkSession();
		echo "Checking...";
		$token = $this->input->get('token');
		$email = $this->input->get('email');
		if ((!empty($token) && !empty($email)) && ($token != NULL && $email != NULL)) {
			$checkToken = $this->AccountModel->checkToken($email, $token, 'userOneTimeLoginToken', 'userOneTimeLoginExpire');
			if ($checkToken) {
				$userDetails = $this->AccountModel->login($email, $token, 'userOneTimeLoginToken');
				$this->AccountModel->resetOneTimeLogin($email);
				$this->session->set_userdata('userDetails', $userDetails);
				$this->session->set_userdata('loginLogId', $this->loginLogs());
				$this->startSessionLogs();
				$response = array('status' => 'true', 'msg' => messages()['loginSuccessful']);
				$this->session->set_flashdata('toaster', $response);
				return redirect(base_url('dashboard'));
			} else {
				$response = array('status' => 'false', 'msg' => messages()['invalidLink']);
				$this->session->set_flashdata('toaster', $response);
				return redirect(base_url('account/forgotPassword'));
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['invalidLink']);
			$this->session->set_flashdata('toaster', $response);
			return redirect(base_url('account/forgotPassword'));
		}
	}
	public function sendOneTimeLoginLink()
	{
		$currentTab = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('account/oneTimeLogin'));
		} else {
			$email = strtolower($this->input->post('email'));
			$checkEmail = $this->AccountModel->checkEmail($email);
			if ($checkEmail) {
				$oneTimeLoginLink = $this->createOneTimeLoginLink($email);
				$subject = "One Time Login Link | Password Manager";
				$message = "**DO NOT SHARE THIS LINK WITH ANYONE** <br><br>Please click on the link below to login to your account directly. This link will only work one time. <br> <br><a style=\"padding:10px 15px; background:green;color:white;border-radius:5px;text-decoration:none;font-size:16px;font-weight:bold;\" href='" . $oneTimeLoginLink . "'>One Time Login Link</a>  <br><br> If you are unable to click on the link, please copy the link given below. <br><br> " . $oneTimeLoginLink . "<br><br> This link will be valid only for 10 minutes.
				<br> If you have not requested for one time login link, please ignore this email. <br> <br> Thanks, <br> Password Manager Team";
				$sendMail = $this->sendEmail($email, $subject, $message);
				if ($sendMail) {
					return redirect(base_url('account/onetimeLoginLinkSent'));
				} else {
					$response = array('status' => 'false', 'msg' => messages()['resetLinkNotSent']);
					$this->session->set_flashdata('toaster', $response);
					return redirect($currentTab);
				}
			} else {
				$response = array('status' => 'false', 'msg' => messages()['userNotExists']);
				$this->session->set_flashdata('toaster', $response);
				return redirect($currentTab);
			}
		}
	}
	public function login()
	{
		$this->checkSession();
		$currentTab = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$this->form_validation->set_rules('email', 'Email Id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');


		if ($this->form_validation->run()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$hash = hash('sha256', $password);
			$emailCheck = $this->AccountModel->checkEmail($email);
			$userDetails = $this->AccountModel->login($email, $hash, 'userHash');

			if ($userDetails) {
				$this->session->set_userdata('userDetails', $userDetails);
				$this->session->set_userdata('loginLogId', $this->loginLogs());
				$this->startSessionLogs();
				return redirect(base_url('dashboard'));
			} else {
				if ($emailCheck) {
					$response = array('status' => 'false', 'msg' => messages()['invalidUserEmailPass']);
				} else {
					$response = array('status' => 'false', 'msg' => messages()['userNotExists']);
				}
				$this->session->set_flashdata('toaster', $response);
				return redirect($currentTab);
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['enterValidEmailPass']);
			$this->session->set_flashdata('toaster', $response);
			return redirect($currentTab);
		}
	}
	public function register(){
		$this->checkSession();
		$currentTab = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.userEmail]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('name', 'Name', 'required');
		
		if ($this->form_validation->run()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$hash = hash('sha256', $password);
			$name = $this->input->post('name');
			$register = $this->AccountModel->register($email, $hash, $name);
			
			if ($register) {
				$response = array('status' => 'true', 'msg' => messages()['registerSuccess']);
				$this->session->set_flashdata('toaster', $response);
				return redirect(base_url('account/signin'));
			} else {
				$response = array('status' => 'false', 'msg' => messages()['registerFailed']);
				$this->session->set_flashdata('toaster', $response);
				return redirect($currentTab);
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['registerFailed']);
			$this->session->set_flashdata('toaster', $response);
			return redirect($currentTab);
		}
	}


	public function logout()
	{
		$response = array('status' => 'true', 'msg' => messages()['logoutSuccess']);
		$this->session->set_flashdata('toaster', $response);
		$this->session->unset_userdata('userDetails');
		return redirect(base_url('account/signin'));
	}
	public function forgotPassword()
	{
		$this->checkSession();
		$data['title'] = "Forgot Password";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('prelogin/forgot_password');
	}
	//View for sent reset confirmation link
	public function resetLinkSent()
	{
		$this->checkSession();
		$data['title'] = "Reset Link Sent";
		$this->load->view('prelogin/common/login_header', $data);
		$this->load->view('prelogin/reset_link_sent');
	}
	//change password function
	public function changePassword()
	{
		$currentTab = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('token', 'Token', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run()) {
			$password = $this->input->post('password');
			$hash = hash('sha256', $password);
			$email = $this->input->post('email');
			$token = $this->input->post('token');
			$checkToken = $this->AccountModel->checkToken($email, $token, 'userResetToken', 'userResetExpire');
			if ($checkToken) {
				$updatePassword = $this->AccountModel->updatePassword($email, $hash);
				if ($updatePassword) {
					$response = array('status' => 'true', 'msg' => messages()['passwordChanged']);
					$this->session->set_flashdata('toaster', $response);
					return redirect(base_url('account/signin'));
				} else {
					$response = array('status' => 'false', 'msg' => messages()['passwordNotChanged']);
					$this->session->set_flashdata('toaster', $response);
					return redirect(base_url('account/signin'));
				}
			} else {
				$response = array('status' => 'false', 'msg' => messages()['invalidToken']);
				$this->session->set_flashdata('toaster', $response);
				return redirect(base_url('account/forgotPassword'));
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['passwordNotMatch']);
			$this->session->set_flashdata('toaster', $response);
			return redirect($currentTab);
		}
	}
	public function resetPassword()
	{
		$this->checkSession();
		$token = $this->input->get('token');
		$email = $this->input->get('email');
		if ((!empty($token) && !empty($email)) && ($token != NULL && $email != NULL)) {
			$checkToken = $this->AccountModel->checkToken($email, $token, 'userResetToken', 'userResetExpire');
			if ($checkToken) {
				$data['title'] = "Reset Password";
				$this->load->view('prelogin/common/login_header', $data);
				$this->load->view('prelogin/reset_password');
			} else {
				$response = array('status' => 'false', 'msg' => messages()['invalidLink']);
				$this->session->set_flashdata('toaster', $response);
				return redirect(base_url('account/forgotPassword'));
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['invalidLink']);
			$this->session->set_flashdata('toaster', $response);
			return redirect(base_url('account/forgotPassword'));
		}
	}

	public function sendresetlink()
	{
		$currentTab = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$this->form_validation->set_rules('email', 'Email Id', 'required');
		if ($this->form_validation->run()) {
			$email = strtolower($this->input->post('email'));
			$emailCheck = $this->AccountModel->checkEmail($email);
			if ($emailCheck) {
				$resetLink = $this->createResetLink($email);
				$subject = "Reset Password | Password Manager";
				$message = "**DO NOT SHARE THIS LINK WITH ANYONE** <br><br>Please click on the link below to reset your password. <br> <br><a style=\"padding:10px 15px; background:green;color:white;border-radius:5px;text-decoration:none;font-size:16px;font-weight:bold;\" href='" . $resetLink . "'>Reset Password</a>  <br><br> If you are unable to click on the link, please copy the link given below. <br><br> " . $resetLink . "<br><br> This link will be valid only for 10 minutes.
				<br> If you have not requested for password reset, please ignore this email. <br> <br> Thanks, <br> Password Manager Team";
				$sendMail = $this->sendEmail($email, $subject, $message);
				if ($sendMail) {
					return redirect(base_url('account/resetLinkSent'));
				} else {
					$response = array('status' => 'false', 'msg' => messages()['resetLinkNotSent']);
					$this->session->set_flashdata('toaster', $response);
					return redirect($currentTab);
				}
			} else {
				$response = array('status' => 'false', 'msg' => messages()['userNotExists']);
				$this->session->set_flashdata('toaster', $response);
				return redirect($currentTab);
			}
		} else {
			$response = array('status' => 'false', 'msg' => messages()['enterValidEmail']);
			$this->session->set_flashdata('toaster', $response);
			return redirect($currentTab);
		}
	}
	private function sendEmail($email, $subject, $message)
	{
		$this->load->library('email'); // Note: no $config param needed
		$this->email->from('pandhurnekarviplavdev@gmail.com', 'Password Manager'); // change it to yours
		$this->email->to($email); // change it to yours
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {

			return true;
		} else {
			return false;
		}
	}
	private function createOneTimeLoginLink($email)
	{
		$this->load->helper('string');
		$token = hash('sha256', $email . random_string('alnum', 64));
		$result = $this->AccountModel->createOneTimeLoginLink($email, $token);
		$oneTimeLoginLink = base_url('account/oneTimeLoginCheck?token=' . $token . '&email=' . $email);
		return $oneTimeLoginLink;
	}
	private function createResetLink($email)
	{
		$this->load->helper('string');
		$token = hash('sha256', $email . random_string('alnum', 64));
		$result = $this->AccountModel->createResetLink($email, $token);
		$resetLink = base_url('account/resetpassword/?token=' . $token . '&email=' . $email);
		return $resetLink;
	}
	private function checkSession()
	{
		if ($this->session->userdata('userDetails')) {
			$response = array('status' => 'false', 'msg' => messages()['alreadyLoggedIn']);
			$this->session->set_flashdata('toaster', $response);
			return redirect(base_url('dashboard'));
		}
	}
	private function loginLogs()
	{
		$header = getallheaders();
		$ip = $header['X-Forwarded-For'];
		$browser = $this->agent->browser();
		$browserVersion = $this->agent->version();
		$os = $this->agent->platform();
		$device = $this->agent->mobile();
		$device = $device ? 'Mobile' : 'Desktop';
		$url = 'https://ipinfo.io/' . $ip . '?token=ae8175e1aaccae';
		//  Initiate curl
		$ch = curl_init();
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL, $url);
		// Execute
		$resultJson = curl_exec($ch);
		$result = json_decode($resultJson);
		// Closing
		curl_close($ch);
		
		$array = array(
			'loginLogIpAddress' => $result->ip,
			'loginLogCity' => $result->city,
			'loginLogState' => $result->region,
			'loginLogCountry' => $result->country,
			'loginLogLoc' => $result->loc,
			'LoginLogOrg' => $result->org,
			'loginLogPinCode' => $result->postal,
			'loginLogTimeZone' => $result->timezone,
			'loginLogBrowser' => $browser,
			'loginLogIsRobot' => $this->agent->is_robot(),
			'loginLogBrowserVersion' => $browserVersion,
			'loginLogMobile' => $device,
			'loginLogPlatform' => $os,
			'loginLogUserId' => $this->session->userdata('userDetails')['userId'],
			'loginLogTimestamp' => time(),
			'loginLogReferrer' => $this->agent->referrer(),

		);
		return $this->AccountModel->loginLogs($array);
	}
	private function startSessionLogs()
	{

		$this->session->set_userdata('sessionStartTime', time());
		$this->session->set_userdata('sessionLastRequestTime', time());
		$this->session->set_userdata('sessionTotalRequests', 0);
		$this->session->set_userdata('sessionDuration', 1);
		$this->session->set_userdata('sessionAvgRequests', 0);
	}
}
