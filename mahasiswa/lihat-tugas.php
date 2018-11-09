<?php
$id_tugas = $_GET['tid']; // mengambil dari url (ex: ?id=23)
$tugas = new Tugas();
$kumpul = new Kumpul();
$data_tugas = $tugas->ambil($id_tugas);

// jika data tugas tidak ditemukan
if ( ! $data_tugas) {
	alert('Data tidak ditemukan'); // tampilkan pesan
	redirect('index.php?h=tugas&aid=' . $_GET['aid']); // pindahkan halaman
	exit(); // hentikan script
}

?><!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			<?php echo $data_tugas['tugas_nama'] ?>
		</div>
		<div class="card-body bg-light text-dark">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="border p-2 mb-2">
						<?php echo $data_tugas['tugas_deskripsi'] ?>
					</div>

					<div class="w-100 mb-3"></div>

					<?php if (strtotime($data_tugas['tugas_deadline']) < time()): ?>
					<strong>Deadline : <span class="text-danger"><?php echo tanggal('l, d F Y H:i', $data_tugas['tugas_deadline']) ?></span> (<span class="font-italic">sudah melewati deadline</span>)</strong>
					<?php else: ?>
					<strong>Deadline : <?php echo tanggal('l, d F Y H:i', $data_tugas['tugas_deadline']) ?></strong>
					<?php endif ?>
					
					<div class="w-100 mb-3"></div>

					<strong>File Tugas : </strong>
					<!-- cek apakah file ada di server -->
					<?php if ( ! empty($data_tugas['tugas_file']) && file_exists('file/' . $data_tugas['tugas_file'])): ?>
						<a href="file/<?php echo $data_tugas['tugas_file'] ?>" download class="btn btn-sm btn-success">Download</a>
					<?php else: ?>
						<span class="text-danger">File tidak ada</span>
					<?php endif ?>

					<div class="w-100 mb-3"></div>
					<strong>Kumpul : </strong>
					<?php
						// cek apakah mahasiswa sudah mengumpulkan tugas
						// jika sudah, tampilkan tombol ubah
						$id_mahasiswa = $_SESSION['mahasiswa']['mahasiswa_id'];
						$id_kumpul = $kumpul->cek_kumpul($data_tugas['tugas_id'], $id_mahasiswa);
						if ($id_kumpul !== FALSE) {
							echo '<a href="index.php?h=ubah-kumpul&aid=' . $_GET['aid'] . '&tid=' . $data_tugas['tugas_id'] .'&kid=' . $id_kumpul .'" class="btn btn-sm btn-warning">Ubah Pengumpulan</a>';
						} else { // selain itu, tampilkan tombol tambah
							echo '<a href="index.php?h=kumpul-tugas&aid=' . $_GET['aid'] . '&tid=' . $data_tugas['tugas_id'] .'" class="btn btn-sm btn-info">Kumpulkan</a>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

