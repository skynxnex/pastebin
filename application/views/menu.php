<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand">Codesnippets</a>
			<ul class="nav">
				<li class="divider-vertical"></li>
				<li><a href="<?php echo base_url(); ?>">New codesnippet</a></li>
				<li><a href="<?php echo base_url(); ?>paste/my">My snippets</a></li>
				<li><a href="<?php echo base_url(); ?>paste/top">Top snippets</a></li>
				<li><a href="<?php echo base_url(); ?>user/profile">Profile</a></li>
				<?php
					if($this->session->userdata('admin')) {
						$count = unreadReports();
						if($count <=0) {
							echo '<li><a href="'.base_url().'paste/reports">Reports <span class="label label-success"> '.unreadReports().'</span></a></li>';
						} elseif($count <= 9) {
							echo '<li><a href="'.base_url().'paste/reports">Reports <span class="label label-warning"> '.unreadReports().'</span></a></li>';
						} else {
							echo '<li><a href="'.base_url().'paste/reports">Reports <span class="label label-important"> '.unreadReports().'</span></a></li>';
						}
					}
				?>
				<li class="divider-vertical"></li>
				<li><span class="navbar-text">Logged in as: <?php echo $this->session->userdata('name') ?></span></li>
				<li class="divider-vertical"></li>
				<li><img id="pic" src="http://www.gravatar.com/avatar/<?php echo $this->session->userdata('gravatar'); ?>?d=mm" alt="" /></li>
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
<div class="push-down"></div>