-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2019 pada 18.00
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamaba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `kd_anggota` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` char(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_asal` varchar(100) NOT NULL,
  `alamat_yk` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kd_jabatan` int(5) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`kd_anggota`, `nama`, `jk`, `tempat_lahir`, `tanggal_lahir`, `alamat_asal`, `alamat_yk`, `telp`, `foto`, `kd_jabatan`, `id`) VALUES
(1, 'Syahrul Arya', 'L', 'Blora', '2019-12-03', 'Blora', 'Blora', '089662964655', 'person_4_sq.jpg', 1, 2),
(2, 'Abdhul Aziz', 'L', 'Blora', '2019-12-18', 'Blora', 'Blora', '089662964655', 'person_2_sq.jpg', 2, 3),
(3, 'Elok Nishfa', 'P', 'Blora', '2019-12-01', 'Blora', 'Blora', '089662964655', 'person_1_sq.jpg', 3, 4),
(4, 'Yan Gurin Ivanda', 'L', 'Blora', '1999-09-22', 'Cabak, jiken, Blora', 'Jenengan, Magowoharjo, Sleman', '089662964655', 'person_3_sq.jpg', 4, 1),
(5, 'Anis Nur', 'P', 'Blora', '2019-12-06', 'Blora', 'Blora', '089662964655', 'person_1_sq.jpg', 5, 5),
(6, 'Dhiaz Ayunda', 'P', 'Blora', '2019-12-17', 'Blora', 'Blora', '089662964655', 'person_1_sq.jpg', 6, 6),
(7, 'Feby Richana', 'P', 'Blora', '2019-12-25', 'Blora', 'Blora', '089662964655', 'person_1_sq.jpg', 7, 7),
(8, 'Aan Khoirul', 'L', 'Blora', '1999-09-22', 'Cabak, jiken, Blora', 'Jenengan, Magowoharjo, Sleman', '089662964655', 'person_3_sq.jpg', 8, 8),
(9, 'Syifa', 'P', 'Blora', '2019-12-06', 'Blora', 'Blora', '089662964655', 'person_1_sq.jpg', 9, 9),
(10, 'Bima Sakti', 'L', 'Blora', '2019-12-17', 'Blora', 'Blora', '089662964655', 'person_2_sq.jpg', 10, 10),
(11, 'Ahmad Jauharul', 'L', 'Blora', '2019-12-25', 'Blora', 'Blora', '089662964655', 'person_3_sq.jpg', 11, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `kd_berita` char(5) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` varchar(2000) NOT NULL,
  `id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`kd_berita`, `judul`, `nama`, `tanggal`, `isi`, `id`) VALUES
('B001', 'Mulai Belajar', 'Andre Taulani', '2019-02-20', 'blablalbablabalbalabalbabalbablalabbalbalbalbalbabablablbalbalbalbal', NULL),
('B002', 'Acara Makrab', 'Budi Setianto', '2019-06-22', 'Abcdefghaijklmnopqrstuvwqyz', NULL),
('B003', 'Acara Akhir Tahun', 'Andi Setiawan', '2019-10-18', 'Banyakaashasjashssjhashajskjaksj', NULL),
('B004', 'Makrab Kamaba', 'Budi Sutanto', '2019-12-12', 'Basjasjahsjajahdjasjkalsjklajsk', NULL),
('B005', 'Seminar Kamaba', 'Setiyawan Mulya', '2019-06-20', 'JHajkshjkasasjkajhsjansansklaksjasjalksjakljs', NULL),
('B006', 'Keakraban Kamaba', 'Nunung Surti', '2019-08-13', 'AIOJJNAsnlkanslkasdsakldklajsdkljaldjka', NULL),
('B007', 'Menuju Masa Depan Cerah', 'Heru Pambudi', '2019-09-27', 'AKJDKJSAKDNLASNDLKIO kakldsjajsdjakldjkad', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `kd_dok` int(5) NOT NULL,
  `kd_kegiatan` int(5) NOT NULL,
  `kd_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`kd_dok`, `kd_kegiatan`, `kd_anggota`) VALUES
(1, 10005, 8),
(5, 10002, 4),
(6, 10002, 4),
(7, 10002, 4),
(8, 10002, 4),
(9, 10005, 8),
(10, 10002, 4),
(11, 10005, 8),
(12, 10002, 4),
(13, 10005, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_berita`
--

CREATE TABLE `dtl_berita` (
  `judul` varchar(20) NOT NULL,
  `gambar` blob NOT NULL,
  `kd_berita` char(5) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_kegiatan`
--

CREATE TABLE `dtl_kegiatan` (
  `kd_kegiatan` int(5) NOT NULL,
  `kd_anggota` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dtl_kegiatan`
--

INSERT INTO `dtl_kegiatan` (`kd_kegiatan`, `kd_anggota`, `status`) VALUES
(10001, 2, 'n'),
(10002, 4, 'y'),
(10005, 8, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `kd_jabatan` int(5) NOT NULL,
  `jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`kd_jabatan`, `jabatan`) VALUES
(1, 'Ketua Umum'),
(2, 'Ketua 1'),
(3, 'Ketua 2'),
(4, 'Sekretaris 1'),
(5, 'Bendahara 1'),
(6, 'Sekretaris 2'),
(7, 'Bendahara 2'),
(8, 'Pengkaderan'),
(9, 'Puslitbang'),
(10, 'Sospem'),
(11, 'Infokom'),
(12, 'Anggota Pengkaderan'),
(13, 'Anggota Puslitbang'),
(14, 'Anggota Sospem'),
(15, 'Anggota Infokom');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kd_kegiatan` int(5) NOT NULL,
  `kegiatan` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `detail` text NOT NULL,
  `iuran` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`kd_kegiatan`, `kegiatan`, `tanggal`, `tempat`, `detail`, `iuran`, `gambar`) VALUES
(10001, 'Seminar Nasional', '2019-12-31', 'Gor Amongrogo', 'Aaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa', 20000, 'img_1.jpg'),
(10002, 'Malam Keakraban', '2019-12-24', 'Kaliurang', 'Bbbbbbbbbb bbbbbbb bbbbbbbbb bbbbbbbbb bbbbbbbbbbbbbbb', 50000, 'img_2.jpg'),
(10003, 'Pembentukan Panitia', '2019-12-13', 'Cafe Unlimited', 'Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited Pembentukan Panitia Cafe Unlimited ', 0, 'img_4.jpg'),
(10004, 'Ngopi Bareng', '2019-12-07', 'Basa basi cafe', 'Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe Ngopi Bareng Basa basi cafe ', 0, 'img_6.jpg'),
(10005, 'Futsal bareng ', '2019-12-09', 'telaga futsal', 'Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng Futsal bareng ', 10000, 'img_3.jpg'),
(10006, 'Memancing', '2019-12-17', 'Kali Brantas', 'Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas Memancing Kali Brantas ', 0, 'img_1.jpg'),
(10007, 'Jogging', '2020-01-01', 'Maguwoharjo', 'Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo Jogging Maguwoharjo ', 0, 'img_4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `komentar` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `id` int(5) NOT NULL,
  `kd_berita` char(5) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'yanivanda@gmail.com', '12345', 'Yan Gurin Ivanda', 'admin'),
(2, 'asd', 'asd', 'asd', 'admin'),
(3, 'qwe', 'qwe', 'qwe', 'admin'),
(4, 'qwe', 'qwe', 'qwe', 'admin'),
(5, 'qwe', 'qwe', 'qwe', 'admin'),
(6, 'qwe', 'qwe', 'qwe', 'admin'),
(7, 'qwe', 'qwe', 'qwe', 'admin'),
(8, 'qwe', 'qwe', 'qwe', 'admin'),
(9, 'qwe', 'qwe', 'qwe', 'admin'),
(10, 'qwe', 'qwe', 'qwe', 'admin'),
(11, 'qwe', 'qwe', 'qwe', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`kd_anggota`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE,
  ADD KEY `kd_jabatan` (`kd_jabatan`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`kd_berita`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`kd_dok`),
  ADD KEY `kd_kegiatan` (`kd_kegiatan`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indeks untuk tabel `dtl_berita`
--
ALTER TABLE `dtl_berita`
  ADD KEY `kd_berita` (`kd_berita`);

--
-- Indeks untuk tabel `dtl_kegiatan`
--
ALTER TABLE `dtl_kegiatan`
  ADD UNIQUE KEY `kd_kegiatan` (`kd_kegiatan`) USING BTREE,
  ADD UNIQUE KEY `kd_anggota` (`kd_anggota`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kd_jabatan`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kd_kegiatan`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD KEY `id` (`id`),
  ADD KEY `kd_berita` (`kd_berita`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `kd_dok` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `dtl_kegiatan`
--
ALTER TABLE `dtl_kegiatan`
  MODIFY `kd_kegiatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kd_kegiatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10008;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`kd_jabatan`) REFERENCES `jabatan` (`kd_jabatan`),
  ADD CONSTRAINT `anggota_ibfk_2` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`kd_kegiatan`) REFERENCES `kegiatan` (`kd_kegiatan`);

--
-- Ketidakleluasaan untuk tabel `dtl_berita`
--
ALTER TABLE `dtl_berita`
  ADD CONSTRAINT `dtl_berita_ibfk_1` FOREIGN KEY (`kd_berita`) REFERENCES `berita` (`kd_berita`);

--
-- Ketidakleluasaan untuk tabel `dtl_kegiatan`
--
ALTER TABLE `dtl_kegiatan`
  ADD CONSTRAINT `dtl_kegiatan_ibfk_1` FOREIGN KEY (`kd_kegiatan`) REFERENCES `kegiatan` (`kd_kegiatan`),
  ADD CONSTRAINT `dtl_kegiatan_ibfk_2` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`);

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`kd_berita`) REFERENCES `berita` (`kd_berita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
