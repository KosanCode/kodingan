-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2020 pada 12.42
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
-- Database: `kamabaa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `kd_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_asal` varchar(100) NOT NULL,
  `alamat_yk` varchar(100) NOT NULL,
  `asal_kampus` varchar(50) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kd_jabatan` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`kd_anggota`, `nama`, `jk`, `tempat_lahir`, `tanggal_lahir`, `alamat_asal`, `alamat_yk`, `asal_kampus`, `angkatan`, `telp`, `foto`, `kd_jabatan`, `id`) VALUES
(3, 'Martha Presina', 'Laki-laki', 'Kandangan', '2019-12-01', 'Kandangan', 'Condong Catur', 'Amikom yogya', 2017, '08989898989', '5e14dcfc45528.jpg', 1, 1),
(4, 'Yan Gurin Ivanda', 'Laki-laki', 'Blora', '2020-01-07', 'Blora', 'Maguwoharjo', 'Akakom', 2017, '089898989', '5e16313e03159.jpg', 2, 4),
(5, 'Bill', 'Laki-laki', 'Blora', '2020-01-15', 'Blora', 'Jakal', 'Amikom', 2016, '09090900', '5e16c3622c63a.jpg', 3, 9),
(6, 'Bill Gani', 'Laki-laki', 'Blora', '2020-01-10', 'Blora', 'Jalan Magelang', 'Akakom', 2017, '080808808', '5e16c3aadad45.jpg', 16, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `kd_dok` int(11) NOT NULL,
  `kd_kegiatan` int(11) NOT NULL,
  `kd_anggota` int(11) NOT NULL,
  `tanggal_buat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`kd_dok`, `kd_kegiatan`, `kd_anggota`, `tanggal_buat`) VALUES
(13, 2, 3, '2020-01-09 02:47:56'),
(14, 3, 4, '2020-01-09 02:48:03'),
(15, 2, 4, '2020-01-09 02:48:10'),
(20, 3, 3, '2020-01-09 10:38:20'),
(21, 5, 3, '2020-01-09 14:29:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtl_kegiatan`
--

CREATE TABLE `dtl_kegiatan` (
  `kd_kegiatan` int(11) NOT NULL,
  `kd_anggota` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dtl_kegiatan`
--

INSERT INTO `dtl_kegiatan` (`kd_kegiatan`, `kd_anggota`, `status`) VALUES
(2, 3, 'y'),
(3, 4, 'y'),
(2, 4, 'y'),
(3, 3, 'y'),
(5, 3, 'y');

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

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`kd_kegiatan`, `kegiatan`, `tanggal`, `tempat`, `detail`, `iuran`, `gambar`) VALUES
(2, 'Ziarah Makam Bupati Blora ke-22', '2020-01-22', 'TMP Kusumanegara, Yogyakarta.', '[Memperingati HUT BLORA KE-270]\r\nâ€¢\r\nAgenda KAMABA YOGYAKARTA untuk memperingati HUT Kabupaten Blora akan mengadakan Ziarah Makam Bupati Blora ke-22, Bapak Soepadi Joedodarmo periode kepemimpinan (1973-1979).', 0, '5e16c13bac0e7.png'),
(3, 'Makrab 2020', '2020-01-05', 'Kaliurang', 'KAMABA YOGYAKARTA proudly present :\r\n\r\nMAKRAB 2020\r\n\r\nFasilitas : snack, makan , teman baru, gebetan anyar, pengalaman, pentas seni, panggon turu, api unggun, game\r\n\r\nPendaftaran 20 November - 5 Desember 2019', 75000, '5e16c0add9b46.png'),
(5, 'Fun Futsal', '2020-01-23', 'MU Futsal', 'Fun Futsal Kamaba Yogyakarta\r\nMalem mingguan daripada meratapi nasib story doi sama yg lain, yuk cuss Futsal bareng sobat Jomblo (Jogja-mbloro)\r\nBadan bugar, hati tak ambyar', 10000, '5e16c1d57708d.png'),
(6, 'Kegiatan 1', '2020-01-09', 'Joglo Kopi', 'Desc', 10000, '5e16d6a985364.jpg');

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
(1, 'marthapresina@gmail.com', '$2y$10$2hdTos0tCR35Q6hqEy8GZ.hfHgg0X3WA9s6.7iXS1ESGfRT9TlaKC', 'MARTHA PRESINA', 'user'),
(2, 'admin@gmail.com', '$2y$10$cCiwDoA16sIQe2VEK5JhH.z/47sVX/oJivJwD1JJRk8qrgoXobc/.', 'ADMIN', 'admin'),
(4, 'yanivanda@gmail.com', '$2y$10$ejYcRwKQw07HFK.99xt/BO3M4Kyof3rGFmsYxDWQrErzxpOWqapeS', 'YAN GURIN IVANDA', 'user'),
(5, 'bill@gmail.com', '$2y$10$f70ZBrXQoVGJxijozfIGLe.YvrFqjjWqyXbSAvDKXntl0Maaca8ui', 'BILL GANI', 'user'),
(6, 'youse@gmail.com', '$2y$10$QHqvubdTn0hXBa4bE.6mI.FfShfJ7Z8V9Y/Bhlz6Rh/WgqfPkVVte', 'YOUSE NUR ', 'user'),
(7, 'valor@gmail.com', '$2y$10$74Z1W1Da0/c76FL4eEugYe0FXixF4Z5Dhw0RMCoDCWt1N5FPrNLcG', 'VALORYAN JUNSI', 'user'),
(8, 'arya@gmail.com', '$2y$10$jqhAtg8cOo5vYMwilSDAoexQuzNFSi7Lt6srik9m2yfrKGW2jx9Om', 'SYAHRUL ARYA', 'user'),
(9, 'aan@gmail.com', '$2y$10$bDMwroH5PCeDwDhmv6aICOMbKDO9xxSy93Ngs9R6ZZiGlXcVROCei', 'KHOIRUL AAN', 'user'),
(10, 'renal@gmail.com', '$2y$10$Gq..14V.yF75iLh8wJEb2O5mlmhXsfhiKV33OguAZ6cyatbXtSesm', 'RENALDA AJI', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabelberita`
--

CREATE TABLE `tabelberita` (
  `kd_berita` int(5) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` varchar(2000) NOT NULL,
  `namagambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabelberita`
--

INSERT INTO `tabelberita` (`kd_berita`, `judul`, `nama`, `tanggal`, `isi`, `namagambar`) VALUES
(14, 'Liburan di Blora? Ini Agenda Hiburan Malam Pergantian Tahun 2018-2019', 'Yan Gurin Ivanda', '2020-01-09', 'BLORA. Libur akhir tahun yang bertepatan dengan libur sekolah, Natal dan tahun baru, di Blora bakal diramaikan beragam kegiatan hiburan, tepatnya pada malam pergantian tahun baru, Senin malam (31/12/2018) nanti akan dilaksanakan Car Free Night di sepanjang Jalan Pemuda dari Alun-alun hingga Tugu Pancasila.\r\n\r\n\r\nSejumlah kegiatan telah disusun dan direncanakan oleh Dinas Kepemudaan Olahraga, Kebudayaan dan Pariwisata (Dinporabudpar) untuk memeriahkan acara Car Free Night tersebut. Berdasarkan data yang berhasil dihimpun, setidaknya ada 5 panggung hiburan di Kota Blora.\r\n\r\n\r\n\r\nKepala Dinporabudpar, Drs. Kunto Aji menyampaikan bahwa ada tiga panggung hiburan di kawasan Car Free Night Jl.Pemuda, yakni sebelah timur Alun-alun ada panggung utama dengan menampilkan Cadenza Band dan OAM Band. Kemudian panggung kedua di Perempatan Grojogan dimeriahkan pertunjukan Musik Keroncong.\r\n\r\nâ€œPanggung ketiga di barat Tugu Pancasila menampilkan live musik Baladewa Band dan Alpad Band. Selain itu masih ada dua panggung hiburan lagi, yakni di panggung terbuka Stadium Seni Budaya Tirtonadi yang dimeriahkan tari tradisional dan seni barongan, serta panggung musik band lokal di Blok T,â€ ucap Kunto Aji.\r\n\r\n\r\n\r\nTepat di detik detik pergantian tahun, akan dinyalakan pesta kembang api di Alun-alun dan Perempatan Grojogan.\r\n\r\n\r\n\r\nâ€œTak hanya di Kota Blora saja, panggung hiburan musik pergantian tahun juga digelar di Kecamatan Cepu. Tepatnya di kawasan Taman Seribu Lampu, dekat Patung Kuda Arjuna Wiwaha. Ayo rayakan Malam Pergantian Tahun dengan aman, nyaman dan lancar,â€ lanjutnya.\r\n\r\n\r\n\r\nSebelumnya pada tanggal 29 Desember, tepatnya hari Sabtu malam juga akan digelar Konser Musik Band Nasional â€œGIGIâ€ dalam rangka memeriahkan Hari Jadi ke 269 Kabupaten Blora. Konser akan dilaksanakan di lapangan Alun-alun Kota.', '5e16bd687745d.jpg'),
(15, 'Kamaba Yogyakarta Gelar Pelatihan Ternak Kelinci di Kalisari', 'Martha Presina', '2020-01-09', 'BLORA. Keluarga Mahasiswa Blora (Kamaba) Yogyakarta sukses menggelar kegiatan pengabdian masyarakat yang dikemas dalam Social Project 2019 di Dukuh Kalisari, Desa Balongsari, Kecamatan Banjarejo. Pada kesempatan ini, Kamaba Yogyakarta melakukan kegiatan berupa penyuluhan dan pelatihan peternakan kelinci kepada masyarakat Dukuh Kalisari yang dilaksanakan hari Sabtu (19/1/2019).\r\n\r\nBerdasarkan survey lapangan yang telah dilakukan oleh tim Pengabdian Masyarakat Kamaba Yogyakarta, Dukuh Kalisari berpotensi untuk dijadikan daerah binaan terkait peternakan kelinci karena dinilai warga telah sadar dan telah memulai beternak kelinci skala rumahan meskipun untuk dikonsumsi pribadi.\r\n\r\nDi sisi lain, wilayah ini merupakan daerah yang berkecukupan air serta didukung kekayaan alam yang dapat memberikan kemudahan untuk pakan ternak kelinci.\r\n\r\nâ€œDengan adanya Social Project ini, kami ingin peternak kelinci di Dukuh Kalisari tidak hanya sekedar beternak, akan tetapi beternak kelinci dengan baik. Misalnya saja dengan memperhatikan pakan, kendang, perkembangbiakan dan lebih-lebih pemasaran kelinci untuk mendongkrak perekonomian masyarakat,â€ ungkap Muhammad Bima Sakti selaku ketua panitia.', '5e16bce56b86e.jpg'),
(17, 'Sambut Hari Jadi ke 269, 10 Benda Pusaka Kabupaten Blora Dikirab dengan Tapa Bisu', 'Youse Nur', '2020-01-09', 'BLORA. Rangkaian kegiatan Hari Jadi ke 269 Kabupaten Blora, setelah Kamis pagi (6/12/2018) dilaksanakan ziarah ke makam para Bupati terdahulu dilanjutkan dengan Kirab Pusaka pada Kamis malamnya hingga Jumat dini hari (7/12/2018).\r\n\r\nSetidaknya ada sepuluh benda pusaka milik Pemkab Blora yang dikirab. Pusaka itu berupa keris dan tombak yang merupakan peninggalan Bupati zaman dahulu.\r\n\r\nDiantaranya adalah Keris Kyai Bisma, pusaka Kyai Segoro Madu, Kyai Cengkrong, Kyai Kolo Wijan, Kyai Sengkelat, Kyai Kantar, Kyai Kebo Lajur, Kyai Tombak Kecipir, Kyai Tombak Biring Lanang, Kyai Tombak Kudup Melati.\r\n\r\nSebelum dikirab, pusaka-pusaka itu terlebih dahulu dibersihkan dengan cara dicuci atau dijamasi dengan menggunakan air bunga dan jeruk nipis guna menghilangkan kotoran berupa debu dan karat.\r\n\r\nKirab dimulai tepat pukul 00.00 WIB yang dilepas langsung oleh Bupati Djoko Nugroho. Pusaka utama Kabupaten yakni Keris Kyai Bisma dipegang oleh Sekda Komang Gede Irawadi SE, M.Si, sedangkan pusaka lainnya dibawa oleh Komunitas Tosan Aji Toya Padasan.\r\n\r\nSelain memberangkatkan kirab, Bupati Djoko Nugroho bersama Wakil Bupati H.Arief Rohman M.Si juga ikut jalan kaki mengikuti kirab yang dilaksanakan dengan tapa bisu atau tanpa berbicara. Kirab juga diikuti oleh seluruh Kepala OPD, Camat dan Lurah.', '5e16bdb39fc06.jpg'),
(18, 'Berita 1', 'Martha Presina', '2020-01-09', 'beritaaa', '5e16d7ecaca2f.jpg');

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
-- Dumping data untuk tabel `tabelkomentar`
--

INSERT INTO `tabelkomentar` (`kd_komentar`, `tanggal`, `komentar`, `kd_berita`, `id`) VALUES
(16, '2020-01-08 07:41:08', 'ini komen', 14, 4),
(19, '2020-01-08 09:13:35', 'coba ya', 15, 4),
(20, '2020-01-09 04:11:57', 'Mantap mantap', 14, 1);

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
  MODIFY `kd_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `kd_dok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kd_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tabelberita`
--
ALTER TABLE `tabelberita`
  MODIFY `kd_berita` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tabelkomentar`
--
ALTER TABLE `tabelkomentar`
  MODIFY `kd_komentar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
