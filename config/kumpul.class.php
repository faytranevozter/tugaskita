<?php 

class Kumpul extends Database {

	/**
	 * fungsi untuk mencari jumlah mahasiswa yang sudah mengumpulkan tugas
	 * @param  $tugas_id        ID tugas yang dibuat dosen
	 * @return int              Jumlah yang mengumpulkan
	 */
	function jumlah_mengumpulkan($tugas_id) {
		$q = $this->con->query("
			SELECT COUNT(*) AS jumlah FROM kumpul
			WHERE kumpul_tugas_id = '{$tugas_id}'");
		$data = $q->fetch_assoc(); // mengambil data dari query
		return $data['jumlah'];
	}

	/**
	 * fungsi untuk mengecek apakah mahasiswa sudah mengumpulkan tugas ${x}
	 * @param  $tugas_id        ID tugas yang dibuat dosen
	 * @param  $mhs_id          ID mahasiswa yang login
	 * @return boolean          FALSE jika belum mengumpulkan, ID kumpul jika sudah mengumpulkan
	 */
	function cek_kumpul($tugas_id, $mhs_id) {
		$q = $this->con->query("
			SELECT kumpul_id FROM kumpul
			WHERE kumpul_tugas_id = '{$tugas_id}'
			AND kumpul_mahasiswa_id = '{$mhs_id}'");
		if ($q->num_rows > 0) {
			$data = $q->fetch_assoc();
			return $data['kumpul_id'];
		} else {
			return FALSE;
		}
	}

	/**
	 * fungsi mendapatkan daftar mahasiswa yang mengumpulkan tugas
	 * @param  $tugas_id        ID tugas yang dibuat dosen
	 * @return array            Data yang mengumpulkan
	 */
	function data_kumpul($tugas_id) {
		$q = $this->con->query("
			SELECT * FROM kumpul k
			INNER JOIN mahasiswa m ON k.kumpul_mahasiswa_id = m.mahasiswa_id
			WHERE k.kumpul_tugas_id = '{$tugas_id}'
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
