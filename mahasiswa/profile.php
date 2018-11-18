<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">Profile</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-md-8 justify-content-center align-items-center">
					<table class="table table-sm" id="table-profile">
						<tbody>
							<tr>
								<td class="align-top text-center" rowspan="8" width="200">
									<?php if ($_SESSION['mahasiswa']['mahasiswa_jenis_kelamin'] == 'Laki-laki'): ?>
									<img src="img/default_men.png" alt="Foto" class="card-img-top">
									<?php else: ?>
									<img src="img/default_woman.png" alt="Foto" class="card-img-top">
									<?php endif ?>
								</td>
							</tr>
							<tr><td class="align-middle pl-4">NIM : <?php echo $_SESSION['mahasiswa']['mahasiswa_nim'] ?></td></tr>
							<tr><td class="align-middle pl-4">Nama : <?php echo $_SESSION['mahasiswa']['mahasiswa_nama'] ?></td></tr>
							<tr><td class="align-middle pl-4">Jurusan : <?php echo $_SESSION['mahasiswa']['mahasiswa_jurusan'] ?></td></tr>
							<tr><td class="align-middle pl-4">Tanggal Lahir : <?php echo tanggal('d F Y', $_SESSION['mahasiswa']['mahasiswa_tgl_lahir']) ?></td></tr>
							<tr><td class="align-middle pl-4">Alamat : <?php echo $_SESSION['mahasiswa']['mahasiswa_alamat'] ?></td></tr>
							<tr><td class="align-middle pl-4">Email : <?php echo $_SESSION['mahasiswa']['mahasiswa_email'] ?></td></tr>
							<tr><td class="align-middle pl-4">Jenis Kelamin : <?php echo $_SESSION['mahasiswa']['mahasiswa_jenis_kelamin'] ?></td></tr>
						</tbody>
					</table>
					<div class="p-2">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#table-profile {border: 0; }
#table-profile tr td {border: 0; }
</style>