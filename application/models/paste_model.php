<?php

	class Paste_model extends CI_Model {
		
		function __construct() {
		    parent::__construct();
		    $this->load->database();
		}
		
		public function top() {
			$this->db->from('paste');
			$this->db->limit(10);
			$this->db->where('deleted', 0);
			$this->db->order_by('viewed', 'desc');
			$result = $this->db->get();
			return $result->result();
		}
		
		public function getRaw() {
			$this->db->join('encoding', 'encoding.id = paste.encoding_id');
			$result = $this->db->get_where('paste', array('url' => $this->uri->segment(3)));
			return $result->row();  
		}
		
		public function delete() {
			$data = array('deleted' => 1);
			$this->db->where('url', $this->uri->segment(3));
			$result = $this->db->update('paste', $data);
			return $result;
		}
		
		public function mark() {
			$data = array('viewed' => 1);
			$this->db->where('id', $this->uri->segment(3));
			$result = $this->db->update('report', $data);
			return $result;
		}
		
		public function report() {
			$data = array(
				'url'		=> $this->uri->segment(3),
				'user_id'	=> $this->session->userdata('id'),
				'viewed'	=> 0,
				'cause'		=> $this->input->post('reason')
			);
			$this->db->set('report_date', 'NOW()', FALSE);
			$result = $this->db->insert('report', $data);
			return $result;
		}
		
		public function getReports($start = null, $limit = null) {
			if($start || $limit) {
				$this->db->limit($limit, $start);
			}
			$this->db->select('report.id, report.url, report.viewed, report.cause, report.report_date, user.name');
			$this->db->join('user', 'report.user_id = user.id');
			$this->db->order_by('viewed, report_date desc, report.id desc');
			$result = $this->db->get('report');
			return $result->result();	
		}
		
		public function getPaste() {
			$this->db->select('paste.*, encoding.type, encoding.name');
			$this->db->from('paste');
			$this->db->join('encoding', 'encoding.id = paste.encoding_id');
			$this->db->where('url', $this->uri->segment(3));
			$this->db->where('deleted', 0);
			$result = $this->db->get();
			if($result) {
				$this->updateViewed($result->row());
			}
			return $result->row();
		}
		
		private function updateViewed($paste) {
			$viewed = $paste->viewed + 1;
			$data = array('viewed' => $viewed);
			$this->db->where('url', $paste->url);
			$result = $this->db->update('paste', $data);
		}
		
		public function getMypastes($start = null, $limit = null) {
			$order = $this->uri->segment(5);
			if($start !== null) {
				$this->db->limit($limit, $start);
			}
			if($this->uri->segment(3) == 'sort') {
				$this->db->order_by($this->uri->segment(4), $order);
			} else {
				$this->db->order_by('id', 'desc');			
			}
			$result = $this->db->get_where('paste', array('deleted' => 0, 'user_id' => $this->session->userdata('id')));
			return $result->result();	
		}
		
		public function create() {
			$vis = '';
			if($this->input->post('visibility') == 'public') {
				$vis = 1;
			} else {
				$vis = 0;
			}
			$result = $this->db->get_where('encoding', array('type' => $this->input->post('encoding')));
			$enc_id = $result->row()->id;
			$data = array(
				'user_id'		=> $this->session->userdata('id'),
				'headline' 		=> $this->input->post('headline'),
				'paste'			=> $this->input->post('paste'),
				'visibility'	=> $vis,
				'url' 			=> $this->urlCheck(generate_string(30)),
				'encoding_id'	=> $enc_id
			);
			$this->db->set('paste_date', 'NOW()', FALSE);
			$result = $this->db->insert('paste', $data);
			return $result;
		}
		
		private function urlCheck($url) {
			$result = $this->db->get_where('paste', array('url' => $url));
			if($result->row()) {
				$url = $this->generate_string();
				$this->urlCheck($url);
			} else {
				return $url;
			}
		}
		
		public function getLatestPastes() {
			$this->db->select('paste.headline, user.name, paste.url');
			$this->db->from('paste');
			$this->db->join('user', 'user.id = paste.user_id');
			$this->db->where('visibility', 1);
			$this->db->where('deleted', 0);
			$this->db->order_by("paste.id", "desc"); 
			$this->db->limit('10');
			$result = $this->db->get();
			return $result->result();
		}
		
		public function edit() {
			$vis = '';
			if($this->input->post('visibility') == 'public') {
				$vis = 1;
			} else {
				$vis = 0;
			}
			$result = $this->db->get_where('encoding', array('type' => $this->input->post('encoding')));
			$enc_id = $result->row()->id;
			$data = array(
				'headline' 		=> $this->input->post('headline'),
				'paste'			=> $this->input->post('paste'),
				'visibility'	=> $vis,
				'encoding_id'	=> $enc_id
			);
			
			$this->db->where('url', $this->uri->segment(3));
			$result = $this->db->update('paste', $data);
			return $result; 
		}
		
		public function getEncodings() {
			$this->db->order_by('type');
			$result = $this->db->get('encoding');
			return $result->result();
		}
		
		public function search() {
			if(substr($this->input->post('search'), 0, 1) =='"' ) {
				$this->db->or_like('paste', str_replace('"', '', $this->input->post('search')));
				$this->db->or_like('headline', str_replace('"', '', $this->input->post('search')));
			} else {
				$words = explode(' ', $this->input->post('search'));
				foreach($words as $word) {
					$this->db->or_like('paste', $word);
					$this->db->or_like('headline', $word);
				}
			}
			$this->db->having('visibility = 1');
			$this->db->limit('10');
			$this->db->order_by('id', 'desc');
			$result = $this->db->get_where('paste');
			return $result->result();
		}
		
		public function getUnreadReports() {
			$result = $this->db->get_where('report', array('viewed' => 0));
			return count($result->result());
			
		}
	}