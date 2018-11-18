<div class="col-md-12">
	<div class="card bg-dark text-light">
		<div class="card-header">Profile</div>
		<div class="card-body">
			<div class="row justify-content-center">
				<div class="col-md-8 justify-content-center align-items-center">
					<table class="table table-sm" id="table-profile">
						<tbody>
							<tr>
								<td class="align-top text-center">
									<p class="align-middle">
										<?php if ($_SESSION['dosen']['dosen_jenis_kelamin'] == 'Laki-laki'): ?>
										<img src="img/default_men.png" alt="Foto" class="card-img-top">
										<?php else: ?>
										<img src="img/default_woman.png" alt="Foto" class="card-img-top">
										<?php endif ?>
									</p>
									<p class="align-middle">NIP : <?php echo $_SESSION['dosen']['dosen_nip'] ?></p>
									<p class="align-middle">Nama : <?php echo $_SESSION['dosen']['dosen_nama'] ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#table-profile {border: 0; }
#table-profile tr td {border: 0; }
</style>``