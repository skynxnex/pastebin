<div class="page-header span8">
	<h1>My Snippets</h1>
</div>
<div class="span8">
	<table class="table table-striped">
		<tr>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/paste_date<?php echo($this->uri->segment(4) == 'paste_date' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : ''); ?>">Date</a></th>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/headline<?php echo($this->uri->segment(4) == 'headline' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : ''); ?>">Headline</a></th>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/paste<?php echo($this->uri->segment(4) == 'paste' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : ''); ?>">Snippet</a></th>
			<th><a href="<?php echo base_url(); ?>paste/my/sort/visibility<?php echo($this->uri->segment(4) == 'visibility' ? ($this->uri->segment(5) == 'desc' ? '' : '/desc') : ''); ?>">Visibility</a></th>
			<th></th>
			<th></th>
		</tr>
		<?php
    if (isset($pastes)) {
      foreach ($pastes as $paste) {
        echo '<tr>';
        echo '<td>' . $paste->getDate()->format('Y-m-d') . '</td>';
        echo '<td>' . character_limiter($paste->getHeadline(), 20) . '</td>';
        echo '<td>' . character_limiter(htmlentities($paste->getSnippet()), 200) . '</td>';
        echo '<td>' . $paste->getVisibility() . '</td>';
        echo '<td><a href="' . base_url() . 'paste/edit/' . $paste->getId() . '" class="btn-small btn-info">Edit</a></td>';
        echo '<td><a href="' . base_url() . 'paste/show/' . $paste->getId() . '" class="btn-small btn-primary">View</a></td>';
        echo '</tr>';
      }
    }
		?>
	</table>
	<?php
  if (isset($pages)) {
    echo $pages;
  }
?>
</div>