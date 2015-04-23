
<div class="mainholder">
	<div class="content ui-corner-all">
		<div class="createnewdiv">
		<p class="pagetittle">Administrator</p>
	</div>
	<table width="670px" border='1' class="contenttable" id="contenttable">
	<thead>
	<tr>
	<th>Nama Depan</th>
	<th>Nama belakang</th>
	<th>Email</th>
	<th>username</th>
	<th></th>
	<th></th>
	</tr>
	</thead>

		<?php
		$session = get_session_details();
        if(isset($session->admindetails) && !empty($session->admindetails))
        {
            $loggedadmin = (object)$session->admindetails;
            $adminid = $loggedadmin->adminid;
            $adminusername = $loggedadmin->adminusername;
            
        }

		if(isset($administratorsdata))
		{
			foreach($administratorsdata as $row)
			{
				if($adminid != $row['adminid'])
				{
				echo '<tr>
				<td>'.ucfirst($row['firstname']).'</td>
				<td>'.ucfirst($row['lastname']).'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['username'].'</td>
				<td style="line-height:5px;text-align:center"><a href='.base_url().'administrator/editadmin/'.$row['adminid'].'><img src='.base_url().'assets/admin/images/edit.png></a></td>
				<td style="line-height:5px;text-align:center"><a class="deleteuserbttn" href="#" id='.$row['adminid'].'><img src='.base_url().'assets/admin/images/delete.png></a></td>
				</tr>';
				}
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
	  var adminId = $(this).attr("id");

	  if(confirm('Are you sure you want to delete this administrator?'))
	  {
	  $.ajax({
	  type: "POST",
	  url: "<?=base_url();?>administrator/deleteadmin",
	  data: {"adminId": adminId },
	  success: function(test)
	  {
	  	alert('Administrator has been Deleted successfully !');
	  	location.reload();
	  }
	  });
	  }

	  });

</script>