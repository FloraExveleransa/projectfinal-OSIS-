-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2024 pada 17.18
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpj`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `timestamp` datetime(6) NOT NULL,
  `deleted` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `activity`
--

INSERT INTO `activity` (`id_activity`, `id_user`, `activity`, `timestamp`, `deleted`) VALUES
(1, 1, 'tes', '2024-09-10 08:10:36.000000', '2024-09-04 13:10:36.000000'),
(2, 1, 'tes2', '2024-09-04 08:14:14.000000', '2024-09-04 08:14:14.000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_pendukung`
--

CREATE TABLE `file_pendukung` (
  `id_file` int(11) NOT NULL,
  `id_lpj` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file_pendukung`
--

INSERT INTO `file_pendukung` (`id_file`, `id_lpj`, `nama_file`, `file_path`, `uploaded_at`) VALUES
(1, 6, 'flora.pdf', 'C:\\lpj\\public\\img', '2024-09-10 02:52:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `deskripsi_kegiatan` text DEFAULT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `tempat_pelaksanaan` varchar(255) DEFAULT NULL,
  `tujuan_kegiatan` text DEFAULT NULL,
  `estimasi_anggaran` decimal(15,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `deskripsi_kegiatan`, `tanggal_pelaksanaan`, `tempat_pelaksanaan`, `tujuan_kegiatan`, `estimasi_anggaran`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'HUT-RI 2023/2024', 'perayaan hari ulang tahun republik indonesia tahun 2023/2024', '2024-09-02', 'SPH', 'meningkatkan nilai cinta tanah air ', '200.00', 1, '2024-09-05 03:47:00', '2024-09-10 06:47:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_lpj` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `isi_komentar` text DEFAULT NULL,
  `tanggal_komentar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_lpj`, `id_user`, `isi_komentar`, `tanggal_komentar`) VALUES
(1, 6, 1, 'Acara diselenggarakan dengan baik! ', '2024-09-11 03:51:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama`) VALUES
(1, 'admin'),
(2, 'kesiswaan'),
(3, 'kepala sekolah'),
(4, 'yayasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lpj`
--

CREATE TABLE `lpj` (
  `id_lpj` int(255) NOT NULL,
  `status_kesiswaan` varchar(255) NOT NULL,
  `status_kepala_sekolah` varchar(255) NOT NULL,
  `status_yayasan` varchar(255) NOT NULL,
  `status_lpj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lpj_kegiatan`
--

CREATE TABLE `lpj_kegiatan` (
  `id_lpj` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `hasil_kegiatan` text DEFAULT NULL,
  `laporan_keuangan` text DEFAULT NULL,
  `status_lpj` enum('menunggu persetujuan','disetujui','ditolak') DEFAULT 'menunggu persetujuan',
  `submitted_by` int(11) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lpj_kegiatan`
--

INSERT INTO `lpj_kegiatan` (`id_lpj`, `id_kegiatan`, `nama_kegiatan`, `hasil_kegiatan`, `laporan_keuangan`, `status_lpj`, `submitted_by`, `submitted_at`, `updated_at`) VALUES
(6, 1, 'mpls', 'sukses', 'l.pdf', 'disetujui', 1, '2024-09-11 03:48:55', '2024-09-12 05:02:25'),
(8, 1, 'fvzfr', 'vxsf', 'rwdrwg', 'menunggu persetujuan', 1, '2024-09-23 03:20:04', '2024-09-23 07:20:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mskdata`
--

CREATE TABLE `mskdata` (
  `id_mskdata` int(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `situs_kegiatan` varchar(255) NOT NULL,
  `tempat_kegiatan` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jam_mulai` time(6) NOT NULL,
  `jam_selesai` time(6) NOT NULL,
  `dana_keluar` varchar(255) NOT NULL,
  `proposal` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mskdata`
--

INSERT INTO `mskdata` (`id_mskdata`, `kegiatan`, `tanggal_kegiatan`, `situs_kegiatan`, `tempat_kegiatan`, `penyelenggara`, `keterangan`, `jam_mulai`, `jam_selesai`, `dana_keluar`, `proposal`, `created_at`) VALUES
(1, '17 Agustus', '2024-09-04', 'Hari nasional', 'sph', 'pak dedi', 'atribut lengkap', '03:00:00.000000', '05:00:00.000000', '200.000', 'cover.pdf', '2024-08-31 12:01:28.000000'),
(2, 'PSB', '2024-09-17', 'kegiatan sekolah', 'sph', 'pak dedi', 'atribut lengkap', '05:00:00.000000', '12:00:00.000000', '30.000', 'flora.pdf', '2024-08-29 23:45:58.000000'),
(3, 'Sertijab 2023/2024', '2024-09-11', 'kegiatan sekolah', 'sph', 'pak dedi', 'atribut lengkap', '02:00:00.000000', '03:00:00.000000', '400.000', 'flora.pdf', '2024-09-01 23:14:17.000000'),
(4, 'Hari Kartini', '2024-09-04', 'hari nasional', 'sph', 'pak dedi', 'atribut lengkap', '04:00:00.000000', '06:00:00.000000', '200.000', 'flora.pdf', '2024-09-18 00:09:32.000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_status`
--

CREATE TABLE `riwayat_status` (
  `id_riwayat` int(11) NOT NULL,
  `id_lpj` int(11) DEFAULT NULL,
  `status_sebelumnya` enum('menunggu persetujuan','disetujui','ditolak') DEFAULT NULL,
  `status_baru` enum('menunggu persetujuan','disetujui','ditolak') DEFAULT NULL,
  `tanggal_perubahan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_status`
--

INSERT INTO `riwayat_status` (`id_riwayat`, `id_lpj`, `status_sebelumnya`, `status_baru`, `tanggal_perubahan`) VALUES
(1, 6, 'ditolak', 'disetujui', '2024-09-10 02:53:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `role` enum('admin','anggota_osis','pembina') DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `password`, `no_telp`, `role`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'ultramen', 'ultramen@gmail.com', '1', '085268187777', 'admin', '', '2024-09-10 02:38:36', '2024-09-22 18:10:08'),
(3, 'pak dedi', 'dedi@gmail.com', '2', '085268187777', 'pembina', '', '2024-09-23 02:24:59', '2024-09-23 05:42:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`);

--
-- Indeks untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_lpj` (`id_lpj`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_lpj` (`id_lpj`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `lpj`
--
ALTER TABLE `lpj`
  ADD PRIMARY KEY (`id_lpj`);

--
-- Indeks untuk tabel `lpj_kegiatan`
--
ALTER TABLE `lpj_kegiatan`
  ADD PRIMARY KEY (`id_lpj`),
  ADD KEY `id_kegiatan` (`id_kegiatan`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `mskdata`
--
ALTER TABLE `mskdata`
  ADD PRIMARY KEY (`id_mskdata`);

--
-- Indeks untuk tabel `riwayat_status`
--
ALTER TABLE `riwayat_status`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_lpj` (`id_lpj`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activity` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lpj`
--
ALTER TABLE `lpj`
  MODIFY `id_lpj` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lpj_kegiatan`
--
ALTER TABLE `lpj_kegiatan`
  MODIFY `id_lpj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mskdata`
--
ALTER TABLE `mskdata`
  MODIFY `id_mskdata` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `riwayat_status`
--
ALTER TABLE `riwayat_status`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  ADD CONSTRAINT `file_pendukung_ibfk_1` FOREIGN KEY (`id_lpj`) REFERENCES `lpj_kegiatan` (`id_lpj`);

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_lpj`) REFERENCES `lpj_kegiatan` (`id_lpj`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `lpj_kegiatan`
--
ALTER TABLE `lpj_kegiatan`
  ADD CONSTRAINT `lpj_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `lpj_kegiatan_ibfk_2` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `riwayat_status`
--
ALTER TABLE `riwayat_status`
  ADD CONSTRAINT `riwayat_status_ibfk_1` FOREIGN KEY (`id_lpj`) REFERENCES `lpj_kegiatan` (`id_lpj`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
