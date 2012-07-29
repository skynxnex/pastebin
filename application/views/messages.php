<div id="errors" class="span8">
	<?php
	if($this->session->userdata('messages')) :
		foreach($this->session->userdata('messages') as $message) :
			if(!empty($message)) : ?>
				<div class="alert <?php echo isset($message['type']) ? $message['type'] : null; ?> fade in">
					<button class="close" data-dismiss="alert" type="button">×</button>
					<strong><?php echo isset($message['heading']) ? $message['heading'] : null; ?></strong>
					<?php echo isset($message['message']) ? $message['message'] : null; ?>
				</div>
		<?php 
			endif;
		endforeach;
		$this->session->unset_userdata('messages');
	endif;
	?>
	
</div>
