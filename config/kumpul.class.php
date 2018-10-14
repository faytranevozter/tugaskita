<?php 

class Kumpul extends Database {

	function jumlah_mengumpulkan($tugas_id) {
		$q = $this->con->query("
			SELECT COUNT(*) AS jumlah FROM kumpul
			WHERE kumpul_tugas_id = '{$tugas_id}'");
		$data = $q->fetch_assoc(); // mengambil data dari query
		return $data['jumlah'];
	}

}
