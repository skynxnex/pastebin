<div class="page-header span8">
	<h1>Reports</h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th>URL</th>
			<th>Reporter</th>
			<th>Reason</th>
			<th class="span2">Date</th>
			<th></th>
		</tr>
		<?php
			foreach($reports as $report) {
				echo '<tr>';
				echo '<td><a href="'.base_url().'paste/show/'.$report->getSnippet()->getId().'">Link</a></td>';
				echo '<td>'.$report->getUser()->getName().'</td>';
				echo '<td>'.$report->getReason().'</td>';
				echo '<td>'.$report->getReportDate()->format('Y-m-d').'</td>';
				if($report->getViewed()) {
					echo '<td></td>';
				} else {
					echo '<td><a href="'.base_url().'paste/mark/'.$report->getId().'" class="btn-small btn-info">Viewed</a></td>';
				}
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