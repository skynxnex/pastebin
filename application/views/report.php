<div class="page-header span8">
	<h1>Report a snippet</h1>
</div>
<div class="span8">
	<?php
	echo form_open('/paste/report/'.$this->uri->segment(3));
		echo form_fieldset();
		echo '<p>Reporting paste '.$this->uri->segment(3).'</p>';
		echo '<div class="divider"></div>';
		echo form_label('Reason','reason');
		echo form_input(array('name' => 'reason', 'class' => 'span6'));
		echo '<p><span class="label label-warning">Notice! Empty reasons will be discarded.</span></p>';
		echo '<div class="divider"></div>';
		echo form_button(array('class' => 'btn btn-primary', 'type' => 'report', 'content' => 'Report'));
		echo form_fieldset_close();
		echo form_close();
	?>
</div>