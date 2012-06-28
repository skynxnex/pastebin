<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paste extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('paste_model');
		require_once 'application/geshi/geshi.php';
		require_once "Mail.php";
	}
	
	function index() {
		if(loggedin()) {
			$data['body'] = 'main';
			$data['encodings'] = $this->paste_model->getEncodings();
			$this->load->view('template', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	
	public function sendMail() {
		$this->load->library('email');
		$settings = array(
			'smtp_host' 		=> 'send.one.com',
			'smtp_user'			=> 'info@almar.se',
			'smtp_pass'			=> 'fukten',
			'smtp_port'			=> 2525,
			'protocol'			=> 'smtp'
		);
		$this->email->initialize($settings);
		
		$this->email->from('info@almar.se', 'Admin');
		$this->email->to('pontus@almar.se');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	
		
		$this->email->send();
		
		echo $this->email->print_debugger();
		// $from = "Sandra Sender <sender@example.com>";
		// $to = "Pontus Alm <pontus@almar.se>";
		// $subject = "Hi!";
		// $body = "Hi,\n\nHow are you?";
// 		 
		// $host = "send.one.com";
		// $username = "pontus@almar.se";
		// $password = "fukten";
// 		 
		// $headers = array (	'From' => $from,
							// 'To' => $to,
		   					// 'Subject' => $subject);
		// $smtp = Mail::factory('smtp',
		   				// array (	'host' => $host,
		 						// 'auth' => true,
		 						// 'username' => $username,
		 						// 'password' => $password)
							// );
// 		 
		// $mail = $smtp->send($to, $headers, $body);
// 		 
		// if (PEAR::isError($mail)) {
			// echo("<p>" . $mail->getMessage() . "</p>");
		// } else {
			// echo("<p>Message successfully sent!</p>");
		// }
	}

	public function top() {
		if(loggedin()) {
			$result = $this->paste_model->top();
				if($result) {
					$data['pastes'] = $result;
					$data['body'] = 'top_pastes';
					$this->load->view('template', $data);
				} else {
					$data['body'] = 'error';
					$this->load->view('template', $data);				
				}
		} else {
			$this->load->view('login');
		}
	}
	
	public function raw() {
		$result = $this->paste_model->getRaw();
		if($result->visibility) {
			$geshi = new GeSHi($result->paste, $result->type);
					$result->paste = $geshi->parse_code();
			$data['paste'] = $result;
			$this->load->view('raw', $data);
			
		} else {
			$data['paste']['paste'] = 'Not a public paste!';
			$this->load->view('raw', $data);
		}
	}
	
	public function mark() {
		if(loggedin()) {
			if($this->session->userdata('admin')) {
				$result = $this->paste_model->mark();
				if($result) {
					redirect(base_url().'paste/reports', 'refresh');
				} else {
					$data['body'] = 'error';
					$data['mess'] = "Something went wrong when trying to change to viewed!";
					$this->load->view('template', $data);
				}
			} else {
				$data['body'] = 'error';
				$data['mess'] = "You don't have permission to access this page!";
				$this->load->view('template', $data);
			}
		}else {
			$this->load->view('login');
		}
	}
	
	public function reports() {
		if(loggedin()) {
			if($this->session->userdata('admin')) {
				$result = $this->paste_model->getReports();
				if($result) {
					$ppage = 15;
					$start = 0;
					
					$config['uri_segment'] = 3;
					$config['num_links'] = 8;
					$config['base_url'] = base_url().'paste/reports/';
					$config['total_rows'] = count($result);
					$config['per_page'] = $ppage;
		
					$config['full_tag_open'] = '<div class="pagination"><ul>';
					$config['full_tag_close'] = '</div></ul>';
		
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '</li>';
		
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
		
					$config['cur_tag_open'] = '<li class="active"><a>';
					$config['cur_tag_close'] = '</a></li>';
					$config['last_link'] = 'Last';
					$config['first_link'] = 'First';
					
					$this->pagination->initialize($config);
					if($this->uri->segment(3) != '') {
						$start = $this->uri->segment(3);
					}
					$data['pages'] = $this->pagination->create_links();

					$data['reports'] = $this->paste_model->getReports($start, $ppage);
					$data['body'] = 'reports';
					$this->load->view('template', $data);
					
				} else {
					$data['body'] = 'error';
					$data['mess'] = "No reports to show!";
					$this->load->view('template', $data);
				}
			} else {
				$data['body'] = 'error';
				$data['mess'] = "You don't have permission to view this page!";
				$this->load->view('template', $data);
			}
		} else {
			$this->load->view('login');
		}
	}
	
	public function delete() {
		if($this->session->userdata('admin')) {
			if($this->input->post()) {
				$result = $this->paste_model->delete();
				if($result) {
					$data['body'] = 'success';
					$this->load->view('template', $data);
				} else {
					$data['body'] = 'error';
					$this->load->view('template', $data);				
				}
			} else {
				$data['url'] = $this->uri->segment(3);
				$data['body'] = 'confirm';
				$this->load->view('template', $data);
			}
		} elseif (loggedin()) {
			$data['body'] = 'error';
			$this->load->view('template', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	public function report() {
		if(loggedin()) {
			if($this->input->post()) {
				$result = $this->paste_model->report();
				if($result) {
					$data['body'] = 'success';
					$this->load->view('template', $data);
				} else {
					$data['body'] = 'error';
					$this->load->view('template', $data);				
				}
			} else {
				$data['body'] = 'report';
				$this->load->view('template', $data);
			}
		} else {
			$this->load->view('login');
		}
	}
	
	public function search() {
		if(loggedin()) {
			$data['pastes'] = $this->paste_model->search();
			$data['body'] = 'search';
			$this->load->view('template', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	public function my() {
		if(loggedin()) {
			$ppage = 7;
			$start = 0;
			
			$config['uri_segment'] = 3;
			$config['num_links'] = 8;
			$config['base_url'] = base_url().'paste/my/';
			$config['total_rows'] = count($this->paste_model->getMyPastes());
			$config['per_page'] = $ppage;

			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</div></ul>';

			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';

			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['last_link'] = 'Last';
			$config['first_link'] = 'First';
			
			$this->pagination->initialize($config);
			if($this->uri->segment(3) != '') {
				$start = $this->uri->segment(3);
			}
			$data['pages'] = $this->pagination->create_links();
			
			$data['body'] = 'list';
			$data['pastes'] = $this->paste_model->getMyPastes($start, $ppage);
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
				$data['encodings'] = $this->paste_model->getEncodings();
				$this->load->view('template', $data);
			} else {
				$result = $this->paste_model->create();
				if($result) {
					$data['body'] = 'success';
					$this->load->view('template', $data);
				} else {
					$data['body'] = 'error';
					$data['mess'] = "Something went wrong when saving!";
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
			$result = $this->paste_model->getPaste();
			if($result) {
				if($result->encoding_id != 2) {
					$geshi = new GeSHi($result->paste, $result->type);
					$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
					// $geshi->enable_strict_mode();
					$result->paste = $geshi->parse_code();
				}
				$data['body'] = 'show';
				$data['paste'] = $result;
				$this->load->view('template', $data);
			} else {
				$data['body'] = 'error';
				$data['mess'] = "This paste does not exist!";
				$this->load->view('template', $data);
			}
		} else {
			if($this->uri->segment(3)) {
				$paste = $this->paste_model->getPaste();
				if($paste) {
					if($paste->encoding_id != 2) {
						$geshi = new GeSHi($paste->paste, $paste->type);
						$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
						$paste->paste = $geshi->parse_code();
					}
					if($paste->visibility) {
						$data['error'] = 0;
						$data['paste'] = $paste;
						$this->load->view('guest', $data);
					} else {
						$this->load->view('private');
					}
				} else {
					$data['error'] = 1;
					$this->load->view('guest', $data);
				}
			} else {
				$this->load->view('login');
			}
		}
	}
	
	public function edit() {
		if(loggedin()) {
			if($this->input->post()) {
				$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
				$this->form_validation->set_rules('headline', 'Headline', 'required');
				$this->form_validation->set_rules('paste', 'Paste', 'required');
				if ($this->form_validation->run() == FALSE) {
					$paste = $this->paste_model->getPaste();
					if($paste->user_id == $this->session->userdata('id')) {
						$data['paste'] = $paste;
						$data['encodings'] = $this->paste_model->getEncodings();
						$data['body'] = 'edit';
						$this->load->view('template', $data);
					} else {
						$data['body'] = 'error';
						$this->load->view('template', $data);
					}
				} else {
					$result = $this->paste_model->edit();
					if($result) {
						$data['body'] = 'success';
						$this->load->view('template', $data);
					} else {
						$data['body'] = 'error';
						$this->load->view('template', $data);				
					}
				}
			} else {
				$paste = $this->paste_model->getPaste();
				if($paste->user_id == $this->session->userdata('id')) {
					$data['paste'] = $paste;
					$data['encodings'] = $this->paste_model->getEncodings();
					$data['body'] = 'edit';
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
}

/* End of file paste.php */
/* Location: ./application/controllers/pastebin.php */
