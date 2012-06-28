<div class="page-header span8">
	<h1>Confirm Delete</h1>
</div>
<div class="span8">
	<p>Are you sure you want to delete Paste?</p>
	<?php
		echo form_open('/paste/delete/'.$url);
			echo form_submit(array('name' => 'delete', 'value' => 'Yes', 'class' => 'btn btn-danger'));
		echo form_close();
	?>
</div>
