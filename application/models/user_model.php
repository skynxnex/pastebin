<?php

	class User_model extends CI_Model {
		
		function __construct() {
		    parent::__construct();
		    $this->load->database();
		}
		
		public function login() {
			if($this->dologin()) {
				return true;
			} else {
				return false;
			}
		}
		
		private function dologin() {
			$result = $this->db->get_where('user', array('user_name' => $this->input->post('username')));
			$str = do_hash($this->input->post('password'));
			if($result->row()->password == $str) {
				$this->session->set_userdata(array('user' => 1, 'id' => $result->row()->id, 'name' => $result->row()->name));
				return true;
			}
			return false;
		}
		
		public function saveUser() {
			
		}
	}