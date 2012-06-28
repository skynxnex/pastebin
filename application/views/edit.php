<div class="page-header span8">
	<h1>Update your Paste</h1>
</div>
<div class="span8">
	<?php
		$enc = array();
		foreach($encodings as $encoding) {
			$enc[$encoding->type] = $encoding->name;
		}
		echo form_open('/paste/edit/'.$paste->url, array('class' => 'form-vertical'));
			echo form_error('headline');
			echo form_label('Headline (brief description)', 'headline');
			echo form_input(array('name' => 'headline', 'class' => 'span8', 'value' => $paste->headline));
			echo form_error('paste');
			echo form_label('Your paste', 'paste');
			echo form_textarea(array('name' => 'paste', 'class' => 'span8', 'rows' => 18, 'value' => $paste->paste));			
			echo '<div class="span3">';
			echo form_label('Public', 'public');
			if($paste->visibility) {
				echo form_radio(array('name' => 'visibility', 'value' => 'public', 'checked' => TRUE));
			} else {
				echo form_radio(array('name' => 'visibility', 'value' => 'public'));				
			}
			echo form_label('Private', 'private');
			if(!$paste->visibility) {
				echo form_radio(array('name' => 'visibility', 'value' => 'private', 'checked' => TRUE));
			} else {
				echo form_radio(array('name' => 'visibility', 'value' => 'private'));
			}
			echo '</div>';
			echo '<div class="span3">';
			echo form_label('Encoding', 'encoding');
			echo form_dropdown('encoding', $enc, $paste->type);
			echo '</div>';
			echo '<div class="span1">';
			echo '<br />';
			echo form_submit(array('name' => 'update', 'value' => 'Update', 'class' => 'btn btn-primary'));
			echo '</div>';
		echo form_close();
		echo '<div class="span8">';
		echo '<div class="divider"></div>';
		echo '<a href="'.$this->session->userdata('url').'">&larr; Back</a></div>';
	?>
</div>