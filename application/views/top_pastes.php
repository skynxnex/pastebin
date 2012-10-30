<div class="page-header span8">
	<h1>Top Snippets</h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th>Date</a></th>
			<th>Headline</a></th>
			<th>Snippet</a></th>
			<th>Viewed</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			foreach($pastes as $paste) {
				echo '<tr>';
				echo '<td>'.$paste->getDate()->format('Y-m-d').'</td>';
				echo '<td>'.character_limiter($paste->getHeadline(), 20).'</td>';
				echo '<td>'.character_limiter(htmlentities($paste->getSnippet()), 200).'</td>';
				echo '<td>'.$paste->getViewed().'</td>';
				if($paste->getUser()->getId() == $this->session->userdata('id')) {
						echo '<td><a href="'.base_url().'paste/edit/'.$paste->getId().'" class="btn-small btn-info">Edit</a></td>';
					} else {
						echo '<td></td>';
					}
				echo '<td><a href="'.base_url().'paste/show/'.$paste->getId().'" class="btn-small btn-primary">View</a></td>';
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