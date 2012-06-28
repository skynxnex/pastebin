<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function login() {
		if($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('login');				
			} else {
				if($this->user_model->login()) {
					redirect(base_url(), 'refresh');					
				} else {
					$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
					$this->form_validation->set_message('login_error', 'Login failed.');
					$this->load->view('login');	
				}
			}
		}
	}
	
	public function activate() {
		
	}
	
	public function profile() {
		if(loggedin()) {
			if($this->input->post()) {
				$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required');
				if ($this->form_validation->run() == FALSE) {
					$result = $this->user_model->getProfile();
					if($result) {
						$data['profile'] = $result;
						$data['body'] = 'profile';
						$this->load->view('template', $data);
					} else {
						$data['body'] = 'error';
						$this->load->view('template', $data);
					}
				} else {
					$result = $this->user_model->update();
					if($result) {
						$data['body'] = 'success';
						$this->load->view('template', $data);
					} else {
						$data['body'] = 'error';
						$this->load->view('template', $data);				
					}
				}
			} else {
				$result = $this->user_model->getProfile();
				if($result) {
					$data['profile'] = $result;
					$data['body'] = 'profile';
					$this->load->view('template', $data);
				} else {
					$data['body'] = 'error';
					$this->load->view('template', $data);
				}
			}
		}else{
			$this->load->view('login');
		}
	}

	public function pass() {
		if(loggedin()) {
			if($this->input->post()) {
				$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
				$this->form_validation->set_rules('password', 'Password', 'required');
    			$this->form_validation->set_rules('password2', 'Password again','required|matches[password]');
				if ($this->form_validation->run() == FALSE) {
					$data['body'] = 'pass';
					$this->load->view('template', $data);
				} else {
					$result = $this->user_model->passUpdate();
					if($result) {
						$data['body'] = 'success';
						$this->load->view('template', $data);
					} else {
						$data['body'] = 'error';
						$this->load->view('template', $data);				
					}
				}
			} else {
				$data['body'] = 'pass';
				$this->load->view('template', $data);
			}
		}else{
			$this->load->view('login');
		}
	}	
	
	public function logout() {
		$username_cookie = array(
					    'name'   => 'username',
					    'value'  => '',
					    'expire' => '-3600',
					    'domain' => 'localhost',
					    'path'   => '/',
					    'prefix' => 'paste_',
					    'secure' => FALSE
					);
		$password_cookie = array(
					    'name'   => 'password',
					    'value'  => '',
					    'expire' => '-3600',
					    'domain' => 'localhost',
					    'path'   => '/',
					    'prefix' => 'paste_',
					    'secure' => FALSE
					);
		$this->input->set_cookie($password_cookie);
					
		// delete_cookie('paste_username');
		setcookie("paste_username", "", time()-3600);
		$this->session->unset_userdata(array('user' => '', 'id' => '', 'name' => '', 'admin' => 0 ));
		redirect(base_url(), 'refresh');
	}
	
	public function create() {
		$publickey = "6LeG7c4SAAAAANFursctJ4VGDHVYiOsWcHSXww0g";
		if($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
    		$this->form_validation->set_rules('password2', 'Password again','required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['cap'] = recaptcha_get_html($publickey);
				$this->load->view('create', $data);				
			} else {
				$privatekey = '6LeG7c4SAAAAAMFk8Qqb_UrQ97ZRUZn1h--RW9EA';
				
				$resp = recaptcha_check_answer ($privatekey,
                                'http://www.xrsize.me',
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  				if ($resp->is_valid) {
					$result = $this->user_model->createUser();
					if($result) {
						$this->load->view('user_success');
					} else {
						$this->load->view('user_error');				
					}
				} else {
					$data['cap_error'] = $resp->error;
					$data['cap'] = recaptcha_get_html($publickey);
					$this->load->view('create', $data);
				}
			}
		} else {
			$data['cap'] = recaptcha_get_html($publickey);
			$this->load->view('create', $data);
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
