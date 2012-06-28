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
		
		public function update() {
			$data = array(
				'name' 			=> $this->input->post('name'),
				'user_name'		=> $this->input->post('username')
			);
			$this->db->where('id', $this->session->userdata('id'));
			$result = $this->db->update('user', $data);
			if($result) {
				$this->session->set_userdata(array('name' => $this->input->post('name')));
			}
			return $result;
		}
		
		public function passUpdate() {
			$data = array('password' => do_hash($this->input->post('password')));
			$this->db->where('id', $this->session->userdata('id'));
			$result = $this->db->update('user', $data);
			return $result;
		}
		
		private function dologin() {
			$this->db->where('user_name', $this->input->post('username'));
			$this->db->where('active', 1);
			$result = $this->db->get('user');
			if($result->num_rows()) {
				$str = do_hash($this->input->post('password'));
				if($result->row()->password == $str) {
					$this->session->set_userdata(array(
						'user' 		=> 1, 
						'id' 		=> $result->row()->id, 
						'name' 		=> $result->row()->name, 
						'gravatar' 	=>  md5( strtolower( trim($result->row()->email))))
					);
					if($result->row()->admin == 1) {
						$this->session->set_userdata(array('admin' => 1));
					}
					$username_cookie = array(
					    'name'   => 'username',
					    'value'  => $result->row()->user_name,
					    'expire' => '86500',
					    'domain' => 'localhost',
					    'path'   => '/',
					    'prefix' => 'paste_',
					    'secure' => FALSE
					);
					$password_cookie = array(
					    'name'   => 'password',
					    'value'  => $result->row()->password,
					    'expire' => '86500',
					    'domain' => 'localhost',
					    'path'   => '/',
					    'prefix' => 'paste_',
					    'secure' => FALSE
					);
					
					$this->input->set_cookie($username_cookie);
					$this->input->set_cookie($password_cookie);
					return true;
				}
				return false;
			}
			return false;
		}
		
		public function createUser() {
			$result = $this->db->get_where('user', array('user_name' => $this->input->post('username')));
			if($result->row()) {
				return false;
			}
			$result = $this->db->get_where('user', array('email' => $this->input->post('email')));
			if($result->row()) {
				return false;
			}
			$data = array(
				'name' 				=> $this->input->post('name'),
				'user_name'			=> $this->input->post('username'),
				'password'			=> do_hash($this->input->post('password')),
				'email'				=> $this->input->post('email'),
				'active'			=> 1,
				'activation_code'	=> generate_string(30)
			);
			$result = $this->db->insert('user', $data);
			return $result;
		}

		public function getProfile() {
			$result = $this->db->get_where('user', array('id' => $this->session->userdata('id')));
			return $result->row();
		}
	}