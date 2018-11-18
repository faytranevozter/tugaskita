<!-- sidebar -->
<div class="col-md-3">
	<div class="card">
		<div class="p-2">
			<?php if ($_SESSION['dosen']['dosen_jenis_kelamin'] == 'Laki-laki'): ?>
			<img src="img/default_men.png" alt="Foto" class="card-img-top">
			<?php else: ?>
			<img src="img/default_woman.png" alt="Foto" class="card-img-top">
			<?php endif ?>
		</div>
		<div class="card-body">
			<h5 class="card-title"><?php echo $_SESSION['dosen']['dosen_nama'] ?></h5>
			<p class="card-text"><?php echo $_SESSION['dosen']['dosen_nip'] ?></p>
		</div>
	</div>
</div>

<!-- konten utama -->
<div class="col-md-9 text-light">
	<?php 
		$tugas = new Tugas();
		$data_deadline_this_month = $tugas->get_by_dosen_id($_SESSION['dosen']['dosen_id'], date('m'));
		$highlight = [];
		foreach ($data_deadline_this_month as $row) {
			$tanggal = tanggal('j', $row['tugas_deadline']);
			$highlight[$tanggal] = $row['matakuliah_nama'] . ' : ' . $row['tugas_nama'];
		}
		echo '<h2 class="text-center">Kalender ' . tanggal('F Y', date('Y-m-d')) . '</h2>';
		echo build_calendar(11, 2018, $highlight, getdate()); 
	?>
</div>