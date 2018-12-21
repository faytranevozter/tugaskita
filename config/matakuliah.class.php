<?php 

class Matakuliah extends Database {

	// fungsi untuk mengambil data matakuliah berdasarkan dosen_id dengan parameter dosen_id
	function get_by_dosen_id($dosen_id) {
		$dosen_id = $this->con->real_escape_string($dosen_id);
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

	// fungsi untuk mengambil data matakuliah berdasarkan mahasiswa_id dengan parameter mahasiswa_id
	function get_by_mahasiswa_id($mahasiswa_id) {
		$mahasiswa_id = $this->con->real_escape_string($mahasiswa_id);
		$q = $this->con->query("
			SELECT * FROM krs k
			INNER JOIN mahasiswa mhs ON k.krs_mahasiswa_id = mhs.mahasiswa_id
			INNER JOIN ajar a ON k.krs_ajar_id = a.ajar_id
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			INNER JOIN dosen d ON a.ajar_dosen_id = d.dosen_id
			WHERE k.krs_mahasiswa_id = '{$mahasiswa_id}'
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
