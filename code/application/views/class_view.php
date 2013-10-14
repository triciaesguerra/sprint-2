<div>


	<?php if($this->session->userdata('usertype')=='instructor'): ?>
<fieldset>	
	<?php if(isset($message)) : echo $message; endif ?>

	

	<h1>Create Class</h1>
	<?php
		echo form_open('classes/create_class');
		echo form_dropdown('course_id', $courselist);
		
		echo form_input('section','','placeholder="Section"');
		//echo form_input('prof_id', set_value('prof_id', 'Instructor\'s ID'));
		echo form_submit('submit', 'Create Class');
	?>
	<?php echo validation_errors('<p class="error">');?>


</fieldset>	
	
	<h1>Created Classes</h1>
	<center><?php if(isset($classes)) : echo $classes; endif ?></center>
	<?php endif; ?>

	<h1>Class List</h1>
	<?php if($this->session->userdata('usertype')=='student'): ?>
	<center><?php if(isset($enroll)) : echo $enroll; endif ?></center>
	

	<?php endif; ?>

</div>