<!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Matakuliah
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered bg-light text-dark" id="myDatatables">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode</th>
							<th>Nama Matakuliah</th>
							<th>Hari</th>
							<th>Jam</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$id_dosen = $_SESSION['dosen']['dosen_id'];
							$makul = new Matakuliah();
							$data_makul = $makul->get_by_dosen_id($id_dosen);
						?>
						<?php foreach ($data_makul as $i => $row): ?>
							<tr>
								<td><?php echo ++$i ?></td>
								<td><?php echo $row['matakuliah_kode'] ?></td>
								<td><?php echo $row['matakuliah_nama'] ?></td>
								<td><?php echo $row['ajar_hari'] ?></td>
								<td><?php echo $row['ajar_jam'] ?></td>
								<td>
									<a href="index.php?h=nilai&aid=<?php echo $row['ajar_id'] ?>" class="btn btn-sm btn-info">Lihat Nilai</a>
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