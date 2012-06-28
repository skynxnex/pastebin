<?php $this->load->view('header'); ?>

<div class="page-header span8">
	<h1>A Paste</h1>
</div>
<div class="span8">
	<div class="alert alert-error"><h2>This paste is private and cannot be seen.</h2></div>
	<div class="divider"></div>
	<div class="well"><p>To make your own pastes, login <a href="<?php echo base_url(); ?>">here</a> or create a new account <a href="<?php echo base_url(); ?>user/create ">here</a>.</p></div>
</div>



<?php $this->load->view('footer'); ?>