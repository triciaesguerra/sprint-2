<div>

<?php if(isset($error)) : echo $error; endif ?>
<?php if(isset($success)) : echo $success; endif ?>
<br /><?php if(isset($class_name)): echo $class_name; endif?>

<?php if($this->session->userdata('usertype')=='instructor'): ?>
<br />
<br />

<a>Create New Folder</a>
<br />
<br />

<div id="newfolder">
<form method="post" action="<?php echo base_url();?>/index.php/view_class/create_folder">

	<input hidden name="class_id" value="<?php if(isset($class_id)): echo $class_id; endif?>"></input>
	<input type="text" value="<?php set_value('folder_name'); ?>" name="folder_name" placeholder="Enter the name of your folder..."></input>
	<button type="submit" action="<?php echo base_url();?>/index.php/view_class/create_folder">Save</button>


</form>

<a>Enlist Student</a>
<br />
<br />

<div>
<form method="post" action="<?php echo base_url();?>/index.php/view_class/enlist">

	<input hidden name="class_id" value="<?php if(isset($class_id)): echo $class_id; endif?>"></input>
	<input type="text" value="<?php set_value('student_num'); ?>" name="student_num" placeholder="Student Number e.g. 201312345"></input>
	<button type="submit" action="<?php echo base_url();?>/index.php/view_class/enlist">Enlist</button>


</form>




</div>


<?php endif ?>

<br /><br />

<?php if(isset($folders)) : echo $folders; endif?>





</div>