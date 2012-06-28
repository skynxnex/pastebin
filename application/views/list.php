<div class="page-header span8">
	<h1>My Pastes</h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/paste_date<?php echo ($this->uri->segment(4) == 'paste_date' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : '' ); ?>">Date</a></th>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/headline<?php echo ($this->uri->segment(4) == 'headline' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : '' ); ?>">Headline</a></th>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/paste<?php echo ($this->uri->segment(4) == 'paste' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : '' ); ?>">Paste</a></th>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/visibility<?php echo ($this->uri->segment(4) == 'visibility' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : '' ); ?>">Visibility</a></th>
			<th></th>
			<th></th>
		</tr>
		<?php
			foreach($pastes as $paste) {
				echo '<tr>';
				echo '<td>'.$paste->paste_date.'</td>';
				echo '<td>'.character_limiter($paste->headline, 20).'</td>';
				echo '<td>'.character_limiter(htmlentities($paste->paste), 200).'</td>';
				echo '<td>'.$paste->visibility.'</td>';
				echo '<td><a href="'.base_url().'paste/edit/'.$paste->url.'" class="btn-small btn-info">Edit</a></td>';
				echo '<td><a href="'.base_url().'paste/show/'.$paste->url.'" class="btn-small btn-primary">View</a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php 
	if(isset($pages)) { 
		echo $pages; 
	}
	?>
</div>