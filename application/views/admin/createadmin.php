<script>
$(document).ready(function(){
  $("#regform").validationEngine();
}); 

</script>
<div class="mainholder">

	<div class="content ui-corner-all">
	<div class="createnewdiv">
		<p class="pagetittle">Buat Akun Administrator</p>
	</div>
	<?php 
		if(isset($success))
			echo '<p id="success" class="msg done">'.$success.'</p>';
		if(isset($error))
			echo '<p id="error" class="msg error">'.$error.'</p>';
		?>
		
		<form action="" method="post" id="regform">
		<table>
	    <tbody><tr>
	    <td><div class="label">Nama Depan</div></td>
	    <td><div class="input">
	    	<input type="text" name="firstname" value="<?php if(isset($reset)) echo ($reset) ? "" : set_value('firstname'); ?>" class="ui-corner-all input-text validate[required]"><?=form_error('firstname'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Nama Belakang</div></td>
	    <td><div class="input">
	    	<input type="text" name="lastname" value="<?php if(isset($reset)) echo ($reset) ? "" : set_value('lastname'); ?>" class="ui-corner-all input-text validate[required]"><?=form_error('lastname'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Email</div></td>
	    <td><div class="input">
	    <input type="text" name="email" value="<?php if(isset($reset)) echo ($reset) ? "" : set_value('email'); ?>" class="ui-corner-all input-text validate[required, custom[email]]"><?=form_error('email'); ?>
		</div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Username</div></td>
	    <td><div class="input"><input type="text"  value="<?php if(isset($reset)) echo ($reset) ? "" : set_value('username'); ?>" name="username" size="39" class="ui-corner-all input-text validate[required] minSize[3] maxSize[20]"><?=form_error('username'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Password</div></td>
	    <td><div class="input"><input type="password" name="password" id="password" class="ui-corner-all input-text validate[required] minSize[6] maxSize[20]"><?=form_error('password'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Ulangi Password</div></td>
	    <td><div class="input"><input type="password" name="confirmpassword" class="ui-corner-all input-text validate[required] equals[password]"><?=form_error('confirmpassword'); ?></div></td>
	    </tr>
	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Create Admin account" name="createadminbttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>
	<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>