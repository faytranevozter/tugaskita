<?php 

class Krs extends Database {

	function jumlah_mahasiswa($ajar_id) {
		$q = $this->con->query("
			SELECT COUNT(*) AS jumlah FROM krs
			WHERE krs_ajar_id = '{$ajar_id}'");
		$data = $q->fetch_assoc(); // mengambil data dari query
		return $data['jumlah'];
	}

}
