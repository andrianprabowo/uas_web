-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jul 2025 pada 08.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uasandrian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nama_dosen`, `nip`, `email`, `no_hp`, `jurusan`) VALUES
(1, 'Dr. Andrian Prabowo', '19800101', 'andrian@kampus.ac.id', '08123456789', 'Teknik Informatika'),
(2, 'Sinta Dewi, M.Kom', '19810302', 'sinta@kampus.ac.id', '08127891234', 'Sistem Informasi'),
(3, 'Joko Santoso, S.T., M.T.', '19791211', 'joko@kampus.ac.id', '08132211223', 'Teknik Komputer'),
(5, 'Taufik Hidayat, M.Kom', '19821121', 'taufik@kampus.ac.id', '08136678899', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_kuliah`
--

CREATE TABLE `info_kuliah` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `informasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `info_kuliah`
--

INSERT INTO `info_kuliah` (`id`, `tanggal`, `informasi`) VALUES
(1, '2025-05-10', 'Ujian Akhir Semester (UAS) akan dilaksanakan pada tanggal 10 Mei 2025.'),
(2, '2025-06-15', 'Libur Semester dimulai pada tanggal 15 Juni 2025.'),
(3, '2025-07-01', 'Pendaftaran mata kuliah semester depan dimulai pada tanggal 1 Juli 2025.'),
(4, '2025-08-20', 'Batas akhir pengumpulan tugas besar pada tanggal 20 Agustus 2025.'),
(5, '2025-09-05', 'Perkuliahan semester ganjil dimulai pada 5 September 2025.'),
(6, '2025-10-17', 'Seminar proposal TA akan dilaksanakan pada 17 Oktober 2025.'),
(7, '2025-11-01', 'Batas akhir KRS revisi adalah 1 November 2025.'),
(8, '2025-12-10', 'UTS Semester Ganjil dimulai pada tanggal 10 Desember 2025.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `prodi`) VALUES
('123456789', 'Budi', 'Jakarta', 'Informatika'),
('987654321', 'Sari', 'Bandung', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `mata_kuliah` varchar(100) DEFAULT NULL,
  `jam_kuliah` varchar(50) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `mata_kuliah`, `jam_kuliah`, `sks`, `nama_dosen`, `hari`) VALUES
(1, 'MIKROPROCESSOR & BHS. RAKITAN', '08:00 - 10:00', 3, 'Dr. Andrian', 'Senin'),
(2, 'INTERAKSI MANUSIA DAN KOMPUTER', '10:00 - 12:00', 3, 'Prabowo, S.T.', 'Senin'),
(3, 'TEORI BAHASA DAN AUTOMATA', '13:00 - 15:00', 3, 'Ibu Rina', 'Selasa'),
(4, 'PEMROGRAMAN WEB LANJUTAN', '15:00 - 17:00', 2, 'Bapak Joko', 'Selasa'),
(5, 'BASIS DATA LANJUT', '08:00 - 10:00', 2, 'Dr. Sinta', 'Rabu'),
(6, 'INTERPERSONAL SKILL', '10:00 - 12:00', 2, 'Ibu Nita', 'Rabu'),
(7, 'BAHASA JEPANG II', '13:00 - 15:00', 2, 'Sensei Hiro', 'Kamis'),
(8, 'PENDIDIKAN KEWARGANEGARAAN', '15:00 - 17:00', 2, 'Bapak Taufik', 'Kamis'),
(9, 'PRAKTIKUM PEMROGRAMAN WEB LANJUTAN', '08:00 - 09:00', 1, 'Ibu Dewi', 'Jumat'),
(10, 'PRAK. MIKROPROCESSOR & BHS. RAKITAN', '09:00 - 10:00', 1, 'Dr. Andrian', 'Jumat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nama_lengkap`) VALUES
(1, 'andrianprabowo22@gmail.com', '$2y$10$b5RhzdYXpdZALmc4OVhWpOBwKvHFj.MUBGBHorRfDcGRfamuqree.', 'andrian prabowo');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `info_kuliah`
--
ALTER TABLE `info_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `info_kuliah`
--
ALTER TABLE `info_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
