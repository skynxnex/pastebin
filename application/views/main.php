<div class="page-header span8">
	<h1>New Snippet</h1>
</div>
<div class="span8">
	<?php
  $enc = array();
  foreach ($encodings as $encoding) {
    $enc[$encoding->getId()] = $encoding->getName();
  }
  // echo validation_errors();
  echo form_open('/paste/create', array('class' => 'form-vertical'));
  echo form_error('headline');
  echo form_label('Headline (brief description)', 'headline');
  echo form_input(array(
    'name' => 'headline',
    'class' => 'span8',
    'value' => set_value('headline')
  ));
  echo form_error('paste');
  echo form_label('Your paste', 'paste');
  echo form_textarea(array(
    'id' => 'thepaste',
    'name' => 'paste',
    'class' => 'span8',
    'rows' => 18,
    'value' => set_value('paste')
  ));
  echo '<div class="span3">';
  // echo '<div class="btn-group" data-toggle="buttons-radio">';
  echo form_label('Public', 'public');
  echo form_radio(array(
    'class' => 'hoover',
    'name' => 'visibility',
    'value' => 'public',
    'checked' => 'true',
    'data-content' => 'Everyone can see your snippet even if not logged in.',
    'data-title' => 'Public'
  ));
  echo form_label('Private', 'private');
  echo form_radio(array(
    'class' => 'hoover',
    'name' => 'visibility',
    'value' => 'private',
    'data-content' => 'No one but you can see your snippet. Can be edited later.',
    'data-title' => 'Private!'
  ));
  echo '</div>';
  echo '<div class="span3">';
  echo form_label('Encoding', 'encoding');
  echo form_dropdown('encoding', $enc, 'text');
  echo '</div>';
  echo '<div class="span1">';
  echo '<br />';
  echo form_submit(array(
    'id' => 'btn_save',
    'name' => 'save',
    'value' => 'Save',
    'class' => 'btn-large btn-success hoover',
    'data-content' => 'Make sure the encoding is correct and that you have chosen for your snippet to be either public or private.',
    'data-original-title' => 'To Save!'
  ));
  echo '</div>';

  echo form_close();
	?>
</div>
