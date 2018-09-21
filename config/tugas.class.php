<?php 

class Tugas extends Database {

	function tampil() {
		$q = $this->con->query("SELECT * FROM tugas");
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
