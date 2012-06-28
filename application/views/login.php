<?php $this->load->view('header'); ?>
<div class="span8">
<div id="wrapper">
	<div id="login">
		<h2>Log in</h2>	
<?php
	
	$form_attributes = array('class' => 'center form-horizontal', 'id' => 'login_form');
	$button_data = array(
	    'name' => 'button',
	    'id' => 'button',
	    'value' => 'true',
	    'type' => 'login',
	    'content' => 'Log in',
	    'class' => 'btn btn-primary'
	);
	$reset_data = array(
	    'name' => 'reset',
	    'id' => 'reset',
	    'value' => 'true',
	    'type' => 'reset',
	    'content' => 'Reset',
	    'class' => 'btn'
	);
	$input_data = array(
		'name' => 'username',
	);

	echo form_open('/user/login', $form_attributes);
	echo form_error('login_error');
	echo form_fieldset();
	echo form_error('username');
	echo form_label('Username','username');
	echo form_input($input_data);
	echo '<div class="divider"></div>';
	echo form_error('password');
	echo form_label('Password','password');
	echo form_password('password');
	echo '<div class="divider"></div>';
	echo form_button($button_data);
	echo ' ';
	echo form_button($reset_data);
	echo form_fieldset_close();
	echo form_close();
	echo '<div class="divider"></div>';
	echo '<a href="'.base_url().'user/create">Create new user</a>';
	echo '<div class="divider"></div>';
	echo '<a href="'.base_url().'user/newpass">Forgotten your password?</a>';
	
?>
		</div>
	</div>
</div>
<div class="divider"></div>
<?php $this->load->view('flow'); ?>

<?php
	$this->load->view('footer');
?>