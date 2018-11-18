<?php
$id_tugas = $_GET['tid']; // mengambil dari url (ex: ?id=23)
$tugas = new Tugas();
$kumpul = new Kumpul();
$nilai = new Nilai();
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
					<strong>Matakuliah : </strong>
					<span class="text-dark"><?php echo $data_tugas['matakuliah_nama'] ?></span>
					<div class="w-100 mb-3"></div>

					<strong>Dosen : </strong>
					<span class="text-dark"><?php echo $data_tugas['dosen_nama'] ?></span>
					<div class="w-100 mb-3"></div>

					<strong>Deskripsi : </strong>
					<div class="border p-2 mb-2"><?php echo $data_tugas['tugas_deskripsi'] ?></div>
					<div class="w-100 mb-3"></div>

					<strong>Deadline : </strong>
					<?php if (strtotime($data_tugas['tugas_deadline']) < time()): ?>
						<span class="text-danger"><?php echo tanggal('l, d F Y H:i', $data_tugas['tugas_deadline']) ?></span> (<span class="font-italic">sudah melewati deadline</span>)
					<?php else: ?>
						<span class="text-dark"><?php echo tanggal('l, d F Y H:i', $data_tugas['tugas_deadline']) ?></span>
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
					?>
					<?php if ($id_kumpul !== FALSE): ?>
						<a href="index.php?h=ubah-kumpul&aid=<?php echo $_GET['aid'] . '&tid=' . $data_tugas['tugas_id'] .'&kid=' . $id_kumpul; ?>" class="btn btn-sm btn-warning">Ubah Pengumpulan</a>
					<?php else: ?>
						<!-- selain itu, tampilkan tombol tambah -->
						<a href="index.php?h=kumpul-tugas&aid=<?php echo $_GET['aid'] . '&tid=' . $data_tugas['tugas_id'] ?>" class="btn btn-sm btn-info">Kumpulkan</a>
					<?php endif ?>

					<div class="w-100 mb-3"></div>
					<strong>Nilai : </strong>
					<?php if ($id_kumpul !== FALSE): ?>
						<?php
							// cek apakah sudah pernah diberi nilai oleh dosen
							$nilai_kumpul = $nilai->cek_nilai($id_kumpul);
						?>
						<?php if ($nilai_kumpul !== FALSE): ?>
							<span class="text-dark"><?php echo $nilai_kumpul ?></span>
							(<a href="index.php?h=nilai&aid=<?php echo $_GET['aid'] ?>" class="">Lihat Semua</a>)
						<?php else: ?>
							<span class="text-dark">Belum ada</span>
						<?php endif ?>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

