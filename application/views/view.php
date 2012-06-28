<?php $this->load->view('header'); ?>

<div id="wrapper">
	<div id="login">
		<h2>Load custom view</h2>	
<?php

	echo form_open('/debugging/view');
	echo form_fieldset();
	echo form_error('view');
	echo form_label('View to see','view');
	echo form_input(array('name' => 'view'));
	echo form_label('Use template','template');
	echo form_checkbox('template', 'true', TRUE);
	echo '<div class="divider"></div>';
	echo form_button(array('class' => 'btn btn-primary', 'type' => 'create', 'content' => 'View'));
	echo ' ';
	echo form_button(array('name' => 'reset', 'id' => 'reset', 'value' => 'true', 'type' => 'reset', 'content' => 'Reset', 'class' => 'btn'));
	echo form_fieldset_close();
	echo form_close();
	echo '<div class="divider"></div>';
?>
	</div>
</div>

<?php $this->load->view('footer'); ?>