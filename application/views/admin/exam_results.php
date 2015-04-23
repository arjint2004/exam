<div class="mainholder ">
        <div class="content ui-corner-all">
        <h1 style="color:#06F;"><?=$exam_results['examname'];?></h1>
        <table cellpadding="0" cellspacing="15" border="0" style="text-align:left;width:100%">
        <tbody><tr>
        <td colspan="2"><h3 style="color:#0000cc;text-align:center;margin:0px">Rngkuman hasil Ujian</h3></td>
        </tr>
        <tr><td colspan="2"><hr/></td></tr>
        <tr><td>Ujian </td><td><?=$exam_results['examname'];?></td></tr>
        <tr><td>Total Jawaban</td><td><?=$exam_results['totalmarks'];?></td></tr>
        <tr><td>Jawaban Benar</td><td><?=$exam_results['exampassmark'];?>%</td></tr>
        <tr><td colspan="2"><hr/></td></tr>
        <?php
        if(!empty($exam_results['users_results']))
        {?>
        <tr><td colspan="2"><h3 style="color:#0000cc;text-align:center;margin:0px">Daftar Hasil Ujian</h3></td></tr><tr><td colspan="2"><hr/></td></tr>
        <table cellpadding="0" cellspacing="30" class="datatable">
        <tbody><tr><th></th><th>Nama</th><th>Email</th><th>Jawaban Dipilih</th><th>Prosentase</th><th>Hasil</th></tr>
        <?php
        $count = 1;
        foreach ($exam_results['users_results'] as $userresults) 
        {?>
          <tr>
                <td><?=$count;?>.</td>
                <td><?=$userresults['user_names'];?></td>
                <td><?=$userresults['user_email'];?></td>
                <td style="text-align:center"><?=$userresults['marksobtained'];?></td>
                <td style="text-align:center"><?=$userresults['percentage'];?>%</td>
                <td><?php
                if($userresults['passed'])
                {
                        echo '<span class="passed">Passed</span>';
                }
                else
                {
                         echo '<span class="failed">Failed</span>';
                }
                ?>
                </td>
          </tr>
        <?php
        $count ++;
        }
        ?>

        </tbody></table>
        <?
        }
        ?>
        </tbody></table>

        </div>
        <div class="sidebarmenu">
<?php $this->load->view('admin/sidebarmenu');?>
</div>
</div>
<style type="text/css">
.datatable {
border: 1px solid #D6DDE6;
border-collapse: collapse;
text-align: left;
width: 100%;
font-size: 1em;
}
table {
border: 0;
font-family: verdana,sans-serif;
font-size: 1.2em;
margin-left: auto;
margin-right: auto;
text-align: center;
}
.datatable th {
border: 1px solid #828282;
background-color: #FCC;
font-weight: bold;
text-align: left;
padding: 1em;
}
.datatable td {
border: 1px solid #D6DDE6;
padding: 1em;
}
</style>

