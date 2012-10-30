<?php $this->load->view('header'); ?>

	<?php
	if(!$error) {
	?>
	<div class="page-header span8">
		<h1>A Snippet</h1>
	</div>
	<div class="span8">
		<a href="<?php echo base_url(); ?>paste/raw/<?php echo $paste->getId(); ?>" class="pull-right"><span class="label">raw</span></a>
	<h2><?php echo $paste->getHeadline(); ?></h2>
	<div class="divider"></div>
	<div id="paste"><?php echo $paste->getSnippet(); ?></div>
	<div class="divider"></div>
	<div class="well"><p>To make your own snippets, login <a href="<?php echo base_url(); ?>">here</a> or create a new account <a href="<?php echo base_url(); ?>user/create ">here</a>.</p></div>
</div>
	
	<?php	
	} else {
		$this->load->view('error');
	}
	?>

<?php $this->load->view('flow'); ?>

<?php $this->load->view('footer'); ?>