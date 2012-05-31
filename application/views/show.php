<div class="page-header span8">
	<h1>A Paste</h1>
</div>
<div class="span8">
	<h2><?php echo $paste->headline; ?></h2>
	<p><?php echo $paste->paste; ?></p>
	<?php
		if($paste->visibility == 1) {
			echo '<p>Public URL: <a href="'.base_url().'paste/show/'.$paste->url.'">'.base_url().'paste/show/'.$paste->url.'</a>';
		}
	?>	
</div>
