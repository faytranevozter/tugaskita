<?php 

// fungsi untuk menampilkan pesan peringatan
function alert($pesan) {
	// tampilkan alert javascript
	echo "<script>alert('{$pesan}');</script>";
}

// fungsi untuk mengalihkan ke url(x)
function redirect($url) {
	// tampilkan alert javascript
	echo "<script>window.location='{$url}';</script>";
}

// fungsi untuk mengganti format tanggal
function tanggal($format, $tanggal){
	return date($format, strtotime($tanggal));
}