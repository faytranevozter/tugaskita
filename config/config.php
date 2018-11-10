<?php 
// memulai session
session_start();

class Database {
	private $host = "localhost";
	private $user = "root";
	private $pass = "fay";
	private $dbname = "tugaskita_db";

	public $con;

	function __construct() {
		$this->con = new Mysqli($this->host, $this->user, $this->pass, $this->dbname);
		if ($this->con->errno > 0) {
			die('Gagal menghubungkan ke database');
		}
	}
}

include_once 'function.php';

include_once 'mahasiswa.class.php';
include_once 'dosen.class.php';
include_once 'matakuliah.class.php';
include_once 'krs.class.php';
include_once 'tugas.class.php';
include_once 'kumpul.class.php';
include_once 'nilai.class.php';