<?php 

class Tugas extends Database {

	// fungsi mendapatkan data tugas berdasarkan id ajar / ajar_id
	function get_by_ajar_id($ajar_id) {
		$ajar_id = $this->con->real_escape_string($ajar_id);
		$q = $this->con->query("
			SELECT * FROM tugas t
			INNER JOIN ajar a ON a.ajar_id = t.tugas_ajar_id
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			INNER JOIN dosen d ON a.ajar_dosen_id = d.dosen_id
			WHERE a.ajar_id = '{$ajar_id}'");
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

	// fungsi untuk menambahkan tugas
	// param judul, deskripsi, deadline, file, ajar_id
	function tambah($judul, $deskripsi, $deadline, $file, $ajar_id){
		$judul = $this->con->real_escape_string($judul);
		$deskripsi = $this->con->real_escape_string($deskripsi);
		$deadline = $this->con->real_escape_string($deadline);
		$ajar_id = $this->con->real_escape_string($ajar_id);
		// jika mengupload file
		if ( ! empty($file['name'])) {
			$nama_file = $file['name'];
			if ( ! is_allowed_type($file['name'])) {
				return FALSE;
			}
			// memindahkan file ke folder file
			move_uploaded_file($file['tmp_name'], 'file/' . $nama_file);
		} else {
			$nama_file = '';
		}
		$tanggal_sekarang = date('Y-m-d H:i:s');
		$q = $this->con->query("
			INSERT INTO tugas(tugas_ajar_id, tugas_nama, tugas_deskripsi, tugas_file, tugas_deadline, tugas_tgl_dibuat)
			VALUES('{$ajar_id}', '{$judul}', '{$deskripsi}', '{$nama_file}', '{$deadline}', '{$tanggal_sekarang}')
		");
		return TRUE;
	}

	// fungsi untuk mengambil data tugas berdasarkan tugas_id
	function ambil($tugas_id){
		$tugas_id = $this->con->real_escape_string($tugas_id);
		$q = $this->con->query("
			SELECT * FROM tugas t
			INNER JOIN ajar a ON a.ajar_id = t.tugas_ajar_id
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			INNER JOIN dosen d ON a.ajar_dosen_id = d.dosen_id
			WHERE t.tugas_id = '{$tugas_id}'");
		if ($q->num_rows > 0) {
			return $q->fetch_array();
		} else {
			return FALSE;
		}
	}

	// fungsi untuk mengubah data tugas yang sebelumnya sudah dibuat
	// param id, judul, deskripsi, deadline, file
	function ubah($id, $judul, $deskripsi, $deadline, $file){
		$id = $this->con->real_escape_string($id);
		$judul = $this->con->real_escape_string($judul);
		$deskripsi = $this->con->real_escape_string($deskripsi);
		$deadline = $this->con->real_escape_string($deadline);
		// cek jika tugas (dari id_tugas) adadalam database
		$data = $this->ambil($id);
		// jika ada
		if ($data !== FALSE) {
			// jika mengupload file
			if ( ! empty($file['name'])) {
				$nama_file = $file['name'];
				if ( ! is_allowed_type($file['name'])) {
					return FALSE;
				}
				// memindahkan file ke folder file
				move_uploaded_file($file['tmp_name'], 'file/' . $nama_file);
				// hapus file lama jika ada
				if ( ! empty($data['tugas_file']) && file_exists('file/' . $data['tugas_file'])) {
					// hapus file lama
					unlink('file/' . $data['tugas_file']);
				}
			} else { // jika tidak upload file
				// pakai nama yang lama
				$nama_file = $data['tugas_file'];
			}
			$q = $this->con->query("
				UPDATE tugas SET 
					tugas_nama = '{$judul}', 
					tugas_deskripsi = '{$deskripsi}', 
					tugas_file = '{$nama_file}', 
					tugas_deadline = '{$deadline}'
				WHERE tugas_id = '{$id}'
			");
		}
		return TRUE;
	}

	// fungsi untuk menghapus file tugas berdasarkan tugas_id
	function hapus($tugas_id){
		$tugas_id = $this->con->real_escape_string($tugas_id);
		// mengambil data tugas (untuk menghapus file tugas)
		$data = $this->ambil($tugas_id);
		// jika file ada di server, maka hapuskan
		if ( ! empty($data['tugas_file']) && file_exists('file/' . $data['tugas_file'])) {
			@unlink('file/' . $data['tugas_file']); // hapus file yang ada di folder "file"
		}
		// jalankan query hapus
		$this->con->query("DELETE FROM tugas WHERE tugas_id = '{$tugas_id}'");
	}

	// fungsi untuk mengumpulkan tugas yang sudah dibuat oleh dosen
	// param tugas_id, mahasiswa_id, deskripsi, file
	function kumpul($tugas_id, $mahasiswa_id, $deskripsi, $file){
		$tugas_id = $this->con->real_escape_string($tugas_id);
		$mahasiswa_id = $this->con->real_escape_string($mahasiswa_id);
		$deskripsi = $this->con->real_escape_string($deskripsi);
		// jika mengupload file
		if ( ! empty($file['name'])) {
			$nama_file = $file['name'];
			if ( ! is_allowed_type($file['name'])) {
				return FALSE;
			}
			// memindahkan file ke folder file-kumpul
			move_uploaded_file($file['tmp_name'], 'file-kumpul/' . $nama_file);
		} else {
			$nama_file = '';
		}
		$tanggal_sekarang = date('Y-m-d H:i:s');
		$q = $this->con->query("
			INSERT INTO kumpul(kumpul_tugas_id, kumpul_mahasiswa_id, kumpul_file, kumpul_deskripsi, kumpul_tgl)
			VALUES('{$tugas_id}', '{$mahasiswa_id}', '{$nama_file}', '{$deskripsi}', '{$tanggal_sekarang}')
		");
		return TRUE;
	}

	function get_by_dosen_id($dosen_id, $month) {
		$dosen_id = $this->con->real_escape_string($dosen_id);
		$month = $this->con->real_escape_string($month);
		$q = $this->con->query("
			SELECT * FROM tugas t
			INNER JOIN ajar a ON a.ajar_id = t.tugas_ajar_id
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			WHERE a.ajar_dosen_id = '{$dosen_id}'
			AND MONTH(t.tugas_deadline) = '{$month}'");
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

	function get_by_mahasiswa_id($mahasiswa_id, $month) {
		$mahasiswa_id = $this->con->real_escape_string($mahasiswa_id);
		$month = $this->con->real_escape_string($month);
		$q = $this->con->query("
			SELECT * FROM tugas t
			INNER JOIN ajar a ON a.ajar_id = t.tugas_ajar_id
			INNER JOIN matakuliah m ON a.ajar_matakuliah_id = m.matakuliah_id
			INNER JOIN krs k ON k.krs_ajar_id = a.ajar_id
			WHERE k.krs_mahasiswa_id = '{$mahasiswa_id}'
			AND MONTH(t.tugas_deadline) = '{$month}'");
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
