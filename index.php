<?php 
// mengambil file konfigurasi dan kelas-kelas didalamnya
include_once 'config/config.php'; 

// mengambil siapa yang login ke sistem
$login_akses = isset($_SESSION['akses']) ? $_SESSION['akses'] : FALSE;
$login_akses = 'dosen'; // hanya untuk developer (ganti mahasiswa untuk login sebagai mahasiswa)

// jika belum login, arahkan ke halaman login
if ( ! $login_akses) {
	header('Location: login.php');
	exit(); // stop script dibawahnya
}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Beranda</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body class="bg-secondary">
	<div class="container mt-4">
		<ul class="nav justify-content-center nav-pills nav-fill bg-dark">
			<li class="nav-item">
				<a class="nav-link rounded-0 bg-info text-light active" href="index.php?h=beranda"><i class="fas fa-columns"></i> Beranda</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 bg-dark text-light" href="index.php?h=matakuliah"><i class="fas fa-book"></i> Matakuliah</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 bg-dark text-light" href="#"><i class="fas fa-clipboard-list"></i> Nilai</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 bg-dark text-light" href="#"><i class="fas fa-user"></i> Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 bg-dark text-light" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</li>
		</ul>

		<!-- konten -->
		<div class="row mt-3">
			<?php
				// mengambil halaman dari url : index.php?h=nama-halaman
				$halaman = isset($_GET['h']) ? $_GET['h'] : '';

				switch ($halaman) {

					case 'beranda':
						include $login_akses . '/beranda.php';
					break;
					case 'tambah-tugas':
						include $login_akses . '/tambah-tugas.php';
					break;

					// default jika halaman tidak ditemukan
					default:
						include $login_akses . '/beranda.php'; // halaman default
					break;
				}
			?>

			<!-- footer -->
			<div class="col-md-12 mt-3">
				<nav class="navbar navbar-dark bg-dark justify-content-center rounded">
					<span class="navbar-text">
						Copyright &copy; Tugas Kita 2018
					</span>
				</nav>
			</div>
		</div>
	</div>
</body>
</html>