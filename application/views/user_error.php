<?php $this->load->view('header'); ?>
<div id="wrapper">
	<div id="create">
		<h2>Error!</h2>
		<div class="alert alert-error"><p>Something went wrong when creating the user! The username or email might exist already.</p></div>
		<div class="divider"></div>
		<a href="<?php echo base_url(); ?>user/create">Create user</a>
		<div class="divider"></div>
	</div>
</div>
<?php $this->load->view('footer'); ?>