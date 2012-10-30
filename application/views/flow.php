<div class="span3">
	<h2>Latest snippets</h2>

	<?php
  $data = flow();
  if ($data) {
    foreach ($data as $paste) {
      echo '<div>';
      echo '<h4>' . character_limiter($paste->getHeadline(), 40) . '</h4>';
      echo 'By <small>' . $paste->getUser()->getName() . '</small>';
      echo '<p><a href="' . base_url() . 'paste/show/' . $paste->getId() . '">View ...</a></p>';

      echo '</div>';
    }
  }
?>
</div>