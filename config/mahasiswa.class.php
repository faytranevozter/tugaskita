<?php 

class Mahasiswa extends Database {

	// fungsi untuk melakukan login untuk mahasiswa dengan parameter nim dan password
	function login($nim, $password) {
		// prevent sql injection
		$nim = $this->con->real_escape_string($nim);
		$password = $this->con->real_escape_string($password);

		$q = $this->con->query("SELECT * FROM mahasiswa WHERE mahasiswa_nim = '{$nim}' AND mahasiswa_password = '{$password}'");
		if ($q->num_rows > 0) { // jika mahasiswa ditemukan
			return $q->fetch_assoc(); // kembalikan data login
		} else {
			return FALSE;
		}
	}

}
