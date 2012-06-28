<div class="page-header span8">
	<h1>Password change</h1>
</div>
<div class="span8">
	<?php
	echo form_open('/user/pass');
		echo form_fieldset();
		echo form_label('Password','password');
		echo form_error('password');
		echo form_password('password');
		echo form_label('Password again','password2');
		echo form_error('password2');
		echo form_password('password2');
		echo '<div class="divider"></div>';
		echo form_button(array('class' => 'btn btn-primary', 'type' => 'create', 'content' => 'Edit password'));
		echo form_fieldset_close();
		echo form_close();
	?>
</div>