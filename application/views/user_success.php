<?php $this->load->view('header'); ?>
<div id="wrapper">
	<div id="create">
		<h2>Success!</h2>
		<div class="alert alert-success"><p>User is created. You can now log in!</p></div>
		<a href="<?php echo base_url(); ?>">Log in</a>
		<div class="divider"></div>
	</div>
</div>
<?php $this->load->view('footer'); ?>