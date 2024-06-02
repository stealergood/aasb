-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 10:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aasb`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `slogan`, `description`, `meta_description`, `meta_keyword`, `address`, `phone`, `email`, `website`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'Presensi', '', '', '', '', '', '', '', '    ', 'logo-176e.jpg', 'favicon-e1a8.png', '2022-10-31 11:17:57', '2022-10-31 11:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL,
  `level` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `name`, `username`, `password`, `image`, `level`) VALUES
(1, 'Administrator', 'admin', '$2y$10$zvsYF4hHuvUCC0Aa3ER0GeL1if8BuzgVa/mXaqivofVnFxjhX5pIq', '', '0'),
(6, 'coba', 'coba', '$2y$10$oRErMVFawxsSGFYvs95QcuLLontLDnzTr8qPKWBwOJomNErdILeyC', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aktifitas`
--

CREATE TABLE `tb_aktifitas` (
  `id_aktifitas` int(11) NOT NULL,
  `id_guru` int(5) NOT NULL,
  `id_mapel` int(5) DEFAULT NULL,
  `id_ekstrakurikuler` int(5) DEFAULT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_aktifitas`
--

INSERT INTO `tb_aktifitas` (`id_aktifitas`, `id_guru`, `id_mapel`, `id_ekstrakurikuler`, `status`) VALUES
(1, 1, 5, 5, '1'),
(2, 2, 6, 8, '1'),
(3, 3, 7, 9, '1'),
(5, 2, 5, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekstrakurikuler`
--

CREATE TABLE `tb_ekstrakurikuler` (
  `id_ekstrakurikuler` int(15) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_ekstrakurikuler`
--

INSERT INTO `tb_ekstrakurikuler` (`id_ekstrakurikuler`, `kode`, `nama`, `status`) VALUES
(5, '03231', 'Pramuka', '1'),
(6, '03232', 'Voli', '0'),
(7, '03233', 'Renang', '0'),
(8, '03234', 'Palang Merah Remaja', '1'),
(9, '03235', 'Sepak Bola', '1'),
(10, '03236', 'Karate', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_email`
--

CREATE TABLE `tb_email` (
  `id_email` varchar(15) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `isi_pesan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nip_guru` int(18) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip_guru`, `nama_guru`, `email`, `jenis_kelamin`, `jabatan`, `alamat`, `no_telepon`, `username`, `password`, `level`) VALUES
(1, 41656330, 'Indah, S.Pd', 'indah@gmail.com', 'P', 'Guru', 'Yogyakarta', '081156789102', 'indah', '$2y$10$ryki1m8WuIFMXol6qSqZ5OuuHkYvs3lje4fLo5hK9Ii3cPPesPgwq', NULL),
(2, 41607616, 'Marniyanti, S.Pd', 'marniyanti@gmail.com', 'P', 'Guru Kelas 1', 'Yogyakarta', '081274872344', 'guru', '$2y$10$1.T323RE6E.HbpppWYthies9eanMBggkoG6MlAFF/M8MwEalixefe', NULL),
(3, 38437606, 'Sulastri, A.Md', 'sulastri@gmail.com', '', 'Guru Kelas 2', 'Yogyakarta', '081274872343', 'sulastri', '$2y$10$QgUSZSQALChVzkgUc7B6Cegj7pt.Sq1U3YMJHRmsn5o1cVBlQbq7a', NULL),
(4, 19940619, 'Tri Kusuma Danayanti, S.Pd', 'trikusuma@gmail.com', 'Perempuan', 'Guru Kelas 3', 'Yogyakarta', '081274872342', 'trikusuma', 'trikusuma', NULL),
(5, 19850628, 'Heni Purwaningsih, S.Pd Sd', 'heni@gmail.com', '', 'Guru Kelas 4', 'Yogyakarta', '081274863548', 'heni', 'heni', NULL),
(6, 15870626, 'Eryuna Irmawati, S.Pd', 'eryuna@gmail.com', 'Perempuan', 'Guru Kelas 5', 'Yogyakarta', '08127843548', 'eryuna', 'eryuna', NULL),
(7, 19871208, 'Esti Sulaimah, S.Pd', 'esti@gmail.com', 'Perempuan', 'Guru Kelas 6', 'Yogyakarta', '08127843522', 'esti', 'esti', NULL),
(8, 15870626, 'Sri Lestari, S.Pd', 'sriles@gmail.com', 'Perempuan', 'Guru Olahraga', 'Yogyakarta', '08127800548', 'sriles', 'sriles', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin`
--

CREATE TABLE `tb_izin` (
  `id_izin` int(15) NOT NULL,
  `nis_siswa` int(15) NOT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `kelas` int(15) NOT NULL,
  `nip_guru` int(15) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `tanggal_izin` date NOT NULL,
  `jam_izin` varchar(20) DEFAULT NULL,
  `keterangan_izin` enum('H','I','S','A','T') NOT NULL,
  `file_izin` varchar(255) DEFAULT NULL,
  `jenis_file` varchar(255) DEFAULT NULL,
  `konfirmasi` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_izin`
--

INSERT INTO `tb_izin` (`id_izin`, `nis_siswa`, `nama_siswa`, `jenis_kelamin`, `kelas`, `nip_guru`, `nama_guru`, `tanggal_izin`, `jam_izin`, `keterangan_izin`, `file_izin`, `jenis_file`, `konfirmasi`, `created_at`) VALUES
(121, 1610121025, 'I Ketut Wira Cipta Putra', 'L', 1, 41607616, 'Marniyanti, S.Pd', '2023-02-02', '19:00 - 20:00', 'I', '300c62a3e6.jpg', 'jpg', 0, '2024-02-21 08:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(15) NOT NULL,
  `kode_kelas` int(15) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kode_kelas`, `nama_kelas`, `status`) VALUES
(1, 1, 'I / Satu', '1'),
(2, 2, 'II / Dua', '1'),
(3, 3, 'III / Tiga', '1'),
(4, 4, 'IV / Empat', '1'),
(5, 5, 'V / Lima', '1'),
(8, 6, 'VI / Enam', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepala_sekolah`
--

CREATE TABLE `tb_kepala_sekolah` (
  `id_kepala_sekolah` int(11) NOT NULL,
  `nip_kepala_sekolah` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `level` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_kepala_sekolah`
--

INSERT INTO `tb_kepala_sekolah` (`id_kepala_sekolah`, `nip_kepala_sekolah`, `name`, `email`, `alamat`, `username`, `password`, `status`, `level`) VALUES
(5, 19710616, 'Rahmat Pandoyo Susanto, M.Pd', 'rahmat@gmail.com', 'Bandingana bandung jawa barat	', 'Rahmat', '$2y$10$cU.w00TVUJmI9ELNnn72H.hb9WsXqZCHVvwLpgJoLaYQMHtsiPkgi', '1', NULL),
(6, 15866257, 'Samina,S.Pd.,M.Pd', 'samina@gmail.com', 'Bogor Jawa Barat', 'samina', '$2y$10$Mjf4cudq3PI15z4DjVIONOv8NOqPbeiP2NH9cQUoJwVeQmu0/2k/G', '0', NULL),
(7, 15888259, 'Firman Deas Antariksa.S.Pd.,M.Pd', 'firmandeas@gmail.com', 'Yogyakarta', 'firmandeas', '$2y$10$f2.1rEpW/e3pcmFE33L2dOVRHkhaMsDlEssFYhKT3bj2aLrWcGRFS', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_absensi`
--

CREATE TABLE `tb_log_absensi` (
  `id_presensi` int(15) NOT NULL,
  `id_mengajar` int(15) NOT NULL,
  `id_siswa` int(15) NOT NULL,
  `id_guru` int(15) NOT NULL,
  `id_kelas` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('H','I','S','A','T') NOT NULL,
  `pertemuan_ke` varchar(30) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `file_izin` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_log_absensi`
--

INSERT INTO `tb_log_absensi` (`id_presensi`, `id_mengajar`, `id_siswa`, `id_guru`, `id_kelas`, `tanggal`, `keterangan`, `pertemuan_ke`, `jam`, `file_izin`, `created_at`) VALUES
(95, 5, 24, 2, 1, '2024-01-29', 'A', '2', '09:00 - 10:00', 'a6b0182981.JPG', '2024-03-14 00:47:25'),
(96, 6, 25, 2, 1, '2024-01-29', 'H', '1', '07:00 - 08:00', NULL, '2024-03-14 00:48:34'),
(97, 6, 29, 2, 1, '2024-01-29', 'A', '1', '07:00 - 08:00', NULL, '2024-03-14 00:48:56'),
(99, 12, 28, 2, 1, '2024-10-10', 'I', '2', '09:00 - 10:00', '0f2070848a.JPG', '2024-03-14 09:22:29'),
(100, 5, 39, 2, 2, '2024-03-20', 'T', '1', '07:00 - 08:00', NULL, '2024-03-20 22:23:38'),
(102, 0, 25, 0, 1, '2024-03-27', 'H', '', 'undefined - undefine', NULL, '2024-03-27 15:29:05'),
(104, 0, 85, 0, 8, '2024-03-26', 'I', '', '', '87c33d2ca2.JPG', '2024-03-27 16:08:22'),
(106, 0, 62, 0, 4, '2024-03-14', 'I', '', '', 'da58064b57.JPG', '2024-03-28 04:26:58'),
(108, 0, 41, 0, 2, '2023-01-01', 'H', '', '', NULL, '2024-05-13 02:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_ekstrakurikuler`
--

CREATE TABLE `tb_log_ekstrakurikuler` (
  `id_form_ekstrakurikuler` int(15) NOT NULL,
  `id_ekstrakurikuler` int(15) NOT NULL,
  `id_siswa` int(15) NOT NULL,
  `id_kelas` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('H','I','S','A','T') NOT NULL,
  `pertemuan_ke` varchar(30) NOT NULL,
  `id_izin` int(15) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_log_ekstrakurikuler`
--

INSERT INTO `tb_log_ekstrakurikuler` (`id_form_ekstrakurikuler`, `id_ekstrakurikuler`, `id_siswa`, `id_kelas`, `tanggal`, `keterangan`, `pertemuan_ke`, `id_izin`, `created_at`) VALUES
(39, 8, 24, 1, '2024-03-03', 'A', '4', NULL, '2024-02-21 09:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(15) NOT NULL,
  `kode_mapel` int(15) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `kode_mapel`, `nama_mapel`, `status`) VALUES
(5, 1101, 'Matematika', '1'),
(6, 1102, 'Bahasa indonesia', '1'),
(7, 1103, 'Bahasa Arab', '1'),
(8, 1104, 'Bahasa Inggris', '1'),
(9, 1105, 'Pendidikan Agama Islam', '1'),
(10, 1106, 'Pendidikan Agama Kristen', '1'),
(11, 1107, 'Pendidikan Kewarganegaraan', '1'),
(12, 1108, 'Ilmu Pengetahuan Alam', '1'),
(13, 1109, 'Ilmu Pengetahuan Sosial', '1'),
(14, 1201, 'Seni Budaya dan Seni Rupa', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orang_tua`
--

CREATE TABLE `tb_orang_tua` (
  `id_orang_tua` int(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_orang_tua`
--

INSERT INTO `tb_orang_tua` (`id_orang_tua`, `name`, `alamat`, `no_telepon`, `email`, `username`, `password`, `level`) VALUES
(5, 'Naushad Kanezka', 'Bandingan wetan', '082243041272', 'hentreiza@gmail.com', 'orangtua', '$2y$10$JhN9q8BMZN0NH1e.QtEekOkcaUwbbQJv7oqUIill0f1OWLx2Lp0bO', NULL),
(6, 'Lanjar', 'Klaten', '085800644739', 'lanjar@gmail.com', 'lanjar', '$2y$10$IdKxpTDRBRYzOChggbrlcO5k8XmuJxq6M54a2k4hVUl8dPfP7YDcm', NULL),
(7, 'Sagiyem', 'Surakarta', '095800644730', 'sagiyem@gmail.com', 'sagiyem', '$2y$10$ticufHY9E/XeJlo/q1QJIeamRmZFjNAJ0xqPYvEXo6/YAu.hpENou', NULL),
(8, 'Ibnu Rasyid', 'Bogor ', '085777119069', 'rasyid@gmail.com', 'ibnurasyid', '$2y$10$gxWDxjl5kQRQVL2DKh.HwezM4Mqg2Vxcjl8U7VumVvrxg0V5Rycx2', NULL),
(9, 'Muhammad Irfan', 'Bogor', '085264528990', 'mirfan@gmail.com', 'mirfan', '$2y$10$Zakh6U.JNSnT9nuigZ//I.fwNKYy6IJzDbdmGZn1JaACrsQ2yt1Pe', NULL),
(10, 'Farhan Han', 'Sarawak', '601163865198', 'farhanhan@gmail.com', 'farhanhan', '$2y$10$EpoHNutMzTaHYAN/JXKaLeuHNJszXwKyJ0qkoeErMwDw8GIcHigTe', NULL),
(11, 'Abdul Rahmat', 'Konawe', '085319056914', 'abdul@gmail.com', 'abdulabdul', '$2y$10$S1Ey7oZY6C6thD1p.XzrxesZtRxyxfByagv699twdSvdkRR2c2/qy', NULL),
(12, 'Ferdi Ananta', 'Malang', '081805796693', 'ferdiananta@gmail.com', 'ananta', '$2y$10$9MSsAUP670nSin/8RO/.u.jPiWVsSgV2aiWsJ6pEhJFVtuMEa1fGm', NULL),
(13, 'Adhi Nugroho', 'Tangerang', '085717863176', 'adhinu@gmail.com', 'adhinu', '$2y$10$AVL16dhWAC.XjSAwiBNzbeo9o3c89QuPDUfLjYD72saLNJDCEUUtG', NULL),
(14, 'Akbar Muhammad', 'Jayapura', '085255240383', 'akbarmuh@gmail.com', 'akbar', '$2y$10$cAbr718hdAUzV7ewCWT8XOBsk4B7KB2jjHyGyo90ZSBoKXY6SDMl6', NULL),
(15, 'sudarma', 'Yogyakarta', '081274872340', 'sudarma@gmail.com', 'sudarma', '$2y$10$C0wtjXeDmVycTYjghRUMW.58NrNWiNi05DjDGJ4nSoP5fwSgbFodK', NULL),
(16, 'rio sukarno', 'Yogyakarta', '081274865443', 'riosukarno@gmail.com', 'sukarno', '$2y$10$wgG.Jj8FLR7/AECFqhbIS.yxDuoK/bhE.bwLdVi4b9qKbNxx2jg7S', NULL),
(17, 'farhan han', 'Yogyakarta', '081274863453', 'farhanhan@gmail.com', 'farhan', '$2y$10$W.4VOfXv44Z1.64jvvECqufbxrbAYdHYnjxu9WTxRByMMnw0iltcK', NULL),
(18, 'hariyanta', 'Yogyakarta', '087654333521', 'hariyanta@gmail.com', 'hariyanta', '$2y$10$lrQb8vX7Jhn5exX.SSGZ9eQBk/ZOlj8H0QyKV5Ng91k3NqQffOWkm', NULL),
(19, 'siti marfuah', 'Yogyakarta', '087653421222', 'sitimarfuah@gmail.com', 'sitimarfuah', '$2y$10$CENcXf7/d/CcqZ/ndEmL3u3wBhjKxlG041na8G3z8XK7qizrryZrS', NULL),
(20, 'fatma sri', 'yogyakarta', '087654444832', 'fatmasri@gmail.com', 'fatmasri', '$2y$10$iEIxkz.44IIm8zFliNLiCu4pniRvAVaCcJ0/xH8PCuwqnwYi6kMR2', NULL),
(21, 'imroatus', 'Yogyakarta', '087653198083', 'imroatus@gmail.com', 'imroatus', '$2y$10$KlV18mladheoh5S69UYYiecjPXm9kFsvrxR6f2NRtntiq28cmhv3S', NULL),
(22, 'ganin', 'yogyakarta', '085224765412', 'ganin@gmail.com', 'ganin', '$2y$10$nJnvjdve/ZPGCa4QsSExkuWO9x/yRl1P7EEXorYyyluMiGBmeigBS', NULL),
(23, 'mahendra', 'Yogyakarta', '081233456712', 'mahendra@gmail.com', 'mahendra', '$2y$10$u3hX0EULZYXqVfABv8iMgOLy709pBehfatmizrWmnZU5BqfVOJ3M.', NULL),
(24, 'Nuzullah waluyo', 'Yogyakarta', '081274872399', 'nuzullah@gmail.com', 'nuzullah', '$2y$10$rGF9ceyWFjW5.j91lwulGe5G8rVfoTYLyYwYiBHI0JXoek3Hp5ttG', NULL),
(25, 'safitri', 'yogyakarta', '085224765400', 'safitri@gmail.com', 'safitri', '$2y$10$F.OurCnSw47wGoQF370GNOZI2WYEibaPYjs4gFrKG/BV5NL2bfKFC', NULL),
(26, 'budimantoro', 'Yogyakarta', '081765432112', 'budimantoro@gmail.com', 'budimantoro', '$2y$10$BnhMSGHQ4SY0pMmdA3PSm..4/HMTiYohmyw9SbQza/HszOhblbEW6', NULL),
(27, 'hamzah', 'Yogyakarta', '087653198081', 'hamzah@gmail.com', 'hamzah', '$2y$10$HbXPzSMzKUvjnqIjEDjV4ufoZ2la3hvw4wAKSkb./AvD5MGR/mMaW', NULL),
(28, 'ahmad sofi', 'yogyakarta', '086098766555', 'ahmadsofi@gmail.com', 'ahmad sofi', '$2y$10$TPK1UkvyUz3N6YgvIeOzfOKFrnRy/zDGENduVubCGe2.pTPdz7tSy', NULL),
(29, 'halimah', 'yogyakarta', '008097879078', 'halimah@gmail.com', 'halimah', '$2y$10$h.do92if4c5ZmVkFxj59j.N2PCtYDJ59NTmwtt5QSVaqbr187xDjC', NULL),
(30, 'mustofa', 'salatiga', '085319056941', 'mustofa@gmail.com', 'mustofa', '$2y$10$K3FUxDuQ86B6Es0x9lJtkuGabUhSp4yA12/LLIFbwzbfHdGjOgBcW', NULL),
(31, 'santosa', 'Yogyakarta', '085800644740', 'santosa@gmail.com', 'santosa', '$2y$10$QJeeavOTqRzWKLFrY02uAufzdAZXuQnGVtuCOWcRuOCxZYPOitXoe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `tahun_semester` varchar(8) NOT NULL,
  `status_semester` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_semester`
--

INSERT INTO `tb_semester` (`id_semester`, `semester`, `tahun_semester`, `status_semester`) VALUES
(10, 'Genap/2023', '2020', '1'),
(12, 'Ganjil/2023', '', '1'),
(13, 'Genap/2022', '', '1'),
(14, 'Ganjil/2022', '', '1'),
(15, 'Genap/2021', '', '1'),
(16, 'Ganjil/2021', '', '1'),
(17, 'Genap/2020', '', '1'),
(18, 'Ganjil/2020', '', '1'),
(19, 'Genap/2019', '', '1'),
(20, 'Ganjil/2019', '', '1'),
(21, 'Genap/2018', '', '1'),
(22, 'Ganjil/2018', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis_siswa` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(9) DEFAULT NULL,
  `id_orang_tua` int(15) NOT NULL,
  `id_guru` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis_siswa`, `name`, `kelas`, `jenis_kelamin`, `alamat`, `tahun_masuk`, `username`, `password`, `level`, `id_orang_tua`, `id_guru`) VALUES
(24, '1610121022', 'Kadek Ngurah Dananjaya', '1', 'L', 'Yogyakarta', 2023, 'kadek', '$2y$10$ZNRpzHnYBN4srSl3EI0e4O6OXZiE2a1jJg2.uE0XXu/MK/KPmNCEe', NULL, 5, 2),
(25, '1610121023', 'Ni Putu Agustin Cintya Dewi', '1', 'P', 'Yogyakarta', 2023, 'putu', '$2y$10$TbKYl2jsQl7RIjZuV9yh5OmAnLFcMwM7qbT0o7y/OiCMQMcHNTy9S', NULL, 6, 2),
(26, '1610121024', 'Ni Nyoman Ayu Ratih', '1', 'P', 'Yogyakarta', 2023, 'nyoman', '$2y$10$CK7ACFimge.oOVg6YPNZ5uNM9z5jTuyn1z7BiWr8Kt21FIkIjTURi', NULL, 7, 2),
(27, '1610121025', 'I Ketut Wira Cipta Putra', '1', 'L', 'Yogyakarta', 2023, 'ketut', '$2y$10$fQQwfVq0zm6tJ.BzCTJyUuMaVcfKCUchYnCEtlBeX/vm9xF7DfjCa', NULL, 8, 2),
(28, '1610121026', 'Dewa Ade Marcelian Pande', '1', 'L', 'Yogyakarta', 2023, 'dewa', '$2y$10$3i.vJqyEBI1iakqTqWMRr.R6hmE1OY4BntLL9uG6sV4XwqZ/C3Pbu', NULL, 9, 2),
(29, '1610121027', 'Garida Saherma Pradana', '1', 'L', 'Yogyakarta', 2023, 'saherma', '$2y$10$NVNLJ/swH.z1UOTRVdwW/eZg/YF0ycsSKnXqERcBKurb7Cn6FxJle', NULL, 10, 2),
(30, '1610121028', 'Angelita Putri', '1', 'P', 'Yogyakarta', 2023, 'angelita', '$2y$10$YmnFHocS1/PXU2Y1nUeepON1Bi/ZeYmvSS5MXuidK88Q/yUoulN7G', NULL, 11, 2),
(31, '1610121029', 'Andita Okta Mahendra', '1', 'P', 'Yogyakarta', 2023, 'andita', '$2y$10$88160DUXm0aPRFG.n9RXY.zZXPo5xLDn3IPbTynk7.9KuS.l/l9R.', NULL, 12, 2),
(32, '1610121030', 'Febrian Raditya Pratama', '1', 'L', 'Yogyakarta', 2023, 'febrian', '$2y$10$vNMXLlBAkefZsIEyny.qceZH9AFf6Q8nP2h4peXAQv9JQE6.dTnoG', NULL, 13, 2),
(33, '1610121031', 'Agus Nohana Darma', '1', 'L', 'Yogyakarta', 2023, 'nohana', '$2y$10$2LdXx5pTD9JrCJsOlFc5F.VOUhIGaLx4dkWRjX//Y2xXA1b0UbZQ2', NULL, 14, 2),
(34, '150621604771', 'Junico Putra Ardianto', '2', 'L', 'Yogyakarta', 2022, 'junico', '$2y$10$ZGBnNf89dnf0VWbIcLcPXOUhJwwngOaRBdCTeRO11hs4LCrHckO/y', NULL, 5, 1),
(35, '150621604772', 'Cheldy Bagus Firmansyah', '2', 'L', 'Yogyakarta', 2022, 'cheldy', '$2y$10$vuVdZh8O0T.wLbTM2hJJQOTkM.bdZ3xeUoC7QB1tcwAeagpWgywBC', NULL, 5, 1),
(36, '150621604773', 'Azza Daffa Hakiki', '2', 'L', 'Yogyakarta', 2022, 'azza', '$2y$10$oD3rO5snQ9E8ffKXvwqd3.9HWDbh2AEfoMcvjZZbFBFUKHQHTT3fS', NULL, 5, 1),
(37, '150621604774', 'Uvi Datus Sufria', '2', 'P', 'Yogyakarta', 2022, 'uvi', '$2y$10$cMNYUWFOTkzVnSuELqgLguv0XipqzGidv3OAaNHqS/Dd3BbeuUcDa', NULL, 5, 1),
(38, '150621604775', 'Amirah Mirleva Fatmala', '2', 'P', 'Yogyakarta', 2022, 'amirah', '$2y$10$O.Bb15WISNn7xrI0zlxlI.5B5nLy3eb9p0tGd2aKarcP26PaDwjNK', NULL, 5, 1),
(39, '150621604776', 'Titin Irzatul Rahmawati', '2', 'P', 'Yogyakarta', 2022, 'titin', '$2y$10$KrWnI1/OVo94sVOiTUy1ve.oNQeq0iwK3xBmxzeuHLk/Db5AfpfSG', NULL, 5, 1),
(40, '150621604777', 'Ziyannur Fatimah', '2', 'P', 'Yogyakarta', 2022, 'ziyyannur', '$2y$10$utNwEc37OFGIwqpltvJni.Lum3.lSB/SbFg1ohorPETs8jKm8Eyv6', NULL, 5, 1),
(41, '150621604778', 'Mumus Fika Rochmad', '2', 'L', 'Yogyakarta', 2022, 'mumus', '$2y$10$7Ps7e5dh9EiNyBGDiIr9Y.lwxMFWXdBpss5ogUMfoYywr2VSuvFBm', NULL, 5, 1),
(42, '150621604779', 'Indriati Sholiha', '2', 'P', 'Yogyakarta', 2022, 'indri', '$2y$10$AkMHSxB2JkTvNvileD0nAejwped7UXiiIdhc7.PBBzh9.FmpgIXpi', NULL, 5, 1),
(43, '150621604781', 'Firdaus Nuzullah', '2', 'L', 'Yogyakarta', 2022, 'firdaus', '$2y$10$Jhbslye5vW8igWHlG8pDYO9R9wj4rw14SatSRHbx1gJIAQ9Tftr2a', NULL, 5, 1),
(44, '1693141030', 'Anggie Maulinajaya', '3', 'P', 'Yogyakarta', 2021, 'anggie', '$2y$10$LcA2r.kNJeG8FFgHlN041.0VDitbsNES./hnjBv8Vya8YNku6J8Q2', NULL, 5, 1),
(45, '1693141031', 'Ernawati Budiman', '3', 'P', 'Yogyakarta', 2021, 'ernawati', '$2y$10$6KtitCivIeQzUrrL1bhwm.Si4b4WlyYglesRatqOxyTPjT//yRI4u', NULL, 5, 1),
(46, '1693141032', 'Muhammad Faiz Hamzah', '3', 'L', 'Yogyakarta', 2021, 'faiz', '$2y$10$zWbpFhvNcsB5Zj.eD5M3d.tQ1PBScd2Hwy1eN8vAZE3Mr/XrIc8cS', NULL, 5, 1),
(47, '1693141033', 'Suciawan Putra Fajar', '3', 'L', 'Yogyakarta', 2021, 'putra', '$2y$10$15/BeqeU6xZ2PJ6Pi7eY8eiOsn.cSmO7q8IQuff1la0ODnW2Wi8vm', NULL, 5, 1),
(48, '1693141034', 'Muhammad Asrul Darwiz', '3', 'L', 'Yogyakarta', 2021, 'asrul', '$2y$10$WnDfYEVhTq/nfxPuaCWPRe9Bu9NmmVCU4TbJTQU0M8f4sizxh9e4S', NULL, 5, 1),
(49, '1693141035', 'Sulfanibaso', '3', 'L', 'Yogyakarta', 2021, 'sulfanibaso', '$2y$10$vs7p/3qxo7pEmSki.ijYaeI.ee/b4lkeSgDeYFOaAJP/4zZZiyhoa', NULL, 5, 1),
(50, '1693141036', 'Norma Titania Maurinea', '3', 'P', 'Yogyakarta', 2021, 'norma', '$2y$10$RzftSEjXRRm5tdWn46PaX.FAJ7Ybc1YdfrGRRb3A2m6r7YjGR1VPm', NULL, 5, 1),
(51, '1693141038', 'Yahya Alkahfi Ahmad', '3', 'L', 'Yogyakarta', 2021, 'yahya', '$2y$10$dybCRlBO4psIffdXRXGOvuI7JMoeQ0mk8vfjdtkklB5k7er7KBVp6', NULL, 5, 1),
(52, '1693141039', 'Kasniati Sri Lestari', '3', 'P', 'Yogyakarta', 2021, 'kasniati', '$2y$10$WwNyeP4ptjutTrv3trmhuOwcJH.qOz5AOMKNI6n1t.e.v.RzPnS92', NULL, 5, 1),
(53, '1693141040', 'Putri Lestari', '3', 'P', 'Yogyakarta', 2021, 'putri', '$2y$10$Pc4GMCmKkOi0Tkp5jh3X5OkEm70utZ3SDFsBfUrOnL3eE2vuvU9Bm', NULL, 5, 1),
(54, '14116031001', 'Meisy Darisma', '4', 'P', 'Yogyakarta', 2020, 'meisy', '$2y$10$Wna9cuOHcTwJEbUNOJPQ.O/bQE4U7V9NoLaj677WJxxrPn8vNWlfW', NULL, 5, 1),
(55, '14116031002', 'Auliya Achpriyanti', '4', 'P', 'Yogyakarta', 2020, 'auliya', '$2y$10$s2oi7qaPWzsxYgwT43bJzu1ZziSUg02dsSYO8kiIBIogZG0isT6uW', NULL, 5, 1),
(56, '14116031003', 'Gilang Agrin Syam', '4', 'L', 'Yogyakarta', 2020, 'gilang', '$2y$10$alfdW/8ItSJNkR./.Xk0uuxnp4BJk7eM02n2ev3w7W3b8JEam0il.', NULL, 5, 1),
(57, '14116031004', 'Gilang Fathony Ramadhan', '4', 'L', 'Yogyakarta', 2020, 'fathony', '$2y$10$eOjZLrSPK5b1YheAUe6QlOrAuq.D6d5JxigqK46EvQIUCCdE9NWiW', NULL, 5, 1),
(58, '14116031005', 'Imdah Maulina Rugayah', '4', 'P', 'Yogyakarta', 2020, 'imdah', '$2y$10$xW1F7/qyjw8nh.Xj63mV3Ooesw9CPjNjs1NGuCd00bMorVj/nL2NO', NULL, 5, 1),
(59, '14116031006', 'Firman Tantris Hariyanto', '4', 'L', 'Yogyakarta', 2020, 'firman', '$2y$10$Mw7V6D9R4uPs8cRlQk4uXO5xmxYkWhslsZU8l8E9P9bFFC038sUKa', NULL, 5, 1),
(60, '14116031007', 'Hendra Adi Saputra', '4', 'L', 'Yogyakarta', 2020, 'hendra', '$2y$10$0lJjWK8PbaD.hV83xAFaG.bF4p3/QnULaK7lxKiL/Wb9F8gipWuUK', NULL, 5, 1),
(61, '14116031008', 'Uswatun Khasanah', '4', 'P', 'Yogyakarta', 2020, 'uswatun', '$2y$10$/E4pJTTqqmDxnGbueu/ha.gAI1Mx4cWHZyZpH8gvXqlvB4ljfzcGS', NULL, 5, 1),
(62, '14116031009', 'Andin Siti Fatimah', '4', 'P', 'Yogyakarta', 2020, 'andin', '$2y$10$Kh2QNQ/01SuCNYTNtvuZb..Z3HxqRVvMmVALlEWXqBIyyYK05Afkm', NULL, 5, 1),
(63, '14116031011', 'Didot Firmanto', '4', 'L', 'Yogyakarta', 2020, 'didot', '$2y$10$7ZPlDa04zOdfELoSbxbsJ.QgkQcFa4HOpoCfs8CrCI4FY3Ub4pEfu', NULL, 5, 1),
(64, '150544606781', 'Agustin Nova Setyo Wahyudi', '5', 'P', 'Yogyakarta', 2019, 'nova', '$2y$10$A1sTYFyHjl0wXmW8uJhLHeTaJdg.TOZfXNtjGfhp825ivD9cAQomi', NULL, 5, 1),
(65, '150544606782', 'Basmalatyn Beinnyah', '5', 'L', 'Yogyakarta', 2019, 'basmalatyn', '$2y$10$Gl//NfGpj2Rgt/i4riObgOh4sHOZC/VmHJcWBOdvfj4gzt/UUyHbe', NULL, 5, 1),
(66, '150544606783', 'Abdul Faris Pratamayudha', '5', 'L', 'Yogyakarta', 2019, 'abdul', '$2y$10$RtTjzhQbPsFHqI28O.0huugw8Qp2leaT.u7lSwuUqC/zxTllHNAJy', NULL, 5, 1),
(67, '150544606784', 'Febricionita Judha Ekapasti Saragih', '5', 'P', 'Yogyakarta', 2019, 'ekapasti', '$2y$10$NnnxArYvm/V/BUKNA68osuBgsBUjMjKYtYMU1336/a7YodZPSXyda', NULL, 5, 1),
(68, '150544606785', 'Brisia Jodi', '5', 'P', 'Yogyakarta', 2019, 'brisia', '$2y$10$vDZ8SDG8to6kFPTdPht5k.yeBLDipkcYFAhtq7SvymB2ywS6Le1L6', NULL, 5, 1),
(69, '150544606786', 'Syifa Hadiningputri', '5', 'P', 'Yogyakarta', 2019, 'syifa', '$2y$10$di2c2OCHETRmiya1zS84gugEzv7/TL2JgIR/hKK1Sifw9ZcjUUXx2', NULL, 5, 1),
(70, '150544606787', 'Firly Lily Purwaniarti', '5', 'P', 'Yogyakarta', 2019, 'firly', '$2y$10$JnWwDMiTDMFh0pjPhZxQb.CUFJ1fVOuPBsIluiGDRZrXGxeunBdlO', NULL, 5, 1),
(71, '150544606788', 'Lemoneigh Richi', '5', 'L', 'Yogyakarta', 2019, 'richi', '$2y$10$uHHLqG4XFFo.NM/IGxVTg.udJg1wBK4.Bbmh3QIR1lrE9cPLE7V7q', NULL, 5, 1),
(72, '150544606789', 'Saka Prana Maryadi', '5', 'L', 'Yogyakarta', 2019, 'saka', '$2y$10$dzVxvTOuh3NuITY5k1Gi4eudPE3kIEdfrmar2uLVb.GQlQEt.0uz2', NULL, 5, 1),
(73, '150544606780', 'Anwar Iftitahul Haq', '5', 'L', 'Yogyakarta', 2019, 'anwar', '$2y$10$aP5sW95j7Hl/AePgLo4avuaKZElauYa91.PlEmVSIZeuOuUu.stae', NULL, 5, 1),
(74, '1270322441', 'Bangkit Fajar Gabareto', '8', 'L', 'Yogyakarta', 2018, 'bangkit', '$2y$10$RDTULr4NcZrJqAsUirmXXeYVVyqh0ocYOBmAO9HNFu.4jL2rfGQU.', NULL, 5, 1),
(75, '1270322442', 'Anang Apriyanto', '8', 'L', 'Yogyakarta', 2018, 'anang', '$2y$10$FGhbnT3tFRWoj2gfBte35.nohac8cxvp4l3Jt5PKxXS1Ev8HLiBUS', NULL, 5, 1),
(76, '1270322443', 'Yeko Anugrah Yanuar', '8', 'L', 'Yogyakarta', 2018, 'yeko', '$2y$10$VBYqheZRNTSg0HFL6WmgTuh4wKOF0GNr6P.4J4nad8h.9fezmGkHW', NULL, 5, 1),
(77, '1270322444', 'Dewi Maryani', '8', 'P', 'Yogyakarta', 2018, 'dewi', '$2y$10$1ELxzftSCD5u620IYTxAe.Jp1BrpLhq348TfEqBDqPC.h96zwcrYm', NULL, 5, 1),
(78, '1270322445', 'Nendes Widyianin Utami', '8', 'P', 'Yogyakarta', 2018, 'nendes', '$2y$10$gsNYSkrmh.x1Qyl2CVwCWeSqryQ/XE7ZqYN0X3w1xSx4j450E7FtO', NULL, 5, 1),
(79, '1270322446', 'Hafsari Putu Dewinifi', '8', 'P', 'Yogyakarta', 2018, 'hafsari', '$2y$10$9.L4rvmVr4sHlG0OguYHmODEuMNc30I7ldr4PFAiu/dpxPqQu.xPO', NULL, 5, 1),
(80, '1270322447', 'Detty Risma Amalia', '8', 'P', 'Yogyakarta', 2018, 'detty', '$2y$10$zNuHqEasliRmAWIQhvfj5OibwmtlEhZ1XTHYtodaGOf8wCYVIvjHq', NULL, 5, 1),
(81, '1270322448', 'Andreas Parulian', '8', 'L', 'Yogyakarta', 2018, 'andreas', '$2y$10$t0/0HJ0Z1SIOscCMLwswnOhq4VMfCfDmal79CojCVjKhCKLLslH5O', NULL, 5, 1),
(82, '1270322449', 'Naufal Rohadatul Aisy Al Alamin', '8', 'L', 'Yogyakarta', 2018, 'naufal', '$2y$10$do65kGuXa2kYtIm2q/GzlOlT6mm9dtQQNGq1H.WVGcPgY1Z/qM01O', NULL, 5, 1),
(83, '1270322440', 'Kemal Awanda Yodhi', '8', 'L', 'Yogyakarta', 2018, 'kemal', '$2y$10$YSHdT7GB4cj6nqmwSCinHOaHi3MnCd56Z12HB8N6zLsA67ytnJE.K', NULL, 5, 1),
(85, '12345', 'Yoyo Arjanti', '8', 'L', 'yogya', 2024, 'yoyo', '$2y$10$3RUxl8dGAy8IFbMzS88Tu.xbVjdHevfdN56AftUC7knI0iyo8wvzS', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun_ajaran`
--

CREATE TABLE `tb_tahun_ajaran` (
  `id_tahun_ajaran` int(15) NOT NULL,
  `tahun_ajaran` int(15) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_tahun_ajaran`
--

INSERT INTO `tb_tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `status`) VALUES
(8, 2023, '1'),
(9, 2022, '1'),
(10, 2021, '1'),
(11, 2020, '1'),
(12, 2019, '1'),
(13, 2018, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`) USING BTREE;

--
-- Indexes for table `tb_aktifitas`
--
ALTER TABLE `tb_aktifitas`
  ADD PRIMARY KEY (`id_aktifitas`);

--
-- Indexes for table `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  ADD PRIMARY KEY (`id_ekstrakurikuler`) USING BTREE;

--
-- Indexes for table `tb_email`
--
ALTER TABLE `tb_email`
  ADD PRIMARY KEY (`id_email`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`) USING BTREE;

--
-- Indexes for table `tb_izin`
--
ALTER TABLE `tb_izin`
  ADD PRIMARY KEY (`id_izin`) USING BTREE;

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`) USING BTREE;

--
-- Indexes for table `tb_kepala_sekolah`
--
ALTER TABLE `tb_kepala_sekolah`
  ADD PRIMARY KEY (`id_kepala_sekolah`) USING BTREE;

--
-- Indexes for table `tb_log_absensi`
--
ALTER TABLE `tb_log_absensi`
  ADD PRIMARY KEY (`id_presensi`) USING BTREE;

--
-- Indexes for table `tb_log_ekstrakurikuler`
--
ALTER TABLE `tb_log_ekstrakurikuler`
  ADD PRIMARY KEY (`id_form_ekstrakurikuler`) USING BTREE;

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`) USING BTREE;

--
-- Indexes for table `tb_orang_tua`
--
ALTER TABLE `tb_orang_tua`
  ADD PRIMARY KEY (`id_orang_tua`) USING BTREE;

--
-- Indexes for table `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`id_semester`) USING BTREE;

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`) USING BTREE;

--
-- Indexes for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_aktifitas`
--
ALTER TABLE `tb_aktifitas`
  MODIFY `id_aktifitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  MODIFY `id_ekstrakurikuler` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_izin`
--
ALTER TABLE `tb_izin`
  MODIFY `id_izin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kepala_sekolah`
--
ALTER TABLE `tb_kepala_sekolah`
  MODIFY `id_kepala_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_log_absensi`
--
ALTER TABLE `tb_log_absensi`
  MODIFY `id_presensi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tb_log_ekstrakurikuler`
--
ALTER TABLE `tb_log_ekstrakurikuler`
  MODIFY `id_form_ekstrakurikuler` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_orang_tua`
--
ALTER TABLE `tb_orang_tua`
  MODIFY `id_orang_tua` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
