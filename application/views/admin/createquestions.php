<script type="text/javascript">
$(document).ready(function(){
  $("#createquestionform").validationEngine();
}); 

</script>
<style type="text/css">
.input-text {
width: 30em;
}
</style>
<div class="mainholder">

	<div class="content ui-corner-all">
	<div class="createnewdiv">
		<p class="pagetittle">Buat Pertanyaan</p>
	</div>
	<?php 
		if(isset($success))
			echo '<p id="success" class="msg done">'.$success.'</p>';
		if(isset($error))
			echo '<p id="error" class="msg error">'.$error.'</p>';
		?>
		
		<form action="" method="post" id="createquestionform">
		<table>
	    <tbody>
	    <tr>
	    <td><div class="label">Pertanyaan</div></td>
	    <td><div class="input">
	    	<input type="hidden" value='<?=(isset($examid)) ? $examid : '' ;?>' name='examid'/>
	    	<textarea cols="50" rows="5" name="question" class="ui-corner-all input-text validate[required]" style="resize:none"></textarea>
	    </div></td>
	    </tr>
	      <tr>
	    <td><div class="label">Pilihan A</div></td>
	    <td><div class="input">
	    	<input type="text" name="optiona" class="ui-corner-all input-text validate[required]"><?=form_error('optiona'); ?></div></td>
	    </tr>
	      <tr>
	    <td><div class="label">Pilihan B</div></td>
	    <td><div class="input">
	    	<input type="text" name="optionb" class="ui-corner-all input-text validate[required]"><?=form_error('optionb'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Pilihan C</div></td>
	    <td><div class="input">
	    	<input type="text" name="optionc" class="ui-corner-all input-text validate[required]"><?=form_error('optionc'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Pilihan D</div></td>
	    <td><div class="input">
	    	<input type="text" name="optiond" class="ui-corner-all input-text validate[required]"><?=form_error('optiond'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Correct Answer</div></td>
	    <td><div class="input">
	    	<select name="correctanswer" class="input-text validate[required]">
	    	<option value="">------- Pilih Jawaban ------</option>
	    	<option value="A"> Pilihan A</option>
	    	<option value="B"> Pilihan B</option>
	    	<option value="C"> Pilihan C</option>
	    	<option value="D"> Pilihan D</option>
	    	</select>
	    </div>

	    </td>
	    </tr>
	    <tr>
	    <td><div class="label">Jawaban</div></td>
	    <td><div class="input">
	    	<input type="text" name="marks" class="ui-corner-all input-text validate[required] custom[integer]" value="1"><?=form_error('marks'); ?>
	    </div>

	    </td>
	    </tr>
	    
	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Save Question" name="savequestionbttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>
	<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>

