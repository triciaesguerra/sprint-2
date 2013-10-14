<h1>Create Account</h1>


<fieldset>
	<legend>Personal Information</legend>

	
	<?php
	echo form_open('login/create_member');
	echo form_input('first_name', '','placeholder="First Name"');
	echo form_input('last_name', '','placeholder="Last Name"');
	echo form_input('student_num', '','placeholder="Student Number"');
	echo form_input('email_address', '','placeholder="Email Address"');
	?>
	<p>Usertype: 
		<?php $option = array(
							'' => '---',
							'admin' => 'Admin',
							'instructor' => 'Instructor',
							'student' => 'Student'
			); 
		echo form_dropdown('usertype',$option,'');

		?>
	</p>
</fieldset>

<fieldset>
	<legend>Login Info</legend>

	<?php
	echo form_input('username', '','placeholder="Username"');
	echo form_password('password', '','placeholder="Password"');
	echo form_password('password2', '','placeholder="Password Confirmation"');

	echo form_submit('submit', 'Create Account');
	?>
	<?php echo validation_errors('<p class="error">');?>

</fieldset>



