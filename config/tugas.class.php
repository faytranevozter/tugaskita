<?php 

class Tugas extends Database {

	function get_by_ajar_id($ajar_id) {
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

	function tambah($judul, $deskripsi, $deadline, $file, $ajar_id){
		// jika mengupload file
		if ( ! empty($file['name'])) {
			$nama_file = $file['name'];
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
	}

	function ambil($tugas_id){
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

	function hapus($tugas_id){
		// mengambil data tugas (untuk menghapus file tugas)
		$data = $this->ambil($tugas_id);
		// jika file ada di server, maka hapuskan
		if ( ! empty($data['tugas_file']) && file_exists('file/' . $data['tugas_file'])) {
			unlink('file/' . $data['tugas_file']); // hapus file yang ada di folder "file"
		}
		// jalankan query hapus
		$this->con->query("DELETE FROM tugas WHERE tugas_id = '{$tugas_id}'");
	}

}
