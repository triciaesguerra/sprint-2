<div>

<?php if(isset($error)) : echo $error; endif ?>
<?php if(isset($success)) : echo $success; endif ?>
<br /><?php if(isset($folder_name)): echo $folder_name; endif?>


<br />
<br />

<a>Create New Folder</a>
<br />
<br />

<div id="newfolder">
<form method="post" action="<?php echo base_url();?>/index.php/view_folder/subfolder_create">

	<input hidden name="folder_id" value="<?php if(isset($folder_id)): echo $folder_id; endif?>"></input>
	<input type="text" value="<?php set_value('fname'); ?>" name="fname" placeholder="Enter the name of your folder..."></input>
	<button type="submit" action="<?php echo base_url();?>/index.php/view_class/create_folder">Create Folder</button>


</form>
</div>



<br /><br />
<?php if(isset($folders)) : echo $folders; endif?>





</div>