<h1><?php echo "Reset Password"; ?></h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open('/admin/user/resetpassword/' . $code);?>

	<p>
		New Password<br />
		<input type='password' name='new_password'>
	</p>

	<p>
		Confirm Password<br />
		<input type='password' name='confirm'>
		
	</p>



	<p><input type=submit></p>
	
	

<?php echo form_close();?>