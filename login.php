<?php 
// mengambil file konfigurasi dan kelas-kelas didalamnya
include_once 'config/config.php'; 

// mengambil siapa yang login ke sistem
$login_akses = isset($_SESSION['akses']) ? $_SESSION['akses'] : FALSE;

// jika sudah login, arahkan ke halaman beranda (index.php)
if ($login_akses) {
	header('Location: index.php');
	exit(); // stop script dibawahnya
}

// membuat pesan
$pesan = '';

// cek login
if (isset($_GET['akses'])) {
	if ($_GET['akses'] == 'mahasiswa') {
		// login sebagai mahasiswa
		$mhs = new Mahasiswa();
		$login = $mhs->login($_POST['nim'], $_POST['password']);
		if ($login !== FALSE) { // jika berhasil login (TRUE)
			// set session
			$_SESSION['akses'] = 'mahasiswa';
			$_SESSION['mahasiswa'] = $login;
			// redirect ke halaman beranda
			header('Location: index.php');
			exit(); // stop script dibawahnya
		} else {
			// login gagal
			$pesan = '<div class="alert alert-danger">NIM/Password Salah</div>';
		}
	} else if ($_GET['akses'] == 'dosen') {
		// login sebagai dosen
		$dosen = new Dosen();
		$login = $dosen->login($_POST['nip'], $_POST['password']);
		if ($login !== FALSE) { // jika berhasil login (TRUE)
			// set session
			$_SESSION['akses'] = 'dosen';
			$_SESSION['dosen'] = $login;
			// redirect ke halaman beranda
			header('Location: index.php');
			exit(); // stop script dibawahnya
		} else {
			// login gagal
			$pesan = '<div class="alert alert-danger">NIP/Password Salah</div>';
		}
	} else {
		// refresh halaman
		header('Location: login.php');
		exit(); // stop script dibawahnya
	}
}

?><!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body class="h-100 bg-secondary">
	<div class="container h-100">
		<div class="row justify-content-center h-100">
			<div class="col-md-4 align-self-center">
				
				<div class="card bg-dark text-light">
					<div class="card-body">
						<ul class="nav nav-pills nav-fill mb-3" id="myLogin" role="tablist">
							<li class="nav-item">
								<a class="nav-link text-light mx-1 active" id="mahasiswa-tab" data-toggle="tab" href="#mahasiswa" role="tab" aria-controls="mahasiswa" aria-selected="true">Mahasiswa</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-light mx-1" id="dosen-tab" data-toggle="tab" href="#dosen" role="tab" aria-controls="dosen" aria-selected="false">Dosen</a>
							</li>
						</ul>
						<div class="tab-content" id="myLoginContent">
							<!-- Tampilkan pesan (jika ada) -->
							<?php echo $pesan ?>

							<div class="tab-pane fade show active" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
								<form method="post" action="login.php?akses=mahasiswa">
									<div class="form-group">
										<label>NIM</label>
										<input type="text" name="nim" class="form-control" placeholder="NIM">
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" placeholder="******">
									</div>
									<div class="form-group text-center mb-1">
										<button class="btn btn-info"><i class="fas fa-sign-in-alt"></i> LOGIN MAHASISWA</button>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
								<form method="post" action="login.php?akses=dosen">
									<div class="form-group">
										<label>NIP</label>
										<input type="text" name="nip" class="form-control" placeholder="NIP">
									</div>
									<div class="form-group">
										<label>PASSWORD</label>
										<input type="password" name="password" class="form-control" placeholder="******">
									</div>
									<div class="form-group text-center mb-1">
										<button class="btn btn-info"><i class="fas fa-sign-in-alt"></i> LOGIN DOSEN</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>