<?php
$id_tugas = $_GET['tid']; // mengambil dari url (ex: ?id=23)
$tugas = new Tugas();
$data_tugas = $tugas->ambil($id_tugas);

// jika data tugas tidak ditemukan
if ( ! $data_tugas) {
	alert('Data tidak ditemukan'); // tampilkan pesan
	redirect('index.php?h=tugas&aid=' . $_GET['aid']); // pindahkan halaman
	exit(); // hentikan script
}

if (isset($_POST["aksi"]) && ($_POST["aksi"] == "ubah")) {
	$tugas->ubah($_GET['tid'], $_POST['judul'], $_POST['deskripsi'], $_POST['deadline'], $_FILES['file']);
	alert('Data berhasil diubah');
	redirect('index.php?h=tugas&aid=' . $_GET['aid']);
	exit();
}
?><!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Ubah Tugas
		</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label>Judul Tugas</label>
							<input type="text" name="judul" class="form-control" placeholder="Judul Tugas" value="<?php echo $data_tugas['tugas_nama'] ?>">
						</div>
						<div class="form-group">
							<label>Deskripsi Tugas</label>
							<textarea name="deskripsi" class="form-control" placeholder="Deskripsi Tugas" rows="4"><?php echo $data_tugas['tugas_deskripsi'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Deadline</label>
							<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
								<input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="<?php echo $data_tugas['tugas_deadline'] ?>" />
								<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>File Tugas</label>
							<!-- tampilkan file jika ada -->
							<?php if ( ! empty($data_tugas['tugas_file']) && file_exists('file/' . $data_tugas['tugas_file'])): ?>
								<p class="text-success font-italic">File tersedia</p>
							<?php else: ?>
								<p class="text-danger font-italic">File tidak tersedia</p>
							<?php endif ?>
							<input type="file" name="file" class="form-control">
						</div>
						<button type="submit" name="aksi" value="ubah" class="btn btn-info">Ubah Tugas</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="css/tempusdominus-bootstrap-4.min.css">
<script src="js/moment.js"></script>
<script src="js/tempusdominus-bootstrap-4.min.js"></script>
<script>
	$(document).ready(function() {
		$('#datetimepicker1').datetimepicker({
			format: "YYYY-MM-DD HH:mm:ss",
			icons: {
				time: 'fas fa-clock',
				date: 'fas fa-calendar',
				up: 'fas fa-arrow-up',
				down: 'fas fa-arrow-down',
				previous: 'fas fa-chevron-left',
				next: 'fas fa-chevron-right',
				today: 'fas fa-calendar-check-o',
				clear: 'fas fa-trash',
				close: 'fas fa-times'
			}
		});
	});
</script>