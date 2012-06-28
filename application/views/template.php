<?php 
// echo $this->uri;
$this->load->view('header');
$this->load->view('menu');
$this->load->view($body);
$this->load->view('flow');
$this->load->view('footer');
$this->session->set_userdata(array('url' => current_url()));