<?php 

class Nilai extends Database {

	/**
	 * fungsi untuk mengecek apakah sudah diberi nilai berdasarkan kumpul_id
	 * @param  $kumpul_id       ID Kumpul yang dikumpulkan siswa
	 * @return boolean          FALSE jika belum mengumpulkan, Nilai jika sudah
	 */
	function cek_nilai($kumpul_id) {
		$q = $this->con->query("
			SELECT nilai_value FROM nilai
			WHERE nilai_kumpul_id = '{$kumpul_id}'");
		if ($q->num_rows > 0) {
			$data = $q->fetch_assoc();
			return $data['nilai_value'];
		} else {
			return FALSE;
		}
	}

	// fungsi untuk memberi nilai pada tugas yang telah dikumpulkan oleh mahasiswa
	// param nilai dalam bentuk array per mahasiswa yang sudah mengumpulkan
	function beri_nilai($array_nilai=[]) {
		$tanggal_sekarang = date('Y-m-d H:i:s');
		foreach ($array_nilai as $kumpul_id => $nilai) {
			// cek apakah sudah diberi nilai
			// jika sudah, update data
			if ($this->cek_nilai($kumpul_id) !== FALSE) {
				$sql = "UPDATE nilai SET nilai_value = '{$nilai}' 
					WHERE nilai_kumpul_id = '{$kumpul_id}'";
			}
			// jika belum, insert data
			else {
				$sql = "INSERT INTO nilai(nilai_kumpul_id, nilai_value, nilai_tgl_input)
					VALUES('{$kumpul_id}', '{$nilai}', '{$tanggal_sekarang}')";
			}
			$this->con->query($sql);
		}
	}

	// fungsi untuk melihat nilai berdasarkan tugas_id dan mahasiswa_id
	function lihat_nilai($tugas_id, $mahasiswa_id) {
		$q = $this->con->query("
			SELECT nilai_value FROM nilai n
			JOIN kumpul k ON k.kumpul_id = n.nilai_kumpul_id
			WHERE k.kumpul_tugas_id = '{$tugas_id}'
			AND k.kumpul_mahasiswa_id = '{$mahasiswa_id}'
			");
		if ($q->num_rows > 0) {
			$data = $q->fetch_assoc();
			return $data['nilai_value'];
		} else {
			return FALSE;
		}
	}

}
