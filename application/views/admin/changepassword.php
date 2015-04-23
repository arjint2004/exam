
<script>
$(document).ready(function(){
  $("#regform").validationEngine();
}); 

</script>
<div class="mainholder">
	<div class="content ui-corner-all">
		<div class="createnewdiv">
		<p class="pagetittle">Ubah Password</p>
		</div>

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
	    	<input type="hidden" name="adminid" value="<?=(isset($adminid)) ? $adminid : '' ;?>">
	    	<div class="input"><input type="text" name="username" value="<?=(isset($adminusername)) ? $adminusername : '';?>" readonly="readonly" style="background:#ddd" class="ui-corner-all input-text validate[required] minSize[3] maxSize[20]"><?=form_error('username'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Password Baru</div></td>
	    <td><div class="input"><input type="password" name="newpassword" id="newpassword" class="ui-corner-all input-text validate[required] minSize[6] maxSize[20]"><?=form_error('newpassword'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Ulangi Password Baru</div></td>
	    <td><div class="input"><input type="password" name="confirmnewpassword" class="ui-corner-all input-text validate[required] equals[newpassword]"><?=form_error('confirmnewpassword'); ?></div></td>
	    </tr>

	     <tr>
	    <td><div class="label">Masukkan Password baru untuk mengkonfirmasi perubahan</div></td>
	    <td><div class="input"><input type="password" name="currentpassword" class="ui-corner-all input-text validate[required]"><?=form_error('currentpassword'); ?></div></td>
	    </tr>

	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Change Password" name="changepasswordbttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>

	<div class="sidebarmenu">
	<?php $this->load->view('admin/sidebarmenu');?>
	</div>
</div>
