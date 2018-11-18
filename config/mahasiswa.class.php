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

	// fungsi untuk mendapatkan data mahasiswa berdasarkan ajar_id
	function get_by_ajar_id($ajar_id) {
		$q = $this->con->query("
			SELECT * FROM krs k
			INNER JOIN mahasiswa m ON k.krs_mahasiswa_id = m.mahasiswa_id
			WHERE k.krs_ajar_id = '{$ajar_id}'");
		if ($q->num_rows > 0) {
			$data = []; // definisi data awal (kosong)
			while ($row = $q->fetch_array()) {
				$data[] = $row; // masukkan data dari tabel kedalam var. data
			}
			return $data; // kembalikan data (yang sudah diisi)
		} else { // jika data dalam tabel masih kosong
			return []; // kembalikan data kosong
		}
	}

}
