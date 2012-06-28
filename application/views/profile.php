<div class="page-header span8">
	<h1>Profile</h1>
</div>
<div class="span8">
	<?php
	echo form_open('/user/profile');
		echo form_fieldset();
		echo form_label('Name','name');
		echo form_error('name');
		echo form_input(array('name' => 'name', 'class' => '', 'value' => $profile->name));
		echo form_label('Username','username');
		echo form_error('username');
		echo form_input(array('name' => 'username', 'class' => '', 'value' => $profile->user_name));
		echo form_label('Email','email');
		echo form_error('email');
		echo form_input(array('name' => 'email', 'class' => 'uneditable-input', 'value' => $profile->email));
		echo '<div class="divider"></div>';
		echo form_button(array('class' => 'btn btn-primary', 'type' => 'create', 'content' => 'Edit profile'));
		echo form_fieldset_close();
		echo form_close();
	?>
	<a href="<?php echo base_url(); ?>user/pass" class="btn btn-warning">Change password</a>
</div>