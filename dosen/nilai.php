<?php
$id_ajar = $_GET['aid']; // mengambil dari url (ex: ?mid=23)
$tugas = new Tugas();
$data_tugas = $tugas->get_by_ajar_id($id_ajar);
// digunakan untuk mengambil nilai mahasiswa
$nilai = new Nilai();
?><!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			Nilai
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-sm bg-light text-dark" id="myDatatables">
					<thead>
						<tr>
							<th class="align-middle text-center" rowspan="2" width="50">No.</th>
							<th class="align-middle text-center" rowspan="2" width="100">NIM</th>
							<th class="align-middle text-center" rowspan="2">Nama</th>
							<th class="align-middle text-center" colspan="<?php echo count($data_tugas) ?>">Tugas</th>
						</tr>
						<tr>
							<?php foreach ($data_tugas as $key => $row): ?>
							<th class="align-middle text-center"><?php echo $row['tugas_nama'] ?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php
							$mhs = new Mahasiswa();
							$data_mhs = $mhs->get_by_ajar_id($id_ajar);
						?>
						<?php foreach ($data_mhs as $i => $row): ?>
							<tr>
								<td class="text-center"><?php echo ++$i ?></td>
								<td class="text-center"><?php echo $row['mahasiswa_nim'] ?></td>
								<td><?php echo $row['mahasiswa_nama'] ?></td>
								<?php foreach ($data_tugas as $key => $tgs): ?>
									<?php
										// mencari nilai berdasarkan tugas_id dan mahasiswa_id
										$nilai_mhs = $nilai->lihat_nilai($tgs['tugas_id'], $row['mahasiswa_id']);
									?>
									<td class="text-center"><?php echo $nilai_mhs !== FALSE ? $nilai_mhs : '-'; ?></td>
								<?php endforeach ?>
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