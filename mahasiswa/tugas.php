<?php

$id_ajar = $_GET['aid']; // mengambil dari url (ex: ?mid=23)
$tugas = new Tugas();
$data_tugas = $tugas->get_by_ajar_id($id_ajar);

// inisiasi Kumpul
// digunakan untuk menghitung jumlah mahasiswa yang sudah mengumpulkan
$kumpul = new Kumpul();

// inisiasi Krs
// digunakan untuk menghitung jumlah mahasiswa yang kedapatan tugas
$krs = new Krs();
$jumlah_mahasiswa = $krs->jumlah_mahasiswa($_GET['aid']);

// hapus data
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
	$tugas->hapus($_GET['tid']);
	header('Location: index.php?h=tugas&aid=' . $_GET['aid']);
	exit();
}

?>
<!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Tugas 
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered bg-light text-dark" id="myDatatables">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Tugas / Project</th>
							<th>Deadline</th>
							<th>File</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_tugas as $i => $row): ?>
							<tr class="<?php if(strtotime($row['tugas_deadline']) < time()){ echo 'bg-danger text-light'; } ?>">
								<td><?php echo ++$i ?></td>
								<td><?php echo $row['tugas_nama'] ?></td>
								<td><?php echo tanggal('d F Y H:i', $row['tugas_deadline']) ?></td>
								<td>
									<!-- cek apakah file ada di server -->
									<?php if ( ! empty($row['tugas_file']) && file_exists('file/' . $row['tugas_file'])): ?>
										<a href="file/<?php echo $row['tugas_file'] ?>" download class="btn btn-sm btn-success">Download</a>
									<?php else: ?>
										File tidak ada
									<?php endif ?>
								</td>
								<td>
									<?php
										// menghitung jumlah mahasiswa yang mengumpulkan tugas
										$jumlah_mengumpulkan = $kumpul->jumlah_mengumpulkan($row['tugas_id']);
										// tampilkan
										echo $jumlah_mengumpulkan . ' / ' . $jumlah_mahasiswa;
									?>
								</td>
								<td>
									<a href="index.php?h=lihat-tugas&aid=<?php echo $_GET['aid'] ?>&tid=<?php echo $row['tugas_id'] ?>" class="btn btn-sm btn-success">Lihat</a>
									<?php
										// cek apakah mahasiswa sudah mengumpulkan tugas
										// jika sudah, tampilkan tombol ubah
										$id_mahasiswa = $_SESSION['mahasiswa']['mahasiswa_id'];
										$id_kumpul = $kumpul->cek_kumpul($row['tugas_id'], $id_mahasiswa);
										if ($id_kumpul !== FALSE) {
											echo '<a href="index.php?h=ubah-tugas&aid=' . $_GET['aid'] . '&tid=' . $row['tugas_id'] .'&kid=' . $id_kumpul .'" class="btn btn-sm btn-warning">Ubah</a>';
										} else { // selain itu, tampilkan tombol tambah
											echo '<a href="index.php?h=kumpul-tugas&aid=' . $_GET['aid'] . '&tid=' . $row['tugas_id'] .'" class="btn btn-sm btn-info">Kumpul</a>';
										}
									?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<script src="js/datatables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		$('#myDatatables').DataTable();
	});
</script>