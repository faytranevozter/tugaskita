<?php 

class Krs extends Database {

	// fungsi untuk menghitung jumlah mahasiswa sesuai dengan kelas yang diambil dengan parameter ajar_id
	function jumlah_mahasiswa($ajar_id) {
		$ajar_id = $this->con->real_escape_string($ajar_id);
		$q = $this->con->query("
			SELECT COUNT(*) AS jumlah FROM krs
			WHERE krs_ajar_id = '{$ajar_id}'");
		$data = $q->fetch_assoc(); // mengambil data dari query
		return $data['jumlah'];
	}

}
