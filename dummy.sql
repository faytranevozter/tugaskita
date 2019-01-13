CREATE TABLE `ajar` (
  `ajar_id` int(11) NOT NULL,
  `ajar_dosen_id` int(11) NOT NULL,
  `ajar_matakuliah_id` int(11) NOT NULL,
  `ajar_hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') COLLATE utf8_unicode_ci NOT NULL,
  `ajar_jam` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `ajar` (`ajar_id`, `ajar_dosen_id`, `ajar_matakuliah_id`, `ajar_hari`, `ajar_jam`) VALUES
(1, 1, 1, 'Selasa', '10:00 - 12:00'),
(2, 1, 2, 'Kamis', '17:00 - 18:30'),
(3, 2, 5, 'Senin', '20:00 - 21:30'),
(4, 2, 3, 'Jumat', '20:00 - 21:30'),
(5, 3, 2, 'Rabu', '20:00 - 21:30'),
(6, 3, 4, 'Kamis', '10:00 - 12:00'),
(7, 3, 3, 'Senin', '09:00 - 11:00'),
(8, 4, 5, 'Selasa', '20:00 - 21:30'),
(9, 4, 1, 'Rabu', '13:00 - 15:00'),
(10, 5, 5, 'Jumat', '18:30 - 20:00'),
(11, 5, 2, 'Rabu', '10:00 - 12:00');

CREATE TABLE `dosen` (
  `dosen_id` int(11) NOT NULL,
  `dosen_nip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `dosen_nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dosen_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dosen_jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8_unicode_ci NOT NULL,
  `dosen_foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `dosen` (`dosen_id`, `dosen_nip`, `dosen_nama`, `dosen_password`, `dosen_jenis_kelamin`, `dosen_foto`) VALUES
(1, '10001', 'Agung Budi Prasetyo', '10001', 'Laki-laki', ''),
(2, '10002', 'Merarinta Ginting', '10002', 'Laki-laki', ''),
(3, '10003', 'Endang Wahyuningsih', '10003', 'Laki-laki', ''),
(4, '10004', 'Muhammad Ilham', '10004', 'Laki-laki', ''),
(5, '10005', 'Hadiyono', '10005', 'Laki-laki', '');


CREATE TABLE `krs` (
  `krs_id` int(11) NOT NULL,
  `krs_mahasiswa_id` int(11) NOT NULL,
  `krs_ajar_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `krs` (`krs_id`, `krs_mahasiswa_id`, `krs_ajar_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 3),
(5, 2, 11),
(6, 2, 9),
(7, 3, 5),
(8, 3, 2),
(9, 3, 7),
(10, 4, 2),
(11, 4, 4),
(12, 4, 1),
(13, 4, 10),
(14, 4, 7),
(15, 5, 2),
(16, 5, 9),
(17, 5, 10),
(18, 5, 3),
(19, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kumpul`
--

CREATE TABLE `kumpul` (
  `kumpul_id` int(11) NOT NULL,
  `kumpul_tugas_id` int(11) NOT NULL,
  `kumpul_mahasiswa_id` int(11) NOT NULL,
  `kumpul_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kumpul_deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `kumpul_tgl` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `kumpul` (`kumpul_id`, `kumpul_tugas_id`, `kumpul_mahasiswa_id`, `kumpul_file`, `kumpul_deskripsi`, `kumpul_tgl`) VALUES
(1, 7, 3, 'PTCC_TI9_P7_165410011_MuhammadFahrurRifai.pdf', 'ini deskripsi', '2018-10-19 12:38:09'),
(2, 1, 1, 'gas.png', 'nganu', '2018-11-02 14:46:32'),
(3, 8, 3, '', 'apa ini', '2018-11-09 12:41:10'),
(4, 11, 1, 'Laporan.docx', 'membuat rancangan database untuk sistem pemesanan tiket online', '2018-11-30 02:57:06'),
(5, 4, 1, 'Laporan.docx', '', '2018-11-30 03:04:48');


CREATE TABLE `mahasiswa` (
  `mahasiswa_id` int(11) NOT NULL,
  `mahasiswa_nim` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_jurusan` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_tgl_lahir` date NOT NULL,
  `mahasiswa_alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mahasiswa_jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `mahasiswa` (`mahasiswa_id`, `mahasiswa_nim`, `mahasiswa_nama`, `mahasiswa_password`, `mahasiswa_jurusan`, `mahasiswa_foto`, `mahasiswa_tgl_lahir`, `mahasiswa_alamat`, `mahasiswa_email`, `mahasiswa_jenis_kelamin`) VALUES
(1, '165410011', 'Muhammad Fahrur Rifai', '165410011', 'Teknik Informatika', '', '1997-03-02', 'Gamping', 'faimaknyus@gmail.com', 'Laki-laki'),
(2, '165410005', 'Indra Purnama Hadi', '165410005', 'Teknik Informatika', '', '1996-12-02', 'Magelang', 'indrahadi@gmail.com', 'Laki-laki'),
(3, '165410174', 'Laily Rohmawati', '165410174', 'Teknik Informatika', '', '1996-03-18', 'Semarang', 'lailyrahma8@gmail.com', 'Perempuan'),
(4, '165410231', 'Oky Riyanto', '165410231', 'Teknik Informatika', '', '1993-10-30', 'Yogyakarta', 'okyr@gmail.com', 'Laki-laki'),
(5, '165410239', 'Yoga Dwi Jatmika', '165410239', 'Teknik Informatika', '', '1993-05-07', 'Yogyakarta', 'yogadwi@gmail.com', 'Laki-laki');


CREATE TABLE `matakuliah` (
  `matakuliah_id` int(11) NOT NULL,
  `matakuliah_kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matakuliah_nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `matakuliah` (`matakuliah_id`, `matakuliah_kode`, `matakuliah_nama`) VALUES
(1, 'M001', 'Pemrograman Web'),
(2, 'M002', 'Design Database'),
(3, 'M003', 'Pengenalan Pola'),
(4, 'M004', 'Kecerdasan Buatan'),
(5, 'M005', 'Matematika Diskret');


CREATE TABLE `nilai` (
  `nilai_id` int(11) NOT NULL,
  `nilai_kumpul_id` int(11) NOT NULL,
  `nilai_value` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nilai_tgl_input` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `nilai` (`nilai_id`, `nilai_kumpul_id`, `nilai_value`, `nilai_tgl_input`) VALUES
(1, 2, '50', '2018-11-10 07:04:18'),
(2, 5, '75', '2018-11-30 03:06:09');


CREATE TABLE `tugas` (
  `tugas_id` int(11) NOT NULL,
  `tugas_ajar_id` int(11) NOT NULL,
  `tugas_nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tugas_deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `tugas_file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tugas_deadline` datetime NOT NULL,
  `tugas_tgl_dibuat` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `tugas` (`tugas_id`, `tugas_ajar_id`, `tugas_nama`, `tugas_deskripsi`, `tugas_file`, `tugas_deadline`, `tugas_tgl_dibuat`) VALUES
(1, 2, 'Project 1', 'membuat design database', 'Gugatan Cerai.docx', '2018-11-02 00:00:00', '2018-10-19 11:57:55'),
(2, 1, 'Project 1', 'Design tampilan web dengan html dan css ', 'listing algo lanjut 10 gilang.docx', '2018-10-26 12:00:00', '2018-10-19 12:06:15'),
(3, 1, 'Project 2', '', 'Modul 10 Aplikasi Baca Tulis File.doc', '2018-11-05 00:00:00', '2018-10-19 12:08:34'),
(4, 2, 'Project 2', '', 'windows-version.txt', '2018-11-09 21:00:00', '2018-10-19 12:09:39'),
(5, 3, 'Pohon', '', 'Latihan2.java', '2018-10-31 19:00:00', '2018-10-19 12:12:50'),
(6, 3, 'Matriks', '', 'anko_logo.png', '2018-11-14 17:00:00', '2018-10-19 12:15:11'),
(7, 5, 'Sequence diagram', 'Membuat sequence diagram untuk sistem pemesanan hotel online', 'GenericMetode.class', '2018-11-16 20:00:00', '2018-10-19 12:21:28'),
(8, 5, 'ER Diagram', 'Membuat ERD sesuai dengan data yang telah diberikan', 'GenericMetode.class', '2018-11-02 19:00:00', '2018-10-19 12:27:44'),
(9, 6, 'Penggunaan AI', 'Deskripsikan penggunaan AI dalam keseharian berikut contoh nyatanya', '', '2018-10-26 19:34:28', '2018-10-19 12:34:42'),
(10, 1, 'Membuat layout website', 'membuat layout website, kemudian dari layout tersebut ditambahkan cssnya', '', '2018-12-07 09:43:21', '2018-11-30 02:45:41'),
(11, 2, 'Perancangan database', 'merancang database dalam sebuah sistem pemesanan tiket online', 'gone fay.docx', '2018-11-30 10:01:45', '2018-11-30 02:54:13'),
(12, 1, 'Final Proyek', 'mengumpulkan proyek yang sudah dibuat dari awal semester', '1.docx', '2018-11-30 17:51:53', '2018-11-30 09:53:13');

ALTER TABLE `ajar`
  ADD PRIMARY KEY (`ajar_id`);

ALTER TABLE `dosen`
  ADD PRIMARY KEY (`dosen_id`);

ALTER TABLE `krs`
  ADD PRIMARY KEY (`krs_id`);

ALTER TABLE `kumpul`
  ADD PRIMARY KEY (`kumpul_id`);

ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_id`);

ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`matakuliah_id`);

ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nilai_id`);

ALTER TABLE `tugas`
  ADD PRIMARY KEY (`tugas_id`);

ALTER TABLE `ajar`
  MODIFY `ajar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `dosen`
  MODIFY `dosen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `krs`
  MODIFY `krs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `kumpul`
  MODIFY `kumpul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `mahasiswa`
  MODIFY `mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `matakuliah`
  MODIFY `matakuliah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `nilai`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tugas`
  MODIFY `tugas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

