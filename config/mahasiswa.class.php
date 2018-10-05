<?php 

class Mahasiswa extends Database {

	function login($nim, $password) {
		$q = $this->con->query("SELECT * FROM mahasiswa WHERE mahasiswa_nim = '{$nim}' AND mahasiswa_password = '{$password}'");
		if ($q->num_rows > 0) { // jika mahasiswa ditemukan
			return $q->fetch_assoc(); // kembalikan data login
		} else {
			return FALSE;
		}
	}

}
