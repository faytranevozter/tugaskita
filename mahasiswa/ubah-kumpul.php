<?php
$id_kumpul = $_GET['kid']; // mengambil dari url (ex: ?id=23)
$kumpul = new Kumpul();
$data_kumpul = $kumpul->ambil($id_kumpul);

// jika data kumpul tidak ditemukan
if ( ! $data_kumpul) {
	alert('Data tidak ditemukan'); // tampilkan pesan
	redirect('index.php?h=lihat-tugas&aid=' . $_GET['aid'] . '&tid=' . $_GET['tid']); // pindahkan halaman
	exit(); // hentikan script
}

if (isset($_POST["aksi"]) && ($_POST["aksi"] == "ubah")) {
	$kumpul->ubah($id_kumpul, $_POST['deskripsi'], $_FILES['file']);
	alert('Data berhasil diubah');
	redirect('index.php?h=lihat-tugas&aid=' . $_GET['aid'] . '&tid=' . $_GET['tid']); // pindahkan halaman
	exit();
}
?><!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Ubah Kumpul
		</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label>Deskripsi</label>
							<textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="4"><?php echo $data_kumpul['kumpul_deskripsi'] ?></textarea>
						</div>
						<div class="form-group">
							<label>File Kumpul</label>
							<!-- tampilkan file jika ada -->
							<?php if ( ! empty($data_kumpul['kumpul_file']) && file_exists('file-kumpul/' . $data_kumpul['kumpul_file'])): ?>
								<p class="text-success font-italic">File tersedia</p>
							<?php else: ?>
								<p class="text-danger font-italic">File tidak tersedia</p>
							<?php endif ?>
							<input type="file" name="file" class="form-control">
						</div>
						<button type="submit" name="aksi" value="ubah" class="btn btn-info">Ubah Kumpul</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
