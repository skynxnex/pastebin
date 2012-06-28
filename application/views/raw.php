<?php 
	$this->load->view('header');
	echo '<div class="divider"></div>';
	echo '<div class="span8">';
	echo $paste->headline;
	echo '<div class="divider"></div>';
	echo $paste->paste;
	echo '<a href="'.$this->session->userdata('url').'">&larr; Back</a>';
	echo '</div>';
	$this->load->view('footer'); 


?>