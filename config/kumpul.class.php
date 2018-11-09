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

	/**
	 * fungsi untuk mengambil data kumpul berdasarkan id_kumpul/kumpul_id
	 * @param  $kumpul_id       id_kumpul yang akan dicari
	 * @return array            data kumpul
	 */
	function ambil($kumpul_id) {
		$q = $this->con->query("
			SELECT * FROM kumpul k
			INNER JOIN tugas t ON k.kumpul_tugas_id = t.tugas_id
			INNER JOIN ajar a ON a.ajar_id = t.tugas_ajar_id
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			INNER JOIN dosen d ON a.ajar_dosen_id = d.dosen_id
			WHERE k.kumpul_id = '{$kumpul_id}'");
		if ($q->num_rows > 0) {
			return $q->fetch_array();
		} else {
			return FALSE;
		}
	}

	function ubah($id, $deskripsi, $file){
		// cek jika kumpul (dari id_kumpul) adadalam database
		$data = $this->ambil($id);
		// jika ada
		if ($data !== FALSE) {
			// jika mengupload file
			if ( ! empty($file['name'])) {
				$nama_file = $file['name'];
				// memindahkan file ke folder file
				move_uploaded_file($file['tmp_name'], 'file-kumpul/' . $nama_file);
				// hapus file lama jika ada
				if ( ! empty($data['kumpul_file']) && file_exists('file-kumpul/' . $data['kumpul_file'])) {
					// hapus file lama
					unlink('file-kumpul/' . $data['kumpul_file']);
				}
			} else { // jika tidak upload file
				// pakai nama yang lama
				$nama_file = $data['kumpul_file'];
			}
			$q = $this->con->query("
				UPDATE kumpul SET 
					kumpul_deskripsi = '{$deskripsi}', 
					kumpul_file = '{$nama_file}'
				WHERE kumpul_id = '{$id}'
			");
		}
	}

}
