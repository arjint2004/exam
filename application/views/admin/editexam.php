  <script type="text/javascript">
  $(function() {
    $( "#availablefrom" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      dateFormat: 'dd-mm-yy',
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#availableto" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#availableto" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      dateFormat: 'dd-mm-yy',
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#availablefrom" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>

<script type="text/javascript">
$(document).ready(function(){
  $("#editexamform").validationEngine();
}); 

</script>
<div class="mainholder">

	<div class="content ui-corner-all">
		<div class="createnewdiv" style="float:left">
		<p class="pagetittle">Edit Ujian</p>
		</div>
		<div class="createnewdiv" style="float:right;text-align:center">
		<a href="<?=base_url();?>administrator/mngquestions/<?=(isset($examdetails->examid)) ? $examdetails->examid : '';?>"><img src="<?=base_url();?>assets/admin/images/addque.png" ></a>
		<p class="pagetittle">Kelola Pertanyaan</p>
		</div>
		<div class="clear"></div>
	<?php 
		if(isset($success))
			echo '<p id="success" class="msg done">'.$success.'</p>';
		if(isset($error))
			echo '<p id="error" class="msg error">'.$error.'</p>';
		?>
		
		<form action="" method="post" id="editexamform">
		<table>
	    <tbody>
	    <tr>
	    <td><div class="label">Pilih Ktegori</div></td>
	    <td><div class="input">
	    <input type="hidden" value="<?=(isset($examdetails->examid)) ? $examdetails->examid : '';?>" name="examid">
	    <select name="category" class="input-text validate[required]">
	    <?=(isset($categories)) ? $categories : ''; ?>
	    </select>
	    	</div>
	    </td>
	    </tr>

	    <tr>
	    <td><div class="label">Nama Ujian</div></td>
	    <td><div class="input">
	    	<input type="text" name="examname" size="39" value="<?=(isset($examdetails)) ? $examdetails->examname : '';?>" class="ui-corner-all input-text validate[required]"><?=form_error('examname'); ?>

	    	<!-- Hint section start-->
	    		    <div class="hintsidebar ui-corner-all" style="float:right;font-size:12px;margin-right:30px">
					<span class="icon-left ui-icon ui-icon-info"></span> 
					Harus unik untuk membedakan ujian dalam Pelajaran yang sama.
					</div>
		    <!-- Hint section end -->

	    </div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Deskripsi Ujian</div></td>
	    <td><div class="input">
	    	<textarea cols="50" rows="5" name="examdesc" class="ui-corner-all input-text validate[required]" style="resize:none"><?=(isset($examdetails)) ? $examdetails->description : '';?></textarea>

	    	<!-- Hint section start-->
	    		    <div class="hintsidebar ui-corner-all" style="float:right;font-size:12px;margin-right:30px">
					<span class="icon-left ui-icon ui-icon-info"></span> 
					Sebuah deskripsi singkat yang meliputi ujian.
					</div>
		    <!-- Hint section end -->
	    </div>
	    </tr>
	      <tr>
	    <td><div class="label">Total Pertanyaan</div></td>
	    <td><div class="input">
	    	<input type="text" name="noofques" value="<?=(isset($examdetails)) ? $examdetails->questions : '';?>" size="39" class="ui-corner-all input-text validate[required] custom[integer]"><?=form_error('noofques'); ?></div></td>
	    </tr>
	      <tr>
	    <td><div class="label">lama Ujian (Menit)</div></td>
	    <td><div class="input">
	    	<input type="text" name="duration" size="39" value="<?=(isset($examdetails)) ? $examdetails->duration : '';?>" class="ui-corner-all input-text validate[required] custom[integer]"><?=form_error('duration'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Tersedia Dari</div></td>
	    <td><div class="input">
	    	<input type="text" name="availablefrom" id="availablefrom" value="<?=(isset($examdetails)) ? date('d-m-Y', strtotime($examdetails->availablefrom)) : '';?>" size="39" class="ui-corner-all input-text validate[required]"><?=form_error('availablefrom'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Tersedia Untuk</div></td>
	    <td><div class="input">
	    	<input type="text" name="availableto" id="availableto" size="39" value="<?=(isset($examdetails)) ? date('d-m-Y', strtotime($examdetails->availableto)) : '';?>" class="ui-corner-all input-text validate[required]"><?=form_error('availableto'); ?></div></td>
	    </tr>

	    <tr>
	    <td><div class="label">Jawaban Benar</div></td>
	    <td><div class="input">
	    	<input type="text" name="passmark" size="39" value="<?=(isset($examdetails)) ? $examdetails->passmark : '';?>" class="ui-corner-all input-text validate[required] custom[integer]"><?=form_error('passmark'); ?>

<!-- Hint section start-->
	    		    <div class="hintsidebar ui-corner-all" style="float:right;font-size:12px;margin-right:30px">
					<span class="icon-left ui-icon ui-icon-info"></span> 
					Peserta harus memasukkan kode ini untuk mengikuti tes.
					</div>
		    <!-- Hint section end -->
	    </div>

	    </td>
	    </tr>
	    
	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Save Exam" name="saveexambttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>
	<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>

