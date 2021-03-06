<?php 
// mengambil file konfigurasi dan kelas-kelas didalamnya
include_once 'config/config.php'; 

// mengambil siapa yang login ke sistem
$login_akses = isset($_SESSION['akses']) ? $_SESSION['akses'] : FALSE;
// $login_akses = 'dosen'; // hanya untuk developer (ganti mahasiswa untuk login sebagai mahasiswa)

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
	<link rel="stylesheet" href="css/custom.css">
	<script src="js/jquery-3.3.1.slim.min.js"></script>
</head>
<body class="bg-secondary">
	<div class="container mt-4">
		<ul class="nav justify-content-center nav-pills nav-fill bg-dark">
			<li class="nav-item">
				<a class="nav-link rounded-0 text-light <?php echo active_on(['beranda']) ?>" href="index.php?h=beranda"><i class="fas fa-columns"></i> Beranda</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 text-light <?php echo active_on(['matakuliah', 'tugas', 'lihat-tugas', 'tambah-tugas', 'ubah-tugas', 'kumpul-tugas', 'ubah-kumpul', 'beri-nilai']) ?>" href="index.php?h=matakuliah"><i class="fas fa-book"></i> Tugas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 text-light <?php echo active_on(['nilai-matakuliah', 'nilai']) ?>" href="index.php?h=nilai-matakuliah"><i class="fas fa-clipboard-list"></i> Nilai</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 text-light <?php echo active_on(['profile']) ?>" href="index.php?h=profile"><i class="fas fa-user"></i> Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-0 text-light <?php echo active_on([]) ?>" href="index.php?h=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
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

					// tugas
					case 'tugas':
						include $login_akses . '/tugas.php';
					break;
					case 'tambah-tugas':
						include $login_akses . '/tambah-tugas.php';
					break;
					case 'ubah-tugas':
						include $login_akses . '/ubah-tugas.php';
					break;
					case 'lihat-tugas':
						include $login_akses . '/lihat-tugas.php';
					break;
					case 'kumpul-tugas':
						include $login_akses . '/kumpul-tugas.php';
					break;
					case 'ubah-kumpul':
						if ($login_akses == 'dosen') {
							alert('Anda tidak punya akses ke halaman tersebut!'); // tampilkan pesan
							redirect('index.php'); // pindahkan halaman
							exit(); // hentikan script
						}
						include $login_akses . '/ubah-kumpul.php';
					break;
					case 'beri-nilai':
						if ($login_akses == 'mahasiswa') {
							alert('Anda tidak punya akses ke halaman tersebut!'); // tampilkan pesan
							redirect('index.php'); // pindahkan halaman
							exit(); // hentikan script
						}
						include $login_akses . '/beri-nilai.php';
					break;

					// matakuliah
					case 'matakuliah':
						include $login_akses . '/matakuliah.php';
					break;

					// nilai matakuliah
					case 'nilai-matakuliah':
						include $login_akses . '/nilai-matakuliah.php';
					break;

					// nilai
					case 'nilai':
						include $login_akses . '/nilai.php';
					break;

					// profile
					case 'profile':
						include $login_akses . '/profile.php';
					break;

					// logout
					case 'logout':
						session_destroy(); // hapus session
						header('Location: login.php'); // redirect ke login
						exit(); // stop script dibawahnya
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

	<!-- Popper.js, then Bootstrap JS -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>