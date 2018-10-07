<?php
$tugas = new Tugas();
if (isset($_POST["aksi"]) && ($_POST["aksi"] == "tambah")) {
	$tugas->tambah($_POST['judul'], $_POST['deskripsi'], $_POST['deadline'], $_FILES['file'], $_GET['aid']);
	header('Location: index.php?h=tugas&aid=' . $_GET['aid']);
	exit();
}
?>
<!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Tambah Tugas
		</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Judul Tugas</label>
							<input name="judul" type="text" class="form-control" placeholder="Judul Tugas">
						</div>
						<div class="form-group">
							<label>Deskripsi Tugas</label>
							<textarea name="deskripsi" class="form-control" placeholder="Deskripsi Tugas" rows="4"></textarea>
						</div>
						<div class="form-group">
							<label>Deadline</label>
							<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
								<input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
								<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>File Tugas</label>
							<input name="file" type="file" class="form-control">
						</div>
						<button name="aksi" value="tambah" type="submit" class="btn btn-info">Tambah Tugas</button>
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
			format: "YYYY-MM-DD hh:mm:ss",
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