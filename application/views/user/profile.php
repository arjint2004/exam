
<script>
$(document).ready(function(){
  $("#regform").validationEngine();
}); 

</script>
<div class="mainholder">

	<!--Start register holder -->
	<div class="loginholder">
	<div class="logincontent ui-corner-all">
		<h1 class="w3-page-label">Edit Profile</h1>
		<?php 
		if(isset($success))
			echo '<p id="success" class="msg done">'.$success.'</p>';
		if(isset($error))
			echo '<p id="error" class="msg error">'.$error.'</p>';


		?>
		
		<form action="" method="post" id="regform">
		<table>
	    <tbody>
	      <tr>
	    <td><div class="label">Username</div></td>
	    <td>
	    	<input type="hidden" name="userid" value="<?=$userdetails->user_id;?>">
	    	<div class="input"><input type="text" name="username" value="<?=$userdetails->username;?>" readonly="readonly" style="background:#ddd" size="39" class="ui-corner-all input-text validate[required] minSize[3] maxSize[20]"><?=form_error('username'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">First Name</div></td>
	    <td><div class="input">
	    	<input type="text" name="firstname" size="39" value="<?=$userdetails->firstname;?>" class="ui-corner-all input-text validate[required]"><?=form_error('firstname'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Last Name</div></td>
	    <td><div class="input">
	    	<input type="text" name="lastname" size="39" value="<?=$userdetails->lastname;?>" class="ui-corner-all input-text validate[required]"><?=form_error('lastname'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Email</div></td>
	    <td><div class="input">
	    <input type="text" name="email" size="39" value="<?=$userdetails->email;?>" class="ui-corner-all input-text validate[required, custom[email]]"><?=form_error('email'); ?>
		</div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Password <br/><span style="font-style:italic;color:green">(Leave blank if not changing your password)</span></div></td>
	    <td><div class="input"><input type="password" name="newpassword" id="newpassword" size="39" class="ui-corner-all input-text minSize[6] maxSize[20]"><?=form_error('newpassword'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Ulangi Password</div></td>
	    <td><div class="input"><input type="password" name="confirmnewpassword" size="39" class="ui-corner-all input-text equals[newpassword]"><?=form_error('confirmnewpassword'); ?></div></td>
	    </tr>

	     <tr>
	    <td><div class="label">Masukkan Password Lama</div></td>
	    <td><div class="input"><input type="password" name="currentpassword" size="39" class="ui-corner-all input-text validate[required]"><?=form_error('currentpassword'); ?></div></td>
	    </tr>

	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Update account details" name="updateprofilebttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>
	</div>
	<!--end register holder -->
	<div class="clear">&nbsp;</div>
</div>
