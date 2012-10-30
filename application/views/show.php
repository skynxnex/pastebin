<div class="page-header span8">
	<h1>A Snippet
		<a href="<?php echo base_url(); ?>paste/report/<?php echo $paste->getId() ?>" class="btn-small btn-danger pull-right">Report</a>
	</h1>
</div>
<div class="span8">
	<a href="<?php echo base_url(); ?>paste/raw/<?php echo $paste->getId(); ?>" class="pull-right"><span class="label">raw</span></a>
	<a href="#" class="pull-right"><span class="label">copy</span></a>
	<h2><?php echo $paste->getHeadline(); ?></h2>
	<div class="divider"></div>
	<div id="paste"><?php echo $paste->getSnippet(); ?></div>
	<?php echo '<p>Type: '.$paste->getEncoding()->getName().'</p>'; ?>
	<p>Date: <?php echo $paste->getDate()->format( 'Y-m-d' ); ?></p>
	<div class="divider"></div>
	<div class="well">
		
	<?php
		if($paste->getVisibility() == 1) {
			echo '<p>Public URL: <a href="'.base_url().'paste/show/'.$paste->getId().'">'.base_url().'paste/show/'.$paste->getId().'</a>';
		}
		echo '</div>';
		if($paste->getUser()->getId() == $this->session->userdata('id')) {
			echo '<div class="divider"></div>';
			echo '<a href="'.base_url().'paste/edit/'.$paste->getId().'" class="btn btn-info">Edit</a>';
		}
		if($this->session->userdata('admin')) {
			echo ' ';
			echo '<a href="'.base_url().'paste/delete/'.$paste->getId().'" class="btn btn-danger">Delete</a>';			
		}
	?>
	
	
</div>
