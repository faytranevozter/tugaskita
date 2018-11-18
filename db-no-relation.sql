CREATE TABLE `dosen` ( 
	`dosen_id` INT NOT NULL AUTO_INCREMENT , 
	`dosen_nip` VARCHAR(15) NOT NULL , 
	`dosen_nama` VARCHAR(50) NOT NULL , 
	`dosen_password` VARCHAR(50) NOT NULL , 
	`dosen_jenis_kelamin` ENUM('Laki-laki','Perempuan') NOT NULL , 
	`dosen_foto` VARCHAR(50) NOT NULL , 
	PRIMARY KEY (`dosen_id`)
);

CREATE TABLE `matakuliah` ( 
	`matakuliah_id` INT NOT NULL AUTO_INCREMENT , 
	`matakuliah_kode` VARCHAR(10) NOT NULL , 
	`matakuliah_nama` VARCHAR(50) NOT NULL , 
	PRIMARY KEY (`matakuliah_id`)
);

CREATE TABLE `ajar` ( 
	`ajar_id` INT NOT NULL AUTO_INCREMENT , 
	`ajar_dosen_id` INT NOT NULL , 
	`ajar_matakuliah_id` INT NOT NULL , 
	`ajar_hari` ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL , 
	`ajar_jam` VARCHAR(25) NOT NULL , 
	PRIMARY KEY (`ajar_id`)
);

CREATE TABLE `mahasiswa` ( 
	`mahasiswa_id` INT NOT NULL AUTO_INCREMENT , 
	`mahasiswa_nim` CHAR(9) NOT NULL , 
	`mahasiswa_nama` VARCHAR(50) NOT NULL , 
	`mahasiswa_password` VARCHAR(50) NOT NULL , 
	`mahasiswa_jurusan` VARCHAR(25) NOT NULL , 
	`mahasiswa_foto` VARCHAR(50) NOT NULL , 
	`mahasiswa_tgl_lahir` DATE NOT NULL , 
	`mahasiswa_alamat` TEXT NOT NULL , 
	`mahasiswa_email` VARCHAR(50) NOT NULL , 
	`mahasiswa_jenis_kelamin` ENUM('Laki-laki','Perempuan') NOT NULL , 
	PRIMARY KEY (`mahasiswa_id`)
);

CREATE TABLE `krs` ( 
	`krs_id` INT NOT NULL AUTO_INCREMENT , 
	`krs_mahasiswa_id` INT NOT NULL , 
	`krs_ajar_id` INT NOT NULL , 
	PRIMARY KEY (`krs_id`)
);

CREATE TABLE `tugas` ( 
	`tugas_id` INT NOT NULL AUTO_INCREMENT , 
	`tugas_ajar_id` INT NOT NULL , 
	`tugas_nama` VARCHAR(50) NOT NULL , 
	`tugas_deskripsi` TEXT NOT NULL , 
	`tugas_file` VARCHAR(50) NOT NULL , 
	`tugas_deadline` DATETIME NOT NULL , 
	`tugas_tgl_dibuat` DATETIME NOT NULL , 
	PRIMARY KEY (`tugas_id`)
);

CREATE TABLE `kumpul` ( 
	`kumpul_id` INT NOT NULL AUTO_INCREMENT , 
	`kumpul_tugas_id` INT NOT NULL , 
	`kumpul_mahasiswa_id` INT NOT NULL , 
	`kumpul_file` VARCHAR(50) NOT NULL , 
	`kumpul_deskripsi` TEXT NOT NULL , 
	`kumpul_tgl` DATETIME NOT NULL , 
	PRIMARY KEY (`kumpul_id`)
);

CREATE TABLE `nilai` ( 
	`nilai_id` INT NOT NULL AUTO_INCREMENT , 
	`nilai_kumpul_id` INT NOT NULL , 
	`nilai_value` VARCHAR(5) NOT NULL , 
	`nilai_tgl_input` DATETIME NOT NULL , 
	PRIMARY KEY (`nilai_id`)
);
