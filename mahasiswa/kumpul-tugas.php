<?php
$tugas = new Tugas();
if (isset($_POST["aksi"]) && ($_POST["aksi"] == "kumpul")) {
	$exec = $tugas->kumpul($_GET['tid'], $_SESSION['mahasiswa']['mahasiswa_id'], $_POST['deskripsi'], $_FILES['file']);
	if ($exec) {
		alert('Tugas berhasil dikumpulkan');
		redirect('index.php?h=lihat-tugas&aid=' . $_GET['aid'] . '&tid=' . $_GET['tid']);
	} else {
		alert('Tugas Gagal dikumpulkan');
		redirect('index.php?h=kumpul-tugas&aid=' . $_GET['aid'] . '&tid=' . $_GET['tid']);
	}
	exit();
}
?>
<!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Kumpul Tugas
		</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>File Tugas</label>
							<input name="file" type="file" class="form-control">
						</div>
						<div class="form-group">
							<label>Deskripsi Tugas</label>
							<textarea name="deskripsi" class="form-control" placeholder="Deskripsi Tugas" rows="4"></textarea>
						</div>
						<button name="aksi" value="kumpul" type="submit" class="btn btn-info">Kumpul Tugas</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

