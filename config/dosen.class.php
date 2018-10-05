<?php 

class Dosen extends Database {

	function login($nip, $password) {
		$q = $this->con->query("SELECT * FROM dosen WHERE dosen_nip = '{$nip}' AND dosen_password = '{$password}'");
		if ($q->num_rows > 0) { // jika dosen ditemukan
			return $q->fetch_assoc(); // kembalikan data login
		} else {
			return FALSE;
		}
	}

}
