
<div class="page-header span8">
	<h1>New Paste</h1>
</div>
<div class="span8">
	<?php
		// echo validation_errors();
		echo form_open('/paste/create', array('class' => 'form-vertical'));
			echo form_error('headline');
			echo form_label('Headline (brief description)', 'headline');
			echo form_input(array('name' => 'headline', 'class' => 'span8', 'value' => set_value('headline')));
			echo form_error('paste');
			echo form_label('Your paste', 'paste');
			echo form_textarea(array('name' => 'paste', 'class' => 'span8', 'rows' => 18, 'value' => set_value('paste')));
			echo form_label('Public', 'public');
			echo form_radio(array('name' => 'visibility', 'value' => 'public', 'checked' => 'true'));
			echo form_label('Private', 'private');
			echo form_radio(array('name' => 'visibility', 'value' => 'private'));
			echo '<br />';
			echo '<br />';
			echo form_submit(array('name' => 'save', 'value' => 'Save', 'class' => 'btn'));
		echo form_close();
	?>
</div>