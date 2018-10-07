<?php

$id_ajar = $_GET['aid']; // mengambil dari url (ex: ?mid=23)
$tugas = new Tugas();
$data_tugas = $tugas->get_by_ajar_id($id_ajar);

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
						<tr>
							<td><?php echo ++$i ?></td>
							<td><?php echo $row['tugas_nama'] ?></td>
							<td><?php echo $row['tugas_deadline'] ?></td>
							<td>
								<!-- cek apakah file ada di server -->
								<?php if ( ! empty($row['tugas_file']) && file_exists('file/' . $row['tugas_file'])): ?>
									<a href="file/<?php echo $row['tugas_file'] ?>" download class="btn btn-sm btn-success">Download</a>
								<?php else: ?>
									File tidak ada
								<?php endif ?>
							</td>
							<td>10/26</td>
							<td>
								<a href="index.php?h=ubah-tugas&tid=<?php echo $row['tugas_id'] ?>" class="btn btn-sm btn-warning">Ubah</a>
								<a href="index.php?h=tugas&aksi=hapus&aid=<?php echo $_GET['aid'] ?>&tid=<?php echo $row['tugas_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer text-right">
			<a href="index.php?h=tambah-tugas&aid=<?php echo $_GET['aid'] ?>" class="btn btn-primary">Tambah Tugas</a>
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