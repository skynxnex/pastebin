<?php $this->load->view('header'); ?>
<div id="wrapper">
	<div id="create">
		<h1>Create user</h1>
		<?php
		echo '<div class="divider"></div>';
		echo form_open('/user/create');
		echo form_fieldset();
		echo form_label('Name','name');
		echo form_error('name');
		echo form_input(array('name' => 'name', 'value' => set_value('name')));
		echo form_label('Username','username');
		echo form_error('username');
		echo form_input(array('name' => 'username', 'value' => set_value('username')));
		echo form_label('Email','email');
		echo form_error('email');
		echo form_input(array('name' => 'email', 'value' => set_value('email')));
		echo form_label('Password','password');
		echo form_error('password');
		echo form_password('password');
		echo form_label('Password again','password2');
		echo form_error('password2');
		echo form_password('password2');
		if(isset($cap_error)) {
			echo '<p class="label label-important">Incorrect Captcha</p>';
		}
		echo $cap;
		echo '<div class="divider"></div>';
		echo form_button(array('class' => 'btn btn-primary', 'type' => 'create', 'content' => 'Create'));
		echo ' ';
		echo form_button(array('name' => 'reset', 'id' => 'reset', 'value' => 'true', 'type' => 'reset', 'content' => 'Reset', 'class' => 'btn'));
		echo form_fieldset_close();
		echo form_close();
		echo '<div class="divider"></div>';
		echo '<a href="'.base_url().'">Already a user?</a>';
		echo '<div class="divider"></div>';
		?>
	</div>
</div>
<?php $this->load->view('footer'); ?>