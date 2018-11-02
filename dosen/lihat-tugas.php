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

// mengambil data mahasiswa yang sudah megumpulkan tugas
$kumpul = new Kumpul();
$data_kumpul = $kumpul->data_kumpul($id_tugas);

?><!-- konten utama -->
<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">
			<?php echo $data_tugas['tugas_nama'] ?>
		</div>
		<div class="card-body bg-light text-dark">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="border p-2 mb-2">
						<?php echo $data_tugas['tugas_deskripsi'] ?>
					</div>

					<div class="w-100 mb-3"></div>

					<strong>Deadline : <?php echo tanggal('l, d F Y H:i', $data_tugas['tugas_deadline']) ?></strong>
					
					<div class="w-100 mb-3"></div>

					<strong>File Tugas : </strong>
					<!-- cek apakah file ada di server -->
					<?php if ( ! empty($data_tugas['tugas_file']) && file_exists('file/' . $data_tugas['tugas_file'])): ?>
						<a href="file/<?php echo $data_tugas['tugas_file'] ?>" download class="btn btn-sm btn-success">Download</a>
					<?php else: ?>
						<span class="text-danger">File tidak ada</span>
					<?php endif ?>
				</div>

				<div class="w-100 mb-3"></div>

				<div class="col-md-8 border-top pt-2">
					<p><strong>Mahasiswa yang sudah mengumpulkan : </strong></p>
					
					<table class="table table-bordered bg-light text-dark" id="myDatatables">
						<thead>
							<tr>
								<th>No.</th>
								<th>NIM</th>
								<th>Nama Mahasiswa</th>
								<th>Tanggal Kumpul</th>
								<th>File</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data_kumpul as $i => $row): ?>
								<tr>
									<td><?php echo ++$i ?></td>
									<td><?php echo $row['mahasiswa_nim'] ?></td>
									<td><?php echo $row['mahasiswa_nama'] ?></td>
									<td><?php echo tanggal('d F Y H:i', $row['kumpul_tgl']) ?></td>
									<td>
										<!-- cek apakah file ada di server -->
										<?php if ( ! empty($row['tugas_file']) && file_exists('file/' . $row['tugas_file'])): ?>
											<a href="file-kumpul/<?php echo $row['tugas_file'] ?>" download class="btn btn-sm btn-success">Download</a>
										<?php else: ?>
											File tidak ada
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
