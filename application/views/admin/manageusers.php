
<div class="mainholder">
	<div class="content ui-corner-all">
	<div class="createnewdiv">
		<a href="<?=base_url();?>administrator/adduser"><img src="<?=base_url();?>assets/admin/images/adduser-icon.png" ></a>
	</div>
	<table width="670px" border='1' class="contenttable" id="contenttable">
	<thead>
	<tr>
	<th>Nama Depan</th>
	<th>Nama Belakang</th>
	<th>Email</th>
	<th>Username</th>
	<th>Status</th>
	<th></th>
	<th></th>
	</tr>
	</thead>

		<?php
		if(isset($usersdata))
		{
			foreach($usersdata as $row)
			{
				if($row['status'] == 1)
				{
					$status = 'active';
				}
				else
				{
					$status = 'suspended';
				}
				echo '<tr>
				<td>'.ucfirst($row['firstname']).'</td>
				<td>'.ucfirst($row['lastname']).'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['username'].'</td>
				<td>'.ucfirst($status).'</td>
				<td style="line-height:5px;text-align:center"><a href='.base_url().'administrator/edituser/'.$row['user_id'].'><img src='.base_url().'assets/admin/images/edit.png></a></td>
				<td style="line-height:5px;text-align:center"><a class="deleteuserbttn" href="#" id='.$row['user_id'].'><img src='.base_url().'assets/admin/images/delete.png></a></td>
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
	  $("a.deleteuserbttn").live('click', function(e){
	  e.preventDefault();
	  var userId = $(this).attr("id");

	  if(confirm('Are you sure you want to Delete this user?'))
	  {
	  $.ajax({
	  type: "POST",
	  url: "<?=base_url();?>administrator/deleteUser",
	  data: {"userId": userId },
	  success: function(test)
	  {
	  	//alert('User has been Deleted');
	  	location.reload();
	  }
	  });
	  }

	  });

</script>