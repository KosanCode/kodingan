-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2020 pada 15.48
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamabaa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `kd_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` char(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_asal` varchar(100) NOT NULL,
  `alamat_yk` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kd_jabatan` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `kd_dok` int(11) NOT NULL,
  `kd_kegiatan` int(11) NOT NULL,
  `kd_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_kegiatan`
--

CREATE TABLE `dtl_kegiatan` (
  `kd_kegiatan` int(11) NOT NULL,
  `kd_anggota` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `kd_jabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`kd_jabatan`, `jabatan`) VALUES
(1, 'Ketua Umum'),
(2, 'Ketua 1'),
(3, 'Ketua 2'),
(4, 'Sekretaris 1'),
(5, 'Sekretaris 2'),
(6, 'Bendahara 1'),
(7, 'Bendahara 2'),
(8, 'Pengkaderan'),
(9, 'Puslitbang'),
(10, 'Sospem'),
(11, 'Infokom'),
(12, 'Anggota Pengkaderan'),
(13, 'Anggota Puslitbang'),
(14, 'Anggota Sospem'),
(15, 'Anggota Infokom'),
(16, 'Anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kd_kegiatan` int(11) NOT NULL,
  `kegiatan` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `detail` text NOT NULL,
  `iuran` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL
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
(1, 'marthapresina@gmail.com', '$2y$10$9SkY3wm3ZkSoP58Cu0nn5.EheKna/BnPiA.0V4NvlO0QlPMLXsMzG', 'MARTHA PRESINA', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabelberita`
--

CREATE TABLE `tabelberita` (
  `kd_berita` int(5) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` varchar(2000) NOT NULL,
  `namagambar` varchar(50) NOT NULL,
  `gambar` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabelkomentar`
--

CREATE TABLE `tabelkomentar` (
  `kd_komentar` int(5) NOT NULL,
  `tanggal` datetime NOT NULL,
  `komentar` varchar(2000) NOT NULL,
  `kd_berita` int(5) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`kd_anggota`),
  ADD KEY `kd_jabatan` (`kd_jabatan`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`kd_dok`),
  ADD KEY `kd_kegiatan` (`kd_kegiatan`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indeks untuk tabel `dtl_kegiatan`
--
ALTER TABLE `dtl_kegiatan`
  ADD KEY `kd_kegiatan` (`kd_kegiatan`),
  ADD KEY `kd_anggota` (`kd_anggota`);

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
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tabelberita`
--
ALTER TABLE `tabelberita`
  ADD PRIMARY KEY (`kd_berita`);

--
-- Indeks untuk tabel `tabelkomentar`
--
ALTER TABLE `tabelkomentar`
  ADD PRIMARY KEY (`kd_komentar`),
  ADD KEY `kd_berita` (`kd_berita`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `kd_anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `kd_dok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kd_kegiatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tabelberita`
--
ALTER TABLE `tabelberita`
  MODIFY `kd_berita` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tabelkomentar`
--
ALTER TABLE `tabelkomentar`
  MODIFY `kd_komentar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`kd_kegiatan`) REFERENCES `kegiatan` (`kd_kegiatan`);

--
-- Ketidakleluasaan untuk tabel `dtl_kegiatan`
--
ALTER TABLE `dtl_kegiatan`
  ADD CONSTRAINT `dtl_kegiatan_ibfk_1` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`),
  ADD CONSTRAINT `dtl_kegiatan_ibfk_2` FOREIGN KEY (`kd_kegiatan`) REFERENCES `kegiatan` (`kd_kegiatan`);

--
-- Ketidakleluasaan untuk tabel `tabelkomentar`
--
ALTER TABLE `tabelkomentar`
  ADD CONSTRAINT `tabelkomentar_ibfk_1` FOREIGN KEY (`kd_berita`) REFERENCES `tabelberita` (`kd_berita`),
  ADD CONSTRAINT `tabelkomentar_ibfk_2` FOREIGN KEY (`id`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
