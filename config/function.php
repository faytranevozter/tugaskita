<?php 

function alert($pesan) {
	// tampilkan alert javascript
	echo "<script>alert('{$pesan}');</script>";
}

function redirect($url) {
	// tampilkan alert javascript
	echo "<script>window.location='{$url}';</script>";
}