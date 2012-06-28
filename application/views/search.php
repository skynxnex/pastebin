<div class="page-header span8">
	<h1>Search<small> The latest ten entries</small></h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th>Date</th>
			<th>Headline</th>
			<th>Paste</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			if(count($pastes) == 0) {
				echo '<tr><td></td><td>No searches found</td><td></td><td></td></tr>';
			} else {
				foreach($pastes as $paste) {
					echo '<tr>';
					echo '<td>'.$paste->paste_date.'</td>';
					echo '<td>'.character_limiter($paste->headline, 20).'</td>';
					echo '<td>'.character_limiter(htmlentities($paste->paste), 200).'</td>';
					if($paste->user_id == $this->session->userdata('id')) {
						echo '<td><a href="'.base_url().'paste/edit/'.$paste->url.'" class="btn-small btn-info">Edit</a></td>';
					} else {
						echo '<td></td>';
					}
					echo '<td><a href="'.base_url().'paste/show/'.$paste->url.'" class="btn-small btn-primary">View</a></td>';
					echo '</tr>';
				}
			}
		?>
	</table>
	<?php 
	if(isset($pages)) { 
		echo $pages; 
	}
	?>
</div>