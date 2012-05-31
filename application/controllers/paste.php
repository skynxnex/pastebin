<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paste extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if(loggedin()) {
			$data['body'] = 'main';
			$this->load->view('template', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	public function my() {
		if(loggedin()) {
			$data['body'] = 'list';
			$this->load->view('template', $data);
		}else{
			$this->load->view('login');
		}
	}
	
	function create() {
		if(loggedin()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
			$this->form_validation->set_rules('headline', 'Headline', 'required');
			$this->form_validation->set_rules('paste', 'Paste', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['body'] = 'main';
				$this->load->view('template', $data);
			} else {
				$this->load->model('paste_model');
				$result = $this->paste_model->create();
				if($result) {
					$data['body'] = 'success';
					$this->load->view('template', $data);
				} else {
					$data['body'] = 'error';
					$this->load->view('template', $data);				
				}	
			}
		} else {
			$this->load->view('login');
		}
	}
	
	public function show() {
		if(loggedin()) {
			$data = array();
			$this->load->model('paste_model');
			$result = $this->paste_model->getPaste();
			if($result) {
				$data['body'] = 'show';
				$data['paste'] = $result;
				$this->load->view('template', $data);
			} else {
				$data['body'] = 'error';
				$this->load->view('template', $data);
			}
		} else {
			$this->load->view('login');
		}
	}
}

/* End of file paste.php */
/* Location: ./application/controllers/pastebin.php */
