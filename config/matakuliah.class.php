<?php 

class Matakuliah extends Database {

	function get_by_dosen_id($dosen_id) {
		$q = $this->con->query("
			SELECT * FROM ajar a
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			INNER JOIN dosen d ON a.ajar_dosen_id = d.dosen_id
			WHERE a.ajar_dosen_id = '{$dosen_id}'
		");
		if ($q->num_rows > 0) {
			$data = []; // definisi data awal (kosong)
			while ($row = $q->fetch_assoc()) {
				$data[] = $row; // masukkan data dari tabel kedalam var. data
			}
			return $data; // kembalikan data (yang sudah diisi)
		} else { // jika data dalam tabel masih kosong
			return []; // kembalikan data kosong
		}
	}

}
