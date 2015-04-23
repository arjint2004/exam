<script>
$(document).ready(function(){
  $("#editcategoryform").validationEngine();
}); 

</script>
<div class="mainholder">

	<div class="content ui-corner-all">
	<div class="createnewdiv">
		<p class="pagetittle">Ubah Pelajaran</p>
	</div>
	<?php 
		if(isset($success))
			echo '<p id="success" class="msg done">'.$success.'</p>'
		?>
		<form action="" method="post" id="editcategoryform">
		<table>
	    <tbody>
		<tr>
	    <td><div class="label">Jenjang</div></td>
	    <td>
			<div class="input">
				<select name="jenjang" class="input-text validate[required]">
				<option value="">Pilih Jenjang</option>
				<? foreach($jenjang as $datajen){?>
					<option <?if($datajen['id']==$categorydetails->jenjang){echo 'selected';}?> value="<?=$datajen['id']?>"><?=$datajen['nama']?> Kelas <?=$datajen['grade']?></option>
				<? } ?>
				</select>				
				<?=form_error('jenjang'); ?>
			</div>
		</td>
	    </tr>
		<tr>
	    <td><div class="label">Jurusan</div></td>
	    <td>
			<div class="input">
				<select name="jurusan" class="input-text validate[required]">
				<option value="">Pilih Jurusan</option>
				<? foreach($jurusan as $datajur){?>
					<option <?if($datajur['id']==$categorydetails->jurusan){echo 'selected';}?> value="<?=$datajur['id']?>"><?=$datajur['nama']?></option>
				<? } ?>
				</select>
				<?=form_error('jurusan'); ?>
			</div>
		</td>
		<tr>
	    <td><div class="label">Nama Pelajaran</div></td>
	    <td><div class="input">
	    	<input type="hidden" name="catid" value="<?=(isset($categorydetails) ? $categorydetails->catid : '')?>"/>
	    	<input type="text" value="<?=(isset($categorydetails) ? $categorydetails->catname : '')?>" name="catname" size="39" class="ui-corner-all input-text validate[required]"><?=form_error('catname'); ?></div></td>
	    </tr>
	    <tr>
	    <td><div class="label">Deskripsi Pelajaran</div></td>
	    <td><div class="input">
	    	<textarea cols="50" rows="5" name="catdesc" class="ui-corner-all input-text validate[required]" style="resize:none"><?=(isset($categorydetails) ? $categorydetails->catdesc : '')?></textarea>

	    	<!-- Hint section start-->
	    		    <div class="hintsidebar ui-corner-all" style="float:right;font-size:12px;margin-right:30px">
					<span class="icon-left ui-icon ui-icon-info"></span> 
					Sebuah deskripsi singkat yang meliputi kategri.
					</div>
		    <!-- Hint section end -->
	    </div>
	    </tr>
	    
	 	<tr>
	 	<td>&nbsp;</td>
	 	<td><input type="submit" value="Save Category" name="editcategorybttn" class="input-button ui-corner-all ui-state-default"></td>
	    </tr>
	    </tbody></table>
	    </form>
	</div>
	<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>