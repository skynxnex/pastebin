<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debugging extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function view() {
		if($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
			$this->form_validation->set_rules('view', 'View', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('view');				
			} else {
				if($this->input->post('template') == 'true') {
					$data['body'] = $this->input->post('view');
					$this->load->view('template', $data);
				} else {
					$this->load->view($this->input->post('view'));
				}
			}
		} else {
			$this->load->view('view');
		}
	}
	
	public function cookie() {
		echo get_cookie('paste_username', TRUE);
		echo $this->input->cookie('paste_password', TRUE);
	}
}

/* End of file debugging.php */
/* Location: ./application/controllers/debugging.php */
