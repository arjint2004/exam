
<div class="mainholder">
	<div class="content ui-corner-all">
	<div class="createnewdiv">
		<a href="<?=base_url();?>administrator/createexam"><img src="<?=base_url();?>assets/admin/images/add.png" ></a>
	</div>
	<table width="670px" border='1' class="contenttable" id="contenttable">
	<thead>
	<tr>
	<th>Nama ujian</th>
	<th>Pelajaran</th>
	<th>Durasi (Menit)</th>
	<th>Nomor pertanyaan</th>
	<th></th>
	<th></th>
	</tr>
	</thead>

		<?php
		if(isset($exams))
		{
			foreach($exams->result_array() as $row)
			{
				echo '<tr>
				<td>'.ucfirst($row['examname']).'</td>
				<td>'.ucfirst($row['catname']).'</td>
				<td style="line-height:5px;text-align:center">'.$row['duration'].'</td>
				<td style="line-height:5px;text-align:center">'.$row['questions'].'</td>
				<td style="line-height:5px;text-align:center"><a href='.base_url().'administrator/editexam/'.$row['examid'].'><img src='.base_url().'assets/admin/images/edit.png></a></td>
				<td style="line-height:5px;text-align:center"><a class="deletebttn" href="#" id='.$row['examid'].'><img src='.base_url().'assets/admin/images/delete.png></a></td>
				</tr>';
			}
			
		}
		?>
		</table>
</div>
<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>

<script type="text/javascript">
	  $("a.deletebttn").live('click', function(e){
	  e.preventDefault();
	  var examId = $(this).attr("id");

	  if(confirm('Are you sure you want to Delete this exam?'))
	  {
	  $.ajax({
	  type: "POST",
	  url: "<?=base_url();?>administrator/deleteexam",
	  data: {"examId": examId },
	  success: function(test)
	  {
	  	alert('Exam has been Deleted successfully !');
	  	location.reload();
	  }
	  });
	  }
	  });

</script>