<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php //echo form_open_multipart('upload/do_upload');?>
<form id="registerForm" name="registrationform" action="<?php echo base_url(). 'upload/asd'; ?>" method="post" enctype="multipart/form-data">

	<input type="file" name="userfile" size="20" />

	<input type="file" name="userfile2" size="20" />

	<br /><br />

	<input type="submit" value="upload" />

</form>

</body>
</html>