<div class="page-header span8">
	<h1>Top Pastes</h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th>Date</a></th>
			<th>Headline</a></th>
			<th>Paste</a></th>
			<th>Viewed</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			foreach($pastes as $paste) {
				echo '<tr>';
				echo '<td>'.$paste->paste_date.'</td>';
				echo '<td>'.character_limiter($paste->headline, 20).'</td>';
				echo '<td>'.character_limiter(htmlentities($paste->paste), 200).'</td>';
				echo '<td>'.$paste->viewed.'</td>';
				if($paste->user_id == $this->session->userdata('id')) {
						echo '<td><a href="'.base_url().'paste/edit/'.$paste->url.'" class="btn-small btn-info">Edit</a></td>';
					} else {
						echo '<td></td>';
					}
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