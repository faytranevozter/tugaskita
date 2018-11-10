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

}
