<div class="span3">
	<h2>Latest pastes</h2>

<?php
	foreach(flow() as $paste) {
		echo '<div>';
		echo '<h4>'.character_limiter($paste->headline, 40).'</h4>';
		echo 'By <small>'.$paste->name.'</small>';
		echo '<p><a href="'.base_url().'paste/show/'.$paste->url.'">View all</a></p>';
		
		echo '</div>';
	}

?>
</div>