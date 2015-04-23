
<div class="mainholder">
	<div class="content ui-corner-all">
	<div class="createnewdiv">
		<p class="pagetittle">Hasil ujian</p>
	</div>
	<table width="670px" border='1' class="contenttable" id="contenttable">
	<thead>
	<tr>
	<th>Nama Ujian</th>
	<th>Validitas</th>
	<th style="line-height:5px;text-align:center">Pertanyaan</th>
	<th style="line-height:5px;text-align:center">Upaya Siswa</th>
	<th></th>
	</tr>
	</thead>

		<?php
		if(isset($exams))
		{
			foreach($exams->result_array() as $row)
			{?>
				<tr>
				<td><?=ucfirst($row['examname']);?></td>
				<td><?=date('d F Y', strtotime($row['availablefrom'])).' to '.date('d F Y', strtotime($row['availableto']));?></td>
				<td style="line-height:5px;text-align:center"><?=$row['questions'];?></td>
				<td style="line-height:5px;text-align:center"><?=$row['attempted_students'];?></td>
				<td style="line-height:5px;text-align:center"><a href='<?=base_url();?>administrator/view_results/<?=$row['examid'];?>'>
				<?php
				if($row['attempted_students'] != 0) echo 'View Results';

				?>
				</a></td>
				</tr>
			<?}
			
		}
		?>
		</table>
</div>
<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>