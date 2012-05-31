<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand">Paste in the bin</a>
			<ul class="nav">
				<li class="divider-vertical"></li>
				<li><a href="<?php echo base_url(); ?>">New paste</a></li>
				<li><a href="<?php echo base_url(); ?>paste/my">My pastes</a></li>
				<li><a href="<?php echo base_url(); ?>user/profile">Profile</a></li>
				<li class="divider-vertical"></li>
				<li><span class="navbar-text">Inloggad som: <?php echo $this->session->userdata('name') ?></span></li>
				<li class="divider-vertical"></li>
			<?php
				echo '<li>';
				echo form_open('/paste/search', array('class' => 'navbar-search'));
					echo form_input(array('class' => 'search-query', 'name' => 'search', 'placeholder' => 'Search'));
				echo form_close();
				echo '</li></ul>';
				echo form_open('/user/logout', array('id' => 'logoutbutton', 'class' => 'pull-right navbar-search'));
					echo form_submit(array('name' => 'logout', 'value' => 'Log out', 'class' => 'btn btn-info'));
				echo form_close();
			?>
		</div>
	</div>
</div>