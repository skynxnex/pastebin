<?php

	class Paste_model extends CI_Model {
		
		function __construct() {
		    parent::__construct();
		    $this->load->database();
		}
		
		public function getPaste() {
			$result = $this->db->get_where('paste', array('url' => $this->uri->segment(3)));
			return $result->row();
		}
		
		public function create() {
			$vis = '';
			if($this->input->post('visibility') == 'public') {
				$vis = 1;
			} else {
				$vis = 0;
			}
			$data = array(
				'user_id'		=> 1,
				'headline' 		=> $this->input->post('headline'),
				'paste'			=> $this->input->post('paste'),
				'visibility'	=> $vis,
				'url' 			=> $this->urlCheck($this->generateString())
			);
			$result = $this->db->insert('paste', $data);
			return $result;
		}
		
		private function urlCheck($url) {
			$result = $this->db->get_where('paste', array('url' => $url));
			if($result->row()) {
				$url = $this->generateString();
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
			$this->db->order_by("paste.id", "desc"); 
			$this->db->limit('10');
			$result = $this->db->get();
			return $result->result();
		}
		
		private function generateString($length = 8) {

		    // start with a blank password
		    $password = "";
		
		    // define possible characters - any character in this string can be
		    // picked for use in the password, so if you want to put vowels back in
		    // or add special characters such as exclamation marks, this is where
		    // you should do it
		    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
		
		    // we refer to the length of $possible a few times, so let's grab it now
		    $maxlength = strlen($possible);
		  
		    // check for length overflow and truncate if necessary
		    if ($length > $maxlength) {
		      $length = $maxlength;
		    }
			
		    // set up a counter for how many characters are in the password so far
		    $i = 0; 
		    
		    // add random characters to $password until $length is reached
		    while ($i < $length) { 
		
		      // pick a random character from the possible ones
		      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
		        
		      // have we already used this character in $password?
		      if (!strstr($password, $char)) { 
		        // no, so it's OK to add it onto the end of whatever we've already got...
		        $password .= $char;
		        // ... and increase the counter by one
		        $i++;
		      }
		
		    }
		
		    // done!
		    return $password;
		
		  }
		
	}