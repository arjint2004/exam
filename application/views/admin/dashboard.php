<div class="mainholder">
<div class="content ui-corner-all">
<table width="700px" class="dashboard">
<tbody><tr>
<td><a href="<?=base_url();?>administrator/users"><img src="<?=base_url();?>assets/admin/images/users.gif" ></a><br/>
Manage Users</td>
<td><a href="<?=base_url();?>administrator/exams"><img src="<?=base_url();?>assets/admin/images/editexams.png"></a><br/>Manage Ujian</td>
<td><a href="<?=base_url();?>administrator/categories"><img src="<?=base_url();?>assets/admin/images/categories.png" ></a><br/>Manage Pelajaran</td>
<td><a href="<?=base_url();?>administrator/results"><img src="<?=base_url();?>assets/admin/images/icon_reports.png" ></a><br/>Lihat Hasilnya</td>
</tr>
<tr>
<td><a href="<?=base_url();?>administrator/adduser"><img src="<?=base_url();?>assets/admin/images/adduser-icon.png" ></a><br/>Buat akun User</td>
<td><a href="<?=base_url();?>administrator/results"><img src="<?=base_url();?>assets/admin/images/new_exam.png"></a><br/>Buat Ujian</td>
<td><a href="<?=base_url();?>administrator/profile"><img src="<?=base_url();?>assets/admin/images/edit_profile.png" ></a><br/>Edit Profile</td>
<td><a href="<?=base_url();?>administrator/practicetest"><img src="<?=base_url();?>assets/admin/images/changepassword.png" ></a><br/>Ubah Password</td>
</tr>
</tbody></table>
</div>
<div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>
