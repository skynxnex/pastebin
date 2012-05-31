<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function login() {
		if($this->input->post()) {
			$this->load->model('user_model');
			$this->user_model->login();
			redirect(base_url(), 'refresh');
		}
	}
	
	public function profile() {
		if(loggedin()) {
			$data['body'] = 'profile';
			$this->load->view('template', $data);
		}else{
			$this->load->view('login');
		}
	}
	
	public function logout() {
		$this->session->set_userdata(array('user' => 0));
		redirect(base_url(), 'refresh');
	}
	
	public function create() {
		if($this->input->post()) {
			$this->load->model('user_model');
			$result = $this->user_model->create();
			if($result) {
				$data['body'] = 'success';
				$this->load->view('template', $data);
			} else {
				$data['body'] = 'error';
				$this->load->view('template', $data);				
			}
		} else {
			$data['body'] = 'create';
			$this->load->view('template', $data);
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
