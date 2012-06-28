<div class="page-header span8">
	<h1>Reports</h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th>URL</th>
			<th>Reporter</th>
			<th>Cause</th>
			<th class="span2">Date</th>
			<th></th>
		</tr>
		<?php
			foreach($reports as $report) {
				echo '<tr>';
				echo '<td><a href="'.base_url().'paste/show/'.$report->url.'">Link</a></td>';
				echo '<td>'.$report->name.'</td>';
				echo '<td>'.$report->cause.'</td>';
				echo '<td>'.$report->report_date.'</td>';
				if($report->viewed) {
					echo '<td></td>';
				} else {
					echo '<td><a href="'.base_url().'paste/mark/'.$report->id.'" class="btn-small btn-info">Viewed</a></td>';
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