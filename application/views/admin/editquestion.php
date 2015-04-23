<script type="text/javascript">
$(document).ready(function(){
  $("#editquestionform").validationEngine();
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
		<p class="pagetittle">Ubah Pertanyaan</p>
	</div>
	<?php 
		if(isset($success))
			echo '<p id="success" class="msg done">'.$success.'</p>';
		if(isset($error))
			echo '<p id="error" class="msg error">'.$error.'</p>';
		?>
		
		<form action="" method="post" id="editquestionform">
		<table>
	    <tbody>
	    <tr>
	    <td><div class="label">Pertanyaan</div></td>
	    <td><div class="input">
	    <input type="hidden" value='<?=(isset($question)) ? $question->questionid : '' ;?>' name='questionid'/>
	    <textarea cols="50" rows="5" name="question" class="ui-corner-all input-text validate[required]" style="resize:none"><?=(isset($question)) ? $question->question : '' ;?></textarea>
	    </div></td>
	    </tr>
	      <tr>
	    <td><div class="label">Pilihan A</div></td>
	    <td><div class="input">
	    	<input type="text" name="optiona" value="<?=(isset($question)) ? $question->optiona : '' ;?>" class="ui-corner-all input-text validate[required]"><?=form_error('optiona'); ?></div></td>
	    </tr>
	      <tr>
	    <td><div class="label">Pilihan B</div></td>
	    <td><div class="input">
	    	<input type="text" name="optionb" value="<?=(isset($question)) ? $question->optionb : '' ;?>" class="ui-corner-all input-text validate[required]"><?=form_error('optionb'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Pilihan C</div></td>
	    <td><div class="input">
	    	<input type="text" name="optionc" value="<?=(isset($question)) ? $question->optionc : '' ;?>" class="ui-corner-all input-text validate[required]"><?=form_error('optionc'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Pilihan D</div></td>
	    <td><div class="input">
	    	<input type="text" name="optiond" value="<?=(isset($question)) ? $question->optiond : '' ;?>" class="ui-corner-all input-text validate[required]"><?=form_error('optiond'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Pilihan Benar</div></td>
	    <td><div class="input">
	    	<select name="correctanswer" class="input-text validate[required]">
	    	<option value="">------- Pilih Pilihan Jawaban ------</option>
	    	<option value="A" <?=(isset($question) && $question->correctanswer == 'A') ? 'selected' : '' ;?>> Pilihan A</option>
	    	<option value="B" <?=(isset($question) && $question->correctanswer == 'B') ? 'selected' : '' ;?>> Pilihan B</option>
	    	<option value="C" <?=(isset($question) && $question->correctanswer == 'C') ? 'selected' : '' ;?>> Pilihan C</option>
	    	<option value="D" <?=(isset($question) && $question->correctanswer == 'D') ? 'selected' : '' ;?>> Pilihan D</option>
	    	</select>
	    </div>

	    </td>
	    </tr>
	    <tr>
	    <td><div class="label">Pilihan</div></td>
	    <td><div class="input">
	    	<input type="text" name="marks" value="<?=(isset($question)) ? $question->marks : 1 ;?>" class="ui-corner-all input-text validate[required] custom[integer]" value="1"><?=form_error('marks'); ?>
	    </div>

	    </td>
	    </tr>
	    
	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Save Question" name="editquestionbttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>
	<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>

