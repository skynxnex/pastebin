<div class="page-header span8">
	<h1>Message</h1>
</div>
<div class="span8">
	<?php
		if(isset($mess)) { ?>
		<div class="alert alert-error"><p><?php echo $mess; ?></p></div>
			
		<?php }  else { ?>			
		<div class="alert alert-error"><p>Error!</p></div>
		<?php }
	?>
</div>