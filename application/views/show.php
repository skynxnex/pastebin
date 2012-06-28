<div class="page-header span8">
	<h1>A Paste
		<a href="<?php echo base_url(); ?>paste/report/<?php echo $paste->url ?>" class="btn-small btn-danger pull-right">Report</a>
	</h1>
</div>
<div class="span8">
	<a href="<?php echo base_url(); ?>paste/raw/<?php echo $paste->url; ?>" class="pull-right"><span class="label">raw</span></a>
	<a href="#" class="pull-right"><span class="label">copy</span></a>
	<h2><?php echo $paste->headline; ?></h2>
	<div class="divider"></div>
	<div id="paste"><?php echo $paste->paste; ?></div>
	<?php echo '<p>Type: '.$paste->name.'</p>'; ?>
	<p>Date: <?php echo $paste->paste_date; ?></p>
	<div class="divider"></div>
	<div class="well">
		
	<?php
		if($paste->visibility == 1) {
			echo '<p>Public URL: <a href="'.base_url().'paste/show/'.$paste->url.'">'.base_url().'paste/show/'.$paste->url.'</a>';
		}
		echo '</div>';
		if($paste->user_id == $this->session->userdata('id')) {
			echo '<div class="divider"></div>';
			echo '<a href="'.base_url().'paste/edit/'.$paste->url.'" class="btn btn-info">Edit</a>';
		}
		if($this->session->userdata('admin')) {
			echo ' ';
			echo '<a href="'.base_url().'paste/delete/'.$paste->url.'" class="btn btn-danger">Delete</a>';			
		}
	?>
	
	
</div>
