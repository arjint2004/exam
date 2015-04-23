<div class="mainholder ">
<?php
if(isset($examdetails))
{
	foreach ($examdetails as $exam) 
	{?>
	<h1 style="color:#06F;"><?=$exam['examname'];?></h1>
	<div class="usercontent ui-corner-all">
		<ul class="examdata">
                <li><span class="file"></span><strong><?=$exam['questions'];?></strong> Pilihan Ganda</li>
                <li><span class="time"></span><strong><?=$exam['duration'];?></strong> Lama Waktu Ujian</li>
                <li><span class="passmark"></span><strong><?=$exam['passmark'];?>%</strong> jawaban benar diperlukan untuk berhasil</li>
                <li style="border-bottom:none">
                <ol class="instructions">
 				<li>Cobalah semua pertanyaan.</li>
 				<li>Jangan pencet tombol back saat mengerjakan soal.</li>
 				<li>Pewaktu/Timer ujian tidak bisa dihentikan setelah ujian dimulai.</li>
 				<li><strong>PENTING!</strong>Ingatlah untuk klik link <b>Finish Ujian</b> di bagian bawah halaman setelah Anda menyelesaikan seluruh ujian. Mengklik link ini sebelum Anda menyelesaikan seluruh ujian akan mengakhiri sesi ujian Anda.</li>
                </ol>
                </li>
                <li style="border-bottom:none"><a class="ui-corner-all ui-state-active bttn-takeexam" href="<?=base_url();?>users/exam/<?=$exam['examid'];?>"> Start Exam </a></li>
        </ul>

	</div>
	<?php
}
}
?>
</div>

