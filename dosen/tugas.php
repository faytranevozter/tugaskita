<?php

$id_ajar = $_GET['aid']; // mengambil dari url (ex: ?mid=23)
$tugas = new Tugas();
$data_tugas = $tugas->get_by_ajar_id($id_ajar);

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
							<td><a href="#" class="btn btn-sm btn-success">Download</a></td>
							<td>10/26</td>
							<td>
								<a href="index.php?h=ubah-tugas&tid=<?php echo $row['tugas_id'] ?>" class="btn btn-sm btn-warning">Ubah</a>
								<a href="index.php?h=hapus-tugas&tid=<?php echo $row['tugas_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer text-right">
			<a href="index.php?h=tambah-tugas" class="btn btn-primary">Tambah Tugas</a>
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