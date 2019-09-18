-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Sep 2019 pada 07.08
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `configuration`
--

CREATE TABLE `configuration` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelompok_keahlian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosentemp`
--

CREATE TABLE `dosentemp` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inisial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wewenang_pembimbing` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dosentemp`
--

INSERT INTO `dosentemp` (`id`, `nama`, `user_id`, `nip`, `inisial`, `wewenang_pembimbing`, `created_at`, `updated_at`) VALUES
(1, 'Dr.Techn. Muhammad Zuhri Catur Candra ST,MT', 2, '197709212010121002', 'MZC', 1, '2018-07-17 02:48:32', '2018-07-17 02:48:32'),
(2, 'Dr.Techn. Saiful Akbar ST,MT', 3, '197405091998031002', 'SA', 1, '2018-07-17 04:21:08', '2018-07-17 04:21:08'),
(3, 'Dr.Fazat Nur Azizah, ST., M.Sc.', 4, '197702102009122001', 'FNA', 1, '2018-07-17 04:23:28', '2018-07-17 04:23:28'),
(4, 'Dr. Dessi Puji Lestari, ST., M.Eng.', 5, '197912012012122005', 'DPL', 1, '2018-07-17 04:35:40', '2018-07-17 04:35:40'),
(5, 'Prof. Dr.Ing.Ir. Benhard Sitohang', 6, '195407161980111001', 'BS', 1, '2018-07-17 08:50:38', '2018-07-17 08:50:38'),
(6, 'Dr. Bayu Hendradjaya, ST.,MT.', 7, '196907291998021001', 'BY', 1, '2018-07-17 08:52:23', '2018-07-17 08:52:23'),
(7, 'Prof. Dr.Ing.Ir. Iping Supriana Suwardi', 8, '195206131979031004', 'IS', 1, '2018-07-17 08:55:52', '2018-07-17 08:55:52'),
(8, 'Prof. Ir. Dwi Hendratmo W., M.Sc., Ph.D.', 9, '196812071994021001', 'DHW', 1, '2018-07-17 08:57:42', '2018-07-17 08:57:42'),
(9, 'Dr.Eng. Ayu Purwarianti, ST., MT.', 10, '197701272008012011', 'AP', 1, '2018-07-17 08:59:29', '2018-07-17 08:59:29'),
(10, 'Achmad Imam Kistijantoro, ST, M.Sc., Ph.D.', 11, '197308092006041001', 'AI', 1, '2018-07-17 09:01:35', '2018-07-17 09:01:35'),
(11, 'Dr. Ir. Gusti Ayu  Putri Saptawati, M.Comm.', 12, '196509241995012001', 'PS', 1, '2018-07-17 09:10:55', '2018-07-17 09:10:55'),
(12, 'Dr.Masayu Leylia Khodra, ST., MT.', 13, '197604292008122001', 'MLK', 1, '2018-07-17 09:17:07', '2018-07-17 09:17:07'),
(13, 'Adi Mulyanto, ST., MT.', 14, '196311261988031002', 'AM', 1, '2018-07-17 09:18:20', '2018-07-17 09:18:20'),
(14, 'Ir. Afwarman, M.Sc.,Ph.D.', 15, '196209121988111001', 'AF', 1, '2018-07-17 09:20:05', '2018-07-17 09:20:05'),
(15, 'Ir. Windy Gambetta', 16, '196404301989031005', 'WG', 1, '2018-07-17 09:25:12', '2018-07-17 09:25:12'),
(16, 'Dody Dharma, ST., MT.', 17, '198808092015041001', 'DD', 1, '2018-07-17 09:25:52', '2018-07-17 09:25:52'),
(17, 'Dr.Ir. Rila Mandala, M.Eng.', 18, '196808031993021001', 'RM', 1, '2018-07-17 09:26:04', '2018-07-17 09:26:04'),
(18, 'Dra. Harlili, M.Sc.', 19, '195711231984032001', 'HLL', 1, '2018-07-17 09:26:55', '2018-07-17 09:26:55'),
(19, 'Dr. Ir. Judhi Santoso, M.Sc.', 20, '196302041989031002', 'JS', 1, '2018-07-17 09:28:52', '2018-07-17 09:28:52'),
(20, 'Ir. Kridanto Surendro, M.Sc.,Ph.D.', 21, '196408121991021001', 'KS', 1, '2018-07-17 09:30:37', '2018-07-17 09:30:37'),
(22, 'Tricya Widagdo, ST., M.Sc.', 23, '197109071997022001', 'TW', 1, '2018-07-17 09:31:50', '2018-07-17 09:31:50'),
(23, 'Dr. Nur Ulfa Maulidevi, ST., M.Sc.', 24, '197603092008012010', 'NUM', 1, '2018-07-17 09:33:12', '2018-07-17 09:33:12'),
(24, 'Yani Widyani, ST., MT.', 25, '197001071997022001', 'YW', 1, '2018-07-17 09:34:20', '2018-07-17 09:34:20'),
(25, 'Riza Satria Perdana, ST., MT.', 26, '197006091995121002', 'RSP', 1, '2018-07-17 09:56:00', '2018-07-17 09:56:00'),
(27, 'Dr. Ir. Rinaldi, MT.', 28, '196512101994021001', 'RN', 1, '2018-07-25 05:15:36', '2018-07-25 05:15:36'),
(28, 'Yudistira Dwi Wardhana Asnar, ST., Ph.D.', 29, '198008272015041002', 'YA', 1, '2018-07-25 05:16:44', '2018-07-25 05:16:44'),
(29, 'Dr.techn. Wikan Danar Sunindyo, ST,M.Sc.', 30, '197701102014041001', 'WD', 1, '2018-07-25 05:17:37', '2018-07-25 05:17:37'),
(30, 'Fitra Arifiansyah, S.Kom., MT.', 31, '117110059', 'FA', 2, '2018-07-25 05:18:26', '2018-07-25 05:18:26'),
(31, 'Hari Purnama, S.Si., M.Si.', 32, '118110072', 'HP', 2, '2018-07-25 05:20:24', '2018-07-25 05:20:24'),
(32, 'Nugraha Priya Utama, S.T., M.A., Ph.D.', 33, '118110074', 'NPU', 2, '2018-07-25 05:21:30', '2018-07-25 05:21:30'),
(33, 'Dicky Prima Satya, ST., MT.', 34, '197911082015041001', 'DPS', 2, '2018-07-25 05:26:02', '2018-07-25 05:26:02'),
(34, 'Farrell Yudihartomo, ST.', 35, '0', 'FY', 0, '2018-07-25 05:59:11', '2018-07-25 05:59:11'),
(35, 'Latifa Dwiyanti, ST., MT.', 36, '0', 'LD', 0, '2018-07-25 06:00:20', '2018-07-25 06:00:20'),
(36, 'Satrio Adi Rukmono, ST., MT.', 37, '0', 'SAR', 0, '2018-07-25 06:01:22', '2018-07-25 06:01:22'),
(37, 'Andreas Bara Timur, ST., MT.', 38, '0', 'ABT', 0, '2018-07-25 06:02:03', '2018-07-25 06:02:03'),
(38, 'Ginar Santika Niwanputri, S.T., M.Sc.', 39, '0', 'GSN', 2, '2018-07-25 06:20:18', '2018-07-25 06:20:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kodekeilmuantemp`
--

CREATE TABLE `kodekeilmuantemp` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `areakeilmuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kodekeilmuantemp`
--

INSERT INTO `kodekeilmuantemp` (`id`, `kode`, `areakeilmuan`, `created_at`, `updated_at`) VALUES
(3, 'AC', 'Algorithm and Complexity', NULL, NULL),
(4, 'CAO', 'Computer Architecture and Organization', NULL, NULL),
(5, 'CS', 'Computational Science', NULL, NULL),
(6, 'DS', 'Discrete Structure', NULL, NULL),
(7, 'GV', 'Graphics and Visualization', NULL, NULL),
(8, 'HCI', 'Human-Computer Interaction', NULL, NULL),
(9, 'IAS', 'Information Assurance and Security', NULL, NULL),
(10, 'IM', 'Information Management', NULL, NULL),
(11, 'IS', 'Intelligent Systems', NULL, NULL),
(12, 'NC', 'Networking and Communication', NULL, NULL),
(13, 'OS', 'Operating Systems', NULL, NULL),
(14, 'PBD', 'Platform-Based Development', NULL, NULL),
(15, 'PDC', 'Parallel and Distributed Computing', NULL, NULL),
(16, 'PL', 'Programming Languages', NULL, NULL),
(17, 'SDF', 'Software Development Fundamentals', NULL, NULL),
(18, 'SE', 'Software Engineering', NULL, NULL),
(19, 'SF', 'Systems Fundamentals', NULL, NULL),
(20, 'SIPP', 'Social Issues and Professional Practice', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `angkatan` int(10) UNSIGNED NOT NULL,
  `jumlah_sks_lulus` int(10) UNSIGNED NOT NULL,
  `lulus_ta_1` tinyint(1) NOT NULL DEFAULT '0',
  `current_ta2_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`user_id`, `nim`, `nama`, `angkatan`, `jumlah_sks_lulus`, `lulus_ta_1`, `current_ta2_id`, `created_at`, `updated_at`) VALUES
(40, '13514025', 'a', 2014, 120, 0, NULL, '2018-08-15 09:22:57', '2018-08-15 09:22:57'),
(43, '23518033', 'ratnadiraw', 2018, 140, 0, NULL, '2019-09-02 00:31:25', '2019-09-02 00:33:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa_bimbingan_pilihan`
--

CREATE TABLE `mahasiswa_bimbingan_pilihan` (
  `id` int(10) UNSIGNED NOT NULL,
  `topik_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `prioritas` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(67, '2014_10_12_000000_create_users_table', 1),
(68, '2014_10_12_100000_create_password_resets_table', 1),
(69, '2018_03_06_041753_create_mahasiswa_table', 1),
(70, '2018_03_08_115214_create_dosen_table', 1),
(71, '2018_03_08_115854_create_tu_table', 1),
(72, '2018_03_08_120351_create_topik_table', 1),
(73, '2018_03_08_120606_create_ta2_ta_table', 1),
(74, '2018_03_09_072222_create_ta2_sidang_table', 1),
(75, '2018_03_09_072243_create_ta2_seminar_table', 1),
(76, '2018_03_11_113946_create_ta2_dosen_ta_table', 1),
(77, '2018_03_11_113956_create_ta2_dosen_sidang_table', 1),
(78, '2018_03_11_140640_create_ta2_bimbingan_table', 1),
(79, '2018_03_13_063348_create_ta2_tugas_table', 1),
(80, '2018_03_14_103246_create_ta2_tugas_kelas_table', 1),
(81, '2018_03_14_103627_create_ta2_tugas_mahasiswa_table', 1),
(82, '2018_03_17_045541_create_ta1_daftar_tugas_table', 1),
(83, '2018_03_17_050023_create_ta1_tugas_akhir_table', 1),
(84, '2018_03_17_050257_create_ta1_seminar_table', 1),
(85, '2018_03_17_050328_create_ta1_bimbingan_table', 1),
(86, '2018_03_17_050401_create_ta1_mom_table', 1),
(87, '2018_03_17_050505_create_ta1_surat_tugas_table', 1),
(88, '2018_03_17_050523_create_ta1_surat_seminar_table', 1),
(89, '2018_03_17_050614_create_ta1_progress_summary_table', 1),
(90, '2018_03_17_053225_create_pilihan_topik_table', 1),
(91, '2018_03_17_055915_create_update_table_charset', 1),
(92, '2018_03_17_152119_create_ta1_tugas_table', 1),
(93, '2018_03_23_042122_create_tim_ta_table', 1),
(94, '2018_03_24_055637_create_ta1_dosen_ta_table', 1),
(95, '2018_03_24_062209_create_ta1_pengumuman_table', 1),
(96, '2018_03_24_115522_create_ta2_pengumuman_table', 1),
(97, '2018_03_26_014717_create_usulan_topik_table', 1),
(98, '2018_03_29_155620_create_mahasiswa_bimbingan_pilihan_table', 1),
(99, '2018_04_02_035312_ta2_progress_summary', 1),
(100, '2018_04_02_153254_create_events_table', 1),
(101, '2018_04_04_134611_create_ta2_berita_acara_seminar_table', 1),
(102, '2018_04_05_115545_create_berita_acara_sidangs_table', 1),
(103, '2018_04_05_120252_create_ta2_nilai_sidang_table', 1),
(104, '2018_04_08_134350_create_tahun_ajaran_tabel', 1),
(105, '2018_04_14_104553_create_ta2_mahasiswa_kelas_table', 1),
(106, '2018_04_15_110714_create_months_table', 1),
(107, '2018_04_18_060557_create_ta2_kelas_table', 1),
(108, '2018_04_18_153452_create_configuration_table', 1),
(109, '2018_07_05_001819_create_dosentemp_table', 1),
(110, '2018_07_05_002027_create_topiktemp_table', 1),
(111, '2018_07_05_002113_create_kodekeilmuantemp_table', 1),
(112, '2018_07_10_232531_create_subtopik_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `months`
--

CREATE TABLE `months` (
  `id` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihan_topik`
--

CREATE TABLE `pilihan_topik` (
  `id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `prioritas1` int(10) UNSIGNED DEFAULT NULL,
  `prioritas2` int(10) UNSIGNED DEFAULT NULL,
  `prioritas3` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pilihan_topik`
--

INSERT INTO `pilihan_topik` (`id`, `ta_id`, `prioritas1`, `prioritas2`, `prioritas3`) VALUES
(1, 1, 7, NULL, NULL),
(2, 2, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subtopik`
--

CREATE TABLE `subtopik` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_topik` int(11) NOT NULL,
  `subtopik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subtopik`
--

INSERT INTO `subtopik` (`id`, `id_topik`, `subtopik`, `created_at`, `updated_at`) VALUES
(1, 1, 'IoT', '2018-07-17 03:28:45', '2018-07-17 03:28:45'),
(2, 1, 'Parkir', '2018-07-17 03:28:45', '2018-07-17 03:28:45'),
(3, 1, 'RPL', '2018-07-17 03:28:45', '2018-07-17 03:28:45'),
(4, 3, 'Topik baru untuk TA baru', '2018-07-17 03:37:28', '2018-07-17 03:37:28'),
(5, 4, 'Topik baru untuk TA baru', '2018-07-17 03:40:51', '2018-07-17 03:40:51'),
(6, 4, 'Topik baru untuk TA baru 2', '2018-07-17 03:44:19', '2018-07-17 03:44:19'),
(7, 5, 'Crowdsourcing for Education', '2018-07-17 03:53:15', '2018-07-17 03:53:15'),
(8, 5, 'Crowdsourcing in Software Engineering', '2018-07-17 03:53:15', '2018-07-17 03:53:15'),
(9, 7, 'Stationary Noise', '2018-07-17 07:43:42', '2018-07-17 07:43:42'),
(10, 7, 'Non-stationary Noise', '2018-07-17 07:43:42', '2018-07-17 07:43:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_bimbingan`
--

CREATE TABLE `ta1_bimbingan` (
  `id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `pembimbing_id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_daftar_tugas`
--

CREATE TABLE `ta1_daftar_tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tugas_id` int(10) UNSIGNED NOT NULL,
  `progress_id` int(10) UNSIGNED NOT NULL,
  `status_pengumpulan` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_dosen_ta`
--

CREATE TABLE `ta1_dosen_ta` (
  `dosen_ta_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_mom`
--

CREATE TABLE `ta1_mom` (
  `id` int(10) UNSIGNED NOT NULL,
  `bimbingan_id` int(10) UNSIGNED NOT NULL,
  `hasil_diskusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindak_lanjut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tangal_bimbingan_berikutnya` date NOT NULL,
  `komentar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_persetujuan` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_pengumuman`
--

CREATE TABLE `ta1_pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `timTA_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_progress_summary`
--

CREATE TABLE `ta1_progress_summary` (
  `id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `jumlah_kehadiran_kelas` int(11) NOT NULL,
  `jumlah_kehadiran_seminar` int(11) NOT NULL,
  `jumlah_bimbingan` int(11) NOT NULL,
  `status_pengumpulan_dokumen` tinyint(1) NOT NULL DEFAULT '0',
  `terdaftar_seminar` tinyint(1) NOT NULL DEFAULT '0',
  `nilai_akhir` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_lulus` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ta1_progress_summary`
--

INSERT INTO `ta1_progress_summary` (`id`, `ta_id`, `jumlah_kehadiran_kelas`, `jumlah_kehadiran_seminar`, `jumlah_bimbingan`, `status_pengumpulan_dokumen`, `terdaftar_seminar`, `nilai_akhir`, `status_lulus`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 0, NULL, NULL, '2018-08-28 10:07:03', '2018-08-28 10:07:03'),
(2, 2, 0, 0, 0, 0, 0, NULL, NULL, '2019-09-02 00:33:32', '2019-09-02 00:33:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_seminar`
--

CREATE TABLE `ta1_seminar` (
  `id` int(10) UNSIGNED NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `ruangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final` tinyint(1) NOT NULL DEFAULT '0',
  `kloter` int(10) UNSIGNED DEFAULT NULL,
  `shift` int(10) UNSIGNED DEFAULT NULL,
  `nilai` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_pembimbing` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_penguji` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berkas_seminar` mediumblob,
  `seminar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_surat_seminar`
--

CREATE TABLE `ta1_surat_seminar` (
  `id` int(10) UNSIGNED NOT NULL,
  `pembimbing_id` int(10) UNSIGNED NOT NULL,
  `pembimbing_opsional_id` int(10) UNSIGNED DEFAULT NULL,
  `penguji1_id` int(10) UNSIGNED DEFAULT NULL,
  `penguji2_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `nomor_kop_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seminar_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_surat_tugas`
--

CREATE TABLE `ta1_surat_tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `nomor_kop_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_tugas`
--

CREATE TABLE `ta1_tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenggat_waktu` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta1_tugas_akhir`
--

CREATE TABLE `ta1_tugas_akhir` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `topik_id` int(10) UNSIGNED DEFAULT NULL,
  `nama_topik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_checkout` tinyint(1) NOT NULL DEFAULT '0',
  `tahun_ajaran_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ta1_tugas_akhir`
--

INSERT INTO `ta1_tugas_akhir` (`id`, `mahasiswa_id`, `topik_id`, `nama_topik`, `status_checkout`, `tahun_ajaran_id`, `created_at`, `updated_at`) VALUES
(1, 40, NULL, NULL, 0, 1, '2018-08-28 10:07:03', '2018-08-28 10:07:03'),
(2, 43, NULL, NULL, 0, 1, '2019-09-02 00:33:32', '2019-09-02 00:33:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_berita_acara_seminar`
--

CREATE TABLE `ta2_berita_acara_seminar` (
  `berita_acara_id` int(10) UNSIGNED NOT NULL,
  `seminar_id` int(10) UNSIGNED NOT NULL,
  `status_lulus` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `berita_acara` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_berita_acara_sidang`
--

CREATE TABLE `ta2_berita_acara_sidang` (
  `bas_id` int(10) UNSIGNED NOT NULL,
  `sidang_id` int(10) UNSIGNED NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T',
  `status_lulus` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lembar_finalisasi` mediumblob,
  `berita_acara` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_bimbingan`
--

CREATE TABLE `ta2_bimbingan` (
  `bimbingan_id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `dosen_id_2` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `hasil_diskusi` text COLLATE utf8mb4_unicode_ci,
  `rencana_tindak_lanjut` text COLLATE utf8mb4_unicode_ci,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `approved` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_dosen_sidang`
--

CREATE TABLE `ta2_dosen_sidang` (
  `dosen_sidang_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `sidang_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_dosen_ta`
--

CREATE TABLE `ta2_dosen_ta` (
  `dosen_ta_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_kelas`
--

CREATE TABLE `ta2_kelas` (
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `tim_ta_id` int(10) UNSIGNED NOT NULL,
  `semester` int(10) UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kelas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_mahasiswa_kelas`
--

CREATE TABLE `ta2_mahasiswa_kelas` (
  `mahasiswa_kelas_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `jumlah_kehadiran_kelas` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_nilai_sidang`
--

CREATE TABLE `ta2_nilai_sidang` (
  `nilai_sidang_id` int(10) UNSIGNED NOT NULL,
  `bas_id` int(10) UNSIGNED NOT NULL,
  `dosen_id` int(10) UNSIGNED NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_pengumuman`
--

CREATE TABLE `ta2_pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `timTA_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_progress_summary`
--

CREATE TABLE `ta2_progress_summary` (
  `ps_id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `jumlah_kehadiran_kelas` int(11) NOT NULL DEFAULT '0',
  `jumlah_kehadiran_seminar` int(11) NOT NULL DEFAULT '0',
  `jumlah_bimbingan` int(11) NOT NULL DEFAULT '0',
  `status_pengumpulan` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `terdaftar_seminar` tinyint(1) NOT NULL DEFAULT '0',
  `nilai_akhir` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_lulus` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_seminar`
--

CREATE TABLE `ta2_seminar` (
  `seminar_id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `ruangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pendaftaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_sidang`
--

CREATE TABLE `ta2_sidang` (
  `sidang_id` int(10) UNSIGNED NOT NULL,
  `ta_id` int(10) UNSIGNED NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `ruangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pendaftaran` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_ta`
--

CREATE TABLE `ta2_ta` (
  `ta_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `topik_id` int(10) UNSIGNED DEFAULT NULL,
  `topik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum ada judul',
  `mahasiswa_daftar_seminar` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `mahasiswa_daftar_sidang` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lulus_seminar` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T',
  `status_lulus` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_tugas`
--

CREATE TABLE `ta2_tugas` (
  `tugas_id` int(10) UNSIGNED NOT NULL,
  `deadline` date NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_tugas_kelas`
--

CREATE TABLE `ta2_tugas_kelas` (
  `tugas_kelas_id` int(10) UNSIGNED NOT NULL,
  `tugas_id` int(10) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta2_tugas_mahasiswa`
--

CREATE TABLE `ta2_tugas_mahasiswa` (
  `tugas_mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `tugas_id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `sudah_dinilai` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `semester` int(10) UNSIGNED DEFAULT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `semester`, `tahun`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, '2018', '2018-01-20', '2018-05-20', NULL, NULL),
(2, 1, '2018', '2018-01-20', '2018-05-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempgenerate`
--

CREATE TABLE `tempgenerate` (
  `prioritas` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` text NOT NULL,
  `pembimbing1` text NOT NULL,
  `pembimbing2` text NOT NULL,
  `judul` text NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tempgenerate`
--

INSERT INTO `tempgenerate` (`prioritas`, `nim`, `nama`, `pembimbing1`, `pembimbing2`, `judul`, `id`, `created_at`, `updated_at`) VALUES
(1, '13515016', 'Kevin Erdiza Yogatama', 'G.A. Putri Saptawati', '', 'Software Bug Localization', 1, '2018-09-16', '2018-09-16'),
(2, '13515016', 'Kevin Erdiza Yogatama', 'Fazat Nur Azizah', '', 'Graf Datawarehouse', 2, '2018-09-16', '2018-09-16'),
(2, '13515036', 'Putra Kusaeri', 'Fazat Nur Azizah', '', 'Graf Datawarehouse', 3, '2018-09-16', '2018-09-16'),
(3, '13515036', 'Putra Kusaeri', 'G.A. Putri Saptawati', '', 'Keyword search in Graph', 4, '2018-09-16', '2018-09-16'),
(1, '13515115', 'Muhammad Rafli Fadillah', 'Bayu Hendradjaya', '', 'Methods/Tools for SW Process improvement', 5, '2018-09-16', '2018-09-16'),
(1, '13515132', 'Prama Legawa Halqavi', 'Fazat Nur Azizah', '', 'Graf Datawarehouse', 6, '2018-09-16', '2018-09-16'),
(2, '13515132', 'Prama Legawa Halqavi', 'Fazat Nur Azizah', '', 'Spatio-temporal Datawarehouse', 7, '2018-09-16', '2018-09-16'),
(3, '13515132', 'Prama Legawa Halqavi', 'Tricya Widagdo', '', 'Pengelolaan Basis Data Objek Bergerak', 8, '2018-09-16', '2018-09-16'),
(1, '13514083', 'Nathan James Runtuwene', 'Dody Dharma', '', 'Komputasi Simulasi Fluida dalam 3 dimensi menggunakan MPM ', 9, '2018-09-16', '2018-09-16'),
(1, '13515027', 'Trevin Matthew Robertsen', 'Bayu Hendradjaya', '', 'Methods/Tools for SW Process Improvement', 10, '2018-09-16', '2018-09-16'),
(2, '13515027', 'Trevin Matthew Robertsen', 'Yani Widyani', '', 'Method Base Management System', 11, '2018-09-16', '2018-09-16'),
(3, '13515027', 'Trevin Matthew Robertsen', 'Dicky Prima Satya', '', 'Sistem Informasi', 12, '2018-09-16', '2018-09-16'),
(1, '13515029', 'Finiko Kasula Novenda', 'Fazat Nur Azizah', '', 'Graf Datawarehouse', 13, '2018-09-16', '2018-09-16'),
(2, '13515029', 'Finiko Kasula Novenda', 'Tricya Widagdo', '', 'Pengelolaan Basis Data Objek Bergerak', 14, '2018-09-16', '2018-09-16'),
(3, '13515029', 'Finiko Kasula Novenda', 'Fazat Nur Azizah', '', 'Spatial Datawarehouse', 15, '2018-09-16', '2018-09-16'),
(2, '13515044', 'Mohammad Dicky Andika Putra', 'Tricya Widagdo', '', 'Pengelolaan Basis Data Objek Bergerak', 16, '2018-09-16', '2018-09-16'),
(1, '13515050', 'Muhammad Umar Fariz Tumbuan', 'G.A. Putri Saptawati', '', 'Software Bug Localization', 17, '2018-09-16', '2018-09-16'),
(1, '13515054', 'Albertus Djauhari Djohan', 'Fazat Nur Azizah', '', 'Graf Datawarehouse', 18, '2018-09-16', '2018-09-16'),
(2, '13515054', 'Albertus Djauhari Djohan', 'Fazat Nur Azizah', '', 'Spatio-Temporal Datawarehouse', 19, '2018-09-16', '2018-09-16'),
(3, '13515054', 'Albertus Djauhari Djohan', 'Fazat Nur Azizah', '', 'Spatial Datawarehouse', 20, '2018-09-16', '2018-09-16'),
(1, '13515059', 'Muthmainnah', 'Windy Gambetta', '', 'Intelligent Information System (Sistem Rekomendasi Tempat Wisata di Indonesia)', 21, '2018-09-16', '2018-09-16'),
(2, '13515069', 'Hisham Lazuardi Yusuf', 'Bayu Hendradjaya', '', 'Method/Tools for SW Process Improvement', 22, '2018-09-16', '2018-09-16'),
(3, '13515069', 'Hisham Lazuardi Yusuf', 'Tricya Widagdo', '', 'Pengelolaan Basis Data Objek Bergerak', 23, '2018-09-16', '2018-09-16'),
(1, '13515080', 'Muhammad Treza Nolandra', 'Masayu Leylia Khodra', '', 'Peringkasan Otomatis Kumpulan Berita Bahasa Indonesia', 24, '2018-09-16', '2018-09-16'),
(2, '13515080', 'Muhammad Treza Nolandra', 'Masayu Leylia Khodra', '', 'Paraphrasing atau Semantic Text Similarity', 25, '2018-09-16', '2018-09-16'),
(3, '13515080', 'Muhammad Treza Nolandra', 'Sub Topik 1: Achmad Imam Kistijantoro; Sub Topik 2: Ayu Purwarianti', 'Sub Topik 1: Ayu Purwarianti; Sub-Topik 2: Achmad Imam Kistijantoro', 'Pembangkitan Deskripsi Gambar Berbasis Emosi', 26, '2018-09-16', '2018-09-16'),
(1, '13515091', 'Adrian Hartarto P', 'G.A. Putri Saptawati', '', 'Software Bug Localization', 27, '2018-09-16', '2018-09-16'),
(2, '13515091', 'Adrian Hartarto P', 'G.A. Putri Saptawati', '', 'Keyword Search in Graph', 28, '2018-09-16', '2018-09-16'),
(3, '13515091', 'Adrian Hartarto P', 'Saiful Akbar', 'Fitra Arifiansyah', 'Pembangunan Search Engine untuk Domain Medis', 29, '2018-09-16', '2018-09-16'),
(1, '13515098', 'Aya Aurora Rimbamorani', 'G.A. Putri Saptawati', '', 'Keyword Search in Graph', 30, '2018-09-16', '2018-09-16'),
(1, '13515104', 'Rizki Ihza Parama', 'G.A. Putri Saptawati', '', 'Software Bug Localization', 31, '2018-09-16', '2018-09-16'),
(1, '13513016', 'Raka Nurul Fikri', 'Ir. Windy Gambetta', ' ', 'Pengembangan Perangkat Lunak untuk Pembelajaran Berbasis Permainan (Game Based Learning)', 32, '2018-09-16', '2018-09-16'),
(1, '13515036', 'Putra Kusaeri', 'G. A. Putri Saptawati', ' ', 'Data mining pada Alquran', 33, '2018-09-16', '2018-09-16'),
(1, '13515108', 'Paskahlis Anjas Prabowo', 'Nur Ulfa Maulidevi', ' ', 'Pembangkitan Musik (Piano) dengan Deep Learning', 34, '2018-09-16', '2018-09-16'),
(2, '13515108', 'Paskahlis Anjas Prabowo', 'Nur Ulfa Maulidevi', ' ', 'Pembangkitan Musik dari Suasana/Emosi Sebuah Gambar', 35, '2018-09-16', '2018-09-16'),
(1, '13514053', 'Ahmad Fajar Prasetiyo', 'Rinaldi Munir', ' ', 'Aplikasi Blockchain untuk Membuat Voting Online', 36, '2018-09-16', '2018-09-16'),
(1, '13515042', 'Edwin Rachman', 'Harlili, Dra. M.Sc', ' ', 'Decision Support System', 37, '2018-09-16', '2018-09-16'),
(1, '13515075', 'Adrian Mulyana Nugraha', '1. Adi Mulyanto 2. Ginar Santika', ' ', 'Software Engineering of Interactive Virtual Books', 38, '2018-09-16', '2018-09-16'),
(1, '13515078', 'Veren Iliana Kurniadi', 'Dicky Prima Satya', ' ', 'Decision Support System untuk Optimasi Manajemen Persediaan Barang', 39, '2018-09-16', '2018-09-16'),
(1, '13514093', 'Arnettha Septinez', 'Adi Mulyanto', ' ', 'Desain Interaksi', 40, '2018-09-16', '2018-09-16'),
(1, '13515006', 'Muhammad Rizki Duwinanto', 'Rinaldi Munir', ' ', 'Deteksi Pesan Tersembunyi dalam File Audio MP3 dengan Teknik Deep Learning', 41, '2018-09-16', '2018-09-16'),
(2, '13515006', 'Muhammad Rizki Duwinanto', 'G.A Putri Saptawati', ' ', 'Software Bug Localization', 42, '2018-09-16', '2018-09-16'),
(3, '13515006', 'Muhammad Rizki Duwinanto', 'Fazat Nur Azizah', ' ', 'Analysis Graf Sosial Media memanfaatkan Data Warehouse', 43, '2018-09-16', '2018-09-16'),
(1, '13515019', 'Candra Hesen Parera', 'Harlili', ' ', 'Interaksi Manusia Komputer', 44, '2018-09-16', '2018-09-16'),
(1, '13515021', 'Dewita Sonya Tarabunga', 'Rila Mandala (pembimbing 1), Nugraha Priya Utama (pembimbing 2)', ' ', 'Machine learning technique for automatic retinal image analysis in health monitoring.', 45, '2018-09-16', '2018-09-16'),
(1, '13515023', 'Radiyya Dwisaputra', 'Riza Satria Perdana', ' ', 'Software as a Service (SaaS) for resource management', 46, '2018-09-16', '2018-09-16'),
(1, '13515031', 'Vigor Akbar', 'Rila Mandala', ' ', 'Optimasi Mesin Pencari Menggunakan Machine Learning', 47, '2018-09-16', '2018-09-16'),
(1, '13515044', 'Mohammad Dicky Andika Putra', 'Rila Mandala', ' ', 'Sistem Personalisasi Komik Berdasarkan Referensi Komik yang Telah dibacca', 48, '2018-09-16', '2018-09-16'),
(1, '13515049', 'Jauhar Arifin', 'RSP', ' ', 'Pengembangan Sistem Auto Grading Dengan Menggunakan PC Pengguna Sebagai Worker', 49, '2018-09-16', '2018-09-16'),
(1, '13515066', 'Ferdinandus Richard', 'Ibu Nur Ulfa Maulidevi', ' ', 'Music Recommendation System', 50, '2018-09-16', '2018-09-16'),
(1, '13515069', 'Hisham Lazuardi Yusuf', 'Rila Mandala', ' ', 'Phishing Web Detection Using Machine Learning', 51, '2018-09-16', '2018-09-16'),
(1, '13515072', 'Luthfi Fadillah', 'Rila Mandala', ' ', 'Aplikasi Algoritma Machine Learning untuk Klasifikasi Fase Pertumbuhan pada Tanaman Padi Berdasarkan Data Citra Hiperspektral', 52, '2018-09-16', '2018-09-16'),
(1, '13515074', 'Akmal Fadlurohman', 'Riza Satria Perdana', ' ', 'Platform Penyimpanan, Berbagi, dan Transaksi File Aman Menggunakan Blockchain', 53, '2018-09-16', '2018-09-16'),
(1, '13515079', 'Nicholas Thie', 'Riza Satria Perdana', ' ', 'Penggunaan blockchain untuk sistem pemungutan suara', 54, '2018-09-16', '2018-09-16'),
(1, '13515082', 'Stevanno Hero Leadervand', 'Dra. Harlili M.Sc.', ' ', 'Aplikasi Anti Hate Speech untuk Mengurangi Konten Negatif pada Sosial Media', 55, '2018-09-16', '2018-09-16'),
(2, '13515082', 'Stevanno Hero Leadervand', 'Ginar Santika Niwanputri ', ' ', 'Aplikasi Anti Hate Speech untuk Mengurangi Konten Negatif pada Sosial Media', 56, '2018-09-16', '2018-09-16'),
(1, '13515083', 'Muhammad Hilmi Asyrofi', 'Pak Windy / Pak Iping', ' ', '(Real-time***) Automatic Shoplifting Detection in a Grocery Store', 57, '2018-09-16', '2018-09-16'),
(2, '13515083', 'Muhammad Hilmi Asyrofi', 'Pak Windy / Pak Iping', ' ', 'Sistem Otomatis penghitungan barang di Supermarket berdasarkan behavior user', 58, '2018-09-16', '2018-09-16'),
(1, '13515086', 'Muhammad Iqbal Al Khowarizmi', 'Yani Widyani', ' ', 'Software-as-a-Service Quality Assessment', 59, '2018-09-16', '2018-09-16'),
(1, '13515093', 'Reinaldo Ignatius Wijaya', 'Nur Ulfa Maulidevi', ' ', 'Multi-agent System for Cooperative Multiplayer Game', 60, '2018-09-16', '2018-09-16'),
(1, '13515096', 'Gilang Ardyamandala Al Assyifa', 'Afwarman Manaf/Nur Ulfa Maulidevi/Harlili', ' ', 'Pendeteksian Pelanggaran oleh Pengendara Sepeda Motor dengan YOLO', 61, '2018-09-16', '2018-09-16'),
(2, '13515096', 'Gilang Ardyamandala Al Assyifa', 'Afwarman Manaf/Nur Ulfa Maulidevi/Harlili', ' ', 'Penerjemah Bahasa Isyarat Indonesia (BISINDO) dengan RCNN', 62, '2018-09-16', '2018-09-16'),
(3, '13515096', 'Gilang Ardyamandala Al Assyifa', 'Nur Ulfa Maulidevi/Harlili', ' ', 'Pembangkitan Puisi atau Lirik Lagu Bahasa Indonesia', 63, '2018-09-16', '2018-09-16'),
(1, '13515111', 'Catherine Almira', 'Nur Ulfa Maulidevi', ' ', 'Intelligent System untuk Penjadwalan Tempat Wisata', 64, '2018-09-16', '2018-09-16'),
(1, '13515127', 'Fildah Ananda Amalia', 'Judhi Santoso', ' ', 'Pemodelan konfigurasi shaf sholat berdasarkan pengetahuan untuk aliran keluar-masuk ke tempat ibadah menggunakan agent based modeling', 65, '2018-09-16', '2018-09-16'),
(1, '13515130', 'Adya Naufal Fikri', 'Riza Satria Perdana, ST., MT.', ' ', 'Pengembangan Generator Aplikasi Sistem Informasi Manajemen Berbasis Web', 66, '2018-09-16', '2018-09-16'),
(1, '13515135', 'Muhammad Akmal Pratama', 'Rila Mandala', ' ', 'Sistem Rekomendasi Pembangkit Jalur Belajar Pada Massively Open Online Course', 67, '2018-09-16', '2018-09-16'),
(1, '13515138', 'Kevin', 'Rila Mandala', ' ', 'Early detection of melanoma skin cancer using machine learning technique', 68, '2018-09-16', '2018-09-16'),
(2, '13515138', 'Kevin', 'Rila Mandala', ' ', ' Machine learning technique for automatic retinal image analysis in health monitoring', 69, '2018-09-16', '2018-09-16'),
(3, '13515138', 'Kevin', '-', ' ', '-', 70, '2018-09-16', '2018-09-16'),
(1, '13515145', 'Erfandi Suryo Putra', 'Yani Widyani', ' ', 'Pemetaan Suatu Metode ke Metode Berbasis Essence', 71, '2018-09-16', '2018-09-16'),
(2, '13515145', 'Erfandi Suryo Putra', 'Dicky Prima Satya', ' ', 'Sistem Informasi (e-Learning yang Menyesuaikan dengan Gaya Belajar Pengguna)', 72, '2018-09-16', '2018-09-16'),
(1, '13515602', 'Ahmad Farhan Ghifari', 'Riza Satria Perdana', ' ', '\"Implementasi Protokol untuk Pemantauan dan Analisa EKG berbasis platform IoT secara real-time\"', 73, '2018-09-16', '2018-09-16'),
(2, '13515602', 'Ahmad Farhan Ghifari', 'Yani Widyani', ' ', 'Pengembangan perangkat lunak tertentu dengan menggunakan metode berbasis Essence', 74, '2018-09-16', '2018-09-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_ta`
--

CREATE TABLE `tim_ta` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tim_ta`
--

INSERT INTO `tim_ta` (`user_id`, `created_at`, `updated_at`) VALUES
(2, '2018-07-17 04:52:54', '2018-07-17 04:52:54'),
(3, '2018-07-17 07:33:25', '2018-07-17 07:33:25'),
(4, '2018-07-17 04:35:45', '2018-07-17 04:35:45'),
(5, '2018-07-17 04:35:49', '2018-07-17 04:35:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topik`
--

CREATE TABLE `topik` (
  `topik_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_keilmuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_keilmuan_spesifik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laboratorium_keahlian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int(10) UNSIGNED NOT NULL,
  `status_buka` tinyint(1) NOT NULL DEFAULT '1',
  `pembimbing1_id` int(10) UNSIGNED NOT NULL,
  `pembimbing2_id` int(10) UNSIGNED DEFAULT NULL,
  `usulan_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `topikexcel`
--

CREATE TABLE `topikexcel` (
  `kode` varchar(7) NOT NULL,
  `pembimbing1` text NOT NULL,
  `pembimbing2` text NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `topikexcel`
--

INSERT INTO `topikexcel` (`kode`, `pembimbing1`, `pembimbing2`, `id`, `created_at`, `updated_at`) VALUES
('CS-001', '', 'Nugraha P. Utama', 1, '2018-09-03', '2018-09-03'),
('CS-002', '', 'Nugraha P. Utama', 2, '2018-09-03', '2018-09-03'),
('CS-003', '', 'Nugraha P. Utama', 3, '2018-09-03', '2018-09-03'),
('CS-004', '', 'Nugraha P. Utama', 4, '2018-09-03', '2018-09-03'),
('CS-005', '', 'Nugraha P. Utama', 5, '2018-09-03', '2018-09-03'),
('CS-006', '', 'Nugraha P. Utama', 6, '2018-09-03', '2018-09-03'),
('CS-007', '', 'Nugraha P. Utama', 7, '2018-09-03', '2018-09-03'),
('CS-008', '', 'Nugraha P. Utama', 8, '2018-09-03', '2018-09-03'),
('CS-009', '', 'Nugraha P. Utama', 9, '2018-09-03', '2018-09-03'),
('GV-001', 'Dody Dharma', '', 10, '2018-09-03', '2018-09-03'),
('GV-002', 'Dody Dharma', '', 11, '2018-09-03', '2018-09-03'),
('GV-003', 'Wikan Danar Sunindyo', 'Dari Korlantas Polri', 12, '2018-09-03', '2018-09-03'),
('HCI-001', 'Dessi Puji Lestari', '', 13, '2018-09-03', '2018-09-03'),
('HCI-002', 'Adi Mulyanto', '', 14, '2018-09-03', '2018-09-03'),
('IAS-001', 'Yudistira Dwi Wardhana Asnar', '', 15, '2018-09-03', '2018-09-03'),
('IAS-002', 'Yudistira Dwi Wardhana Asnar', '', 16, '2018-09-03', '2018-09-03'),
('IAS-003', 'Yudistira Dwi Wardhana Asnar', '', 17, '2018-09-03', '2018-09-03'),
('IAS-004', 'Yudistira Dwi Wardhana Asnar', '', 18, '2018-09-03', '2018-09-03'),
('IAS-005', 'Yudistira Dwi Wardhana Asnar', '', 19, '2018-09-03', '2018-09-03'),
('IAS-006', 'Yudistira Dwi Wardhana Asnar', '', 20, '2018-09-03', '2018-09-03'),
('IM-001', 'Kridanto Surendro', '', 21, '2018-09-03', '2018-09-03'),
('IM-002', 'Yudistira Dwi Wardhana Asnar', '', 22, '2018-09-03', '2018-09-03'),
('IM-003', 'Tricya Widagdo', '', 23, '2018-09-03', '2018-09-03'),
('IM-004', 'Wikan Danar Sunindyo', '', 24, '2018-09-03', '2018-09-03'),
('IM-005', 'Saiful Akbar', '', 25, '2018-09-03', '2018-09-03'),
('IM-006', 'Saiful Akbar', '', 26, '2018-09-03', '2018-09-03'),
('IM-007', 'Saiful Akbar', '', 27, '2018-09-03', '2018-09-03'),
('IM-008', 'Muhammad Zuhri Catur Candra', '', 28, '2018-09-03', '2018-09-03'),
('IM-009', 'Fazat Nur Azizah', '', 29, '2018-09-03', '2018-09-03'),
('IM-010', 'Fazat Nur Azizah', '', 30, '2018-09-03', '2018-09-03'),
('IM-011', 'Fazat Nur Azizah', '', 31, '2018-09-03', '2018-09-03'),
('IM-012', 'Fazat Nur Azizah', '', 32, '2018-09-03', '2018-09-03'),
('IS-001', 'Masayu Leylia Khodra', '', 33, '2018-09-03', '2018-09-03'),
('IS-002', 'Masayu Leylia Khodra', '', 34, '2018-09-03', '2018-09-03'),
('IS-003', 'Masayu Leylia Khodra', '', 35, '2018-09-03', '2018-09-03'),
('IS-004', 'Masayu Leylia Khodra', '', 36, '2018-09-03', '2018-09-03'),
('IS-005', 'Windy Gambetta', '', 37, '2018-09-03', '2018-09-03'),
('IS-006', 'Nur Ulfa Maulidevi', '', 38, '2018-09-03', '2018-09-03'),
('IS-007', 'Ayu Purwarianti', '', 39, '2018-09-03', '2018-09-03'),
('IS-008', 'Ayu Purwarianti', '', 40, '2018-09-03', '2018-09-03'),
('IS-009', 'Ayu Purwarianti', '', 41, '2018-09-03', '2018-09-03'),
('IS-010', 'Ayu Purwarianti', '', 42, '2018-09-03', '2018-09-03'),
('IS-011', 'Ayu Purwarianti', '', 43, '2018-09-03', '2018-09-03'),
('IS-012', 'Ayu Purwarianti', '', 44, '2018-09-03', '2018-09-03'),
('IS-013', 'Dessi Puji Lestari', '', 45, '2018-09-03', '2018-09-03'),
('IS-014', 'Dessi Puji Lestari', '', 46, '2018-09-03', '2018-09-03'),
('IS-015', 'Dessi Puji Lestari', '', 47, '2018-09-03', '2018-09-03'),
('IS-016', 'Dessi Puji Lestari', '', 48, '2018-09-03', '2018-09-03'),
('IS-017', 'Dessi Puji Lestari', '', 49, '2018-09-03', '2018-09-03'),
('IS-018', 'Dessi Puji Lestari', '', 50, '2018-09-03', '2018-09-03'),
('IS-019', 'Dessi Puji Lestari', '', 51, '2018-09-03', '2018-09-03'),
('IS-020', 'Sub Topik 1: Achmad Imam Kistijantoro; Sub Topik 2: Ayu Purwarianti', 'Sub Topik 1: Ayu Purwarianti; Sub-Topik 2: Achmad Imam Kistijantoro', 52, '2018-09-03', '2018-09-03'),
('IS-021', 'G.A. Putri Saptawati', '', 53, '2018-09-03', '2018-09-03'),
('IS-022', 'G.A. Putri Saptawati', '', 54, '2018-09-03', '2018-09-03'),
('IS-023', 'Dwi Hendratmo Widyantoro', '', 55, '2018-09-03', '2018-09-03'),
('IS-024', 'Dwi Hendratmo Widyantoro', '', 56, '2018-09-03', '2018-09-03'),
('IS-025', 'Dwi Hendratmo Widyantoro', '', 57, '2018-09-03', '2018-09-03'),
('IS-026', 'Dwi Hendratmo Widyantoro', '', 58, '2018-09-03', '2018-09-03'),
('NC-001', 'Muhammad Zuhri Catur Candra', '', 59, '2018-09-03', '2018-09-03'),
('NC-002', 'Muhammad Zuhri Catur Candra', '', 60, '2018-09-03', '2018-09-03'),
('NC-003', 'Muhammad Zuhri Catur Candra', '', 61, '2018-09-03', '2018-09-03'),
('NC-004', 'Muhammad Zuhri Catur Candra', '', 62, '2018-09-03', '2018-09-03'),
('NC-005', 'Muhammad Zuhri Catur Candra', '', 63, '2018-09-03', '2018-09-03'),
('NC-006', 'Muhammad Zuhri Catur Candra', '', 64, '2018-09-03', '2018-09-03'),
('NC-007', 'Muhammad Zuhri Catur Candra', '', 65, '2018-09-03', '2018-09-03'),
('PBD-001', 'Wikan Danar Sunindyo', '', 66, '2018-09-03', '2018-09-03'),
('PD-001', 'Achmad Imam Kistijantoro', '', 67, '2018-09-03', '2018-09-03'),
('PD-002', 'Achmad Imam Kistijantoro', '', 68, '2018-09-03', '2018-09-03'),
('PD-003', 'Achmad Imam Kistijantoro', '', 69, '2018-09-03', '2018-09-03'),
('SE-001', 'Yani Widyani', '', 70, '2018-09-03', '2018-09-03'),
('SE-002', 'Yani Widyani', '', 71, '2018-09-03', '2018-09-03'),
('SE-003', 'Yani Widyani', '', 72, '2018-09-03', '2018-09-03'),
('SE-004', 'Yani Widyani', '', 73, '2018-09-03', '2018-09-03'),
('SE-005', 'Bayu Hendradjaya', '', 74, '2018-09-03', '2018-09-03'),
('SE-006', 'Saiful Akbar', 'Fitra Arifiansyah', 75, '2018-09-03', '2018-09-03'),
('SE-007', 'Yudistira Dwi Wardhana Asnar', '', 76, '2018-09-03', '2018-09-03'),
('SE-008', 'Yudistira Dwi Wardhana Asnar', '', 77, '2018-09-03', '2018-09-03'),
('SE-009', 'Adi Mulyanto', '', 78, '2018-09-03', '2018-09-03'),
('SE-010', 'Dicky Prima Satya', '', 79, '2018-09-03', '2018-09-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topikmaketemp`
--

CREATE TABLE `topikmaketemp` (
  `prioritas` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `areakeilmuan` text NOT NULL,
  `calonpembimbing` text NOT NULL,
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `topikmaketemp`
--

INSERT INTO `topikmaketemp` (`prioritas`, `nim`, `nama`, `areakeilmuan`, `calonpembimbing`, `id`, `judul`, `created_at`, `updated_at`) VALUES
(1, '13513016', 'Raka Nurul Fikri', 'HCI', 'Ir. Windy Gambetta', 1, 'Pengembangan Perangkat Lunak untuk Pembelajaran Berbasis Permainan (Game Based Learning)', '2018-09-16', '2018-09-16'),
(1, '13515036', 'Putra Kusaeri', 'Intelegent system', 'G. A. Putri Saptawati', 2, 'Data mining pada Alquran', '2018-09-16', '2018-09-16'),
(1, '13515108', 'Paskahlis Anjas Prabowo', 'Intelligent System', 'Nur Ulfa Maulidevi', 3, 'Pembangkitan Musik (Piano) dengan Deep Learning', '2018-09-16', '2018-09-16'),
(2, '13515108', 'Paskahlis Anjas Prabowo', 'Intelligent System', 'Nur Ulfa Maulidevi', 4, 'Pembangkitan Musik dari Suasana/Emosi Sebuah Gambar', '2018-09-16', '2018-09-16'),
(1, '13514053', 'Ahmad Fajar Prasetiyo', 'IAS', 'Rinaldi Munir', 5, 'Aplikasi Blockchain untuk Membuat Voting Online', '2018-09-16', '2018-09-16'),
(1, '13515042', 'Edwin Rachman', 'IS', 'Harlili, Dra. M.Sc', 6, 'Decision Support System', '2018-09-16', '2018-09-16'),
(1, '13515075', 'Adrian Mulyana Nugraha', 'SE / HCI', '1. Adi Mulyanto 2. Ginar Santika', 7, 'Software Engineering of Interactive Virtual Books', '2018-09-16', '2018-09-16'),
(1, '13515078', 'Veren Iliana Kurniadi', 'IM', 'Dicky Prima Satya', 8, 'Decision Support System untuk Optimasi Manajemen Persediaan Barang', '2018-09-16', '2018-09-16'),
(1, '13514093', 'Arnettha Septinez', 'HCI', 'Adi Mulyanto', 9, 'Desain Interaksi', '2018-09-16', '2018-09-16'),
(1, '13515006', 'Muhammad Rizki Duwinanto', 'Ilmu dan Rekayasa Komputasi', 'Rinaldi Munir', 10, 'Deteksi Pesan Tersembunyi dalam File Audio MP3 dengan Teknik Deep Learning', '2018-09-16', '2018-09-16'),
(2, '13515006', 'Muhammad Rizki Duwinanto', 'Basis Data, Rekayasa Perangkat Lunak', 'G.A Putri Saptawati', 11, 'Software Bug Localization', '2018-09-16', '2018-09-16'),
(3, '13515006', 'Muhammad Rizki Duwinanto', 'Basis Data', 'Fazat Nur Azizah', 12, 'Analysis Graf Sosial Media memanfaatkan Data Warehouse', '2018-09-16', '2018-09-16'),
(1, '13515019', 'Candra Hesen Parera', 'HCI', 'Harlili', 13, 'Interaksi Manusia Komputer', '2018-09-16', '2018-09-16'),
(1, '13515021', 'Dewita Sonya Tarabunga', 'Computational Science', 'Rila Mandala (pembimbing 1), Nugraha Priya Utama (pembimbing 2)', 14, 'Machine learning technique for automatic retinal image analysis in health monitoring.', '2018-09-16', '2018-09-16'),
(1, '13515023', 'Radiyya Dwisaputra', 'NC/SE', 'Riza Satria Perdana', 15, 'Software as a Service (SaaS) for resource management', '2018-09-16', '2018-09-16'),
(1, '13515031', 'Vigor Akbar', 'IS', 'Rila Mandala', 16, 'Optimasi Mesin Pencari Menggunakan Machine Learning', '2018-09-16', '2018-09-16'),
(1, '13515044', 'Mohammad Dicky Andika Putra', 'IS', 'Rila Mandala', 17, 'Sistem Personalisasi Komik Berdasarkan Referensi Komik yang Telah dibacca', '2018-09-16', '2018-09-16'),
(1, '13515049', 'Jauhar Arifin', 'PDC', 'RSP', 18, 'Pengembangan Sistem Auto Grading Dengan Menggunakan PC Pengguna Sebagai Worker', '2018-09-16', '2018-09-16'),
(1, '13515066', 'Ferdinandus Richard', 'IS', 'Ibu Nur Ulfa Maulidevi', 19, 'Music Recommendation System', '2018-09-16', '2018-09-16'),
(1, '13515069', 'Hisham Lazuardi Yusuf', 'Intelligent Systems', 'Rila Mandala', 20, 'Phishing Web Detection Using Machine Learning', '2018-09-16', '2018-09-16'),
(1, '13515072', 'Luthfi Fadillah', 'Intelligent Systems', 'Rila Mandala', 21, 'Aplikasi Algoritma Machine Learning untuk Klasifikasi Fase Pertumbuhan pada Tanaman Padi Berdasarkan Data Citra Hiperspektral', '2018-09-16', '2018-09-16'),
(1, '13515074', 'Akmal Fadlurohman', 'NC / IAS', 'Riza Satria Perdana', 22, 'Platform Penyimpanan, Berbagi, dan Transaksi File Aman Menggunakan Blockchain', '2018-09-16', '2018-09-16'),
(1, '13515079', 'Nicholas Thie', 'IAS', 'Riza Satria Perdana', 23, 'Penggunaan blockchain untuk sistem pemungutan suara', '2018-09-16', '2018-09-16'),
(1, '13515082', 'Stevanno Hero Leadervand', 'HCI', 'Dra. Harlili M.Sc.', 24, 'Aplikasi Anti Hate Speech untuk Mengurangi Konten Negatif pada Sosial Media', '2018-09-16', '2018-09-16'),
(2, '13515082', 'Stevanno Hero Leadervand', 'HCI', 'Ginar Santika Niwanputri ', 25, 'Aplikasi Anti Hate Speech untuk Mengurangi Konten Negatif pada Sosial Media', '2018-09-16', '2018-09-16'),
(1, '13515083', 'Muhammad Hilmi Asyrofi', 'Computer Vision + (Anomaly Detection or Machine Learning)', 'Pak Windy / Pak Iping', 26, '(Real-time***) Automatic Shoplifting Detection in a Grocery Store', '2018-09-16', '2018-09-16'),
(2, '13515083', 'Muhammad Hilmi Asyrofi', 'Computer Vision  + Machine Learning', 'Pak Windy / Pak Iping', 27, 'Sistem Otomatis penghitungan barang di Supermarket berdasarkan behavior user', '2018-09-16', '2018-09-16'),
(1, '13515086', 'Muhammad Iqbal Al Khowarizmi', 'Software Engineering', 'Yani Widyani', 28, 'Software-as-a-Service Quality Assessment', '2018-09-16', '2018-09-16'),
(1, '13515093', 'Reinaldo Ignatius Wijaya', 'IS', 'Nur Ulfa Maulidevi', 29, 'Multi-agent System for Cooperative Multiplayer Game', '2018-09-16', '2018-09-16'),
(1, '13515096', 'Gilang Ardyamandala Al Assyifa', 'Intelligent System', 'Afwarman Manaf/Nur Ulfa Maulidevi/Harlili', 30, 'Pendeteksian Pelanggaran oleh Pengendara Sepeda Motor dengan YOLO', '2018-09-16', '2018-09-16'),
(2, '13515096', 'Gilang Ardyamandala Al Assyifa', 'Intelligent System', 'Afwarman Manaf/Nur Ulfa Maulidevi/Harlili', 31, 'Penerjemah Bahasa Isyarat Indonesia (BISINDO) dengan RCNN', '2018-09-16', '2018-09-16'),
(3, '13515096', 'Gilang Ardyamandala Al Assyifa', 'Intelligent System', 'Nur Ulfa Maulidevi/Harlili', 32, 'Pembangkitan Puisi atau Lirik Lagu Bahasa Indonesia', '2018-09-16', '2018-09-16'),
(1, '13515111', 'Catherine Almira', 'IS', 'Nur Ulfa Maulidevi', 33, 'Intelligent System untuk Penjadwalan Tempat Wisata', '2018-09-16', '2018-09-16'),
(1, '13515127', 'Fildah Ananda Amalia', 'CS', 'Judhi Santoso', 34, 'Pemodelan konfigurasi shaf sholat berdasarkan pengetahuan untuk aliran keluar-masuk ke tempat ibadah menggunakan agent based modeling', '2018-09-16', '2018-09-16'),
(1, '13515130', 'Adya Naufal Fikri', 'SE', 'Riza Satria Perdana, ST., MT.', 35, 'Pengembangan Generator Aplikasi Sistem Informasi Manajemen Berbasis Web', '2018-09-16', '2018-09-16'),
(1, '13515135', 'Muhammad Akmal Pratama', 'Intelligent System', 'Rila Mandala', 36, 'Sistem Rekomendasi Pembangkit Jalur Belajar Pada Massively Open Online Course', '2018-09-16', '2018-09-16'),
(1, '13515138', 'Kevin', 'Computational Science', 'Rila Mandala', 37, 'Early detection of melanoma skin cancer using machine learning technique', '2018-09-16', '2018-09-16'),
(2, '13515138', 'Kevin', 'Computational Science', 'Rila Mandala', 38, ' Machine learning technique for automatic retinal image analysis in health monitoring', '2018-09-16', '2018-09-16'),
(3, '13515138', 'Kevin', '-', '-', 39, '-', '2018-09-16', '2018-09-16'),
(1, '13515145', 'Erfandi Suryo Putra', 'Software Engineering', 'Yani Widyani', 40, 'Pemetaan Suatu Metode ke Metode Berbasis Essence', '2018-09-16', '2018-09-16'),
(2, '13515145', 'Erfandi Suryo Putra', 'Software Engineering', 'Dicky Prima Satya', 41, 'Sistem Informasi (e-Learning yang Menyesuaikan dengan Gaya Belajar Pengguna)', '2018-09-16', '2018-09-16'),
(1, '13515602', 'Ahmad Farhan Ghifari', 'Software Engineering', 'Riza Satria Perdana', 42, '\"Implementasi Protokol untuk Pemantauan dan Analisa EKG berbasis platform IoT secara real-time\"', '2018-09-16', '2018-09-16'),
(2, '13515602', 'Ahmad Farhan Ghifari', 'Software Engineering', 'Yani Widyani', 43, 'Pengembangan perangkat lunak tertentu dengan menggunakan metode berbasis Essence', '2018-09-16', '2018-09-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topikselecttemp`
--

CREATE TABLE `topikselecttemp` (
  `judul` text NOT NULL,
  `no` varchar(7) NOT NULL,
  `prioritas` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `topikselecttemp`
--

INSERT INTO `topikselecttemp` (`judul`, `no`, `prioritas`, `nim`, `nama`, `id`, `created_at`, `updated_at`) VALUES
('Software Bug Localization', 'IS-022', 1, '13515016', 'Kevin Erdiza Yogatama', 1, '2018-09-16', '2018-09-16'),
('Graf Datawarehouse', 'IM-011', 2, '13515016', 'Kevin Erdiza Yogatama', 2, '2018-09-16', '2018-09-16'),
('Graf Datawarehouse', 'IM-012', 2, '13515036', 'Putra Kusaeri', 3, '2018-09-16', '2018-09-16'),
('Keyword search in Graph', 'IS-021', 3, '13515036', 'Putra Kusaeri', 4, '2018-09-16', '2018-09-16'),
('Methods/Tools for SW Process improvement', 'SE-005', 1, '13515115', 'Muhammad Rafli Fadillah', 5, '2018-09-16', '2018-09-16'),
('Graf Datawarehouse', 'IM-011', 1, '13515132', 'Prama Legawa Halqavi', 6, '2018-09-16', '2018-09-16'),
('Spatio-temporal Datawarehouse', 'IM-010', 2, '13515132', 'Prama Legawa Halqavi', 7, '2018-09-16', '2018-09-16'),
('Pengelolaan Basis Data Objek Bergerak', 'IM-003', 3, '13515132', 'Prama Legawa Halqavi', 8, '2018-09-16', '2018-09-16'),
('Komputasi Simulasi Fluida dalam 3 dimensi menggunakan MPM ', 'GV-001', 1, '13514083', 'Nathan James Runtuwene', 9, '2018-09-16', '2018-09-16'),
('Methods/Tools for SW Process Improvement', 'SE-005', 1, '13515027', 'Trevin Matthew Robertsen', 10, '2018-09-16', '2018-09-16'),
('Method Base Management System', 'SE-001', 2, '13515027', 'Trevin Matthew Robertsen', 11, '2018-09-16', '2018-09-16'),
('Sistem Informasi', 'SE-010', 3, '13515027', 'Trevin Matthew Robertsen', 12, '2018-09-16', '2018-09-16'),
('Graf Datawarehouse', 'IM-011', 1, '13515029', 'Finiko Kasula Novenda', 13, '2018-09-16', '2018-09-16'),
('Pengelolaan Basis Data Objek Bergerak', 'IM-003', 2, '13515029', 'Finiko Kasula Novenda', 14, '2018-09-16', '2018-09-16'),
('Spatial Datawarehouse', 'IM-009', 3, '13515029', 'Finiko Kasula Novenda', 15, '2018-09-16', '2018-09-16'),
('Pengelolaan Basis Data Objek Bergerak', 'IM-003', 2, '13515044', 'Mohammad Dicky Andika Putra', 16, '2018-09-16', '2018-09-16'),
('Software Bug Localization', 'IS-022', 1, '13515050', 'Muhammad Umar Fariz Tumbuan', 17, '2018-09-16', '2018-09-16'),
('Graf Datawarehouse', 'IM-011', 1, '13515054', 'Albertus Djauhari Djohan', 18, '2018-09-16', '2018-09-16'),
('Spatio-Temporal Datawarehouse', 'IM-010', 2, '13515054', 'Albertus Djauhari Djohan', 19, '2018-09-16', '2018-09-16'),
('Spatial Datawarehouse', 'IM-009', 3, '13515054', 'Albertus Djauhari Djohan', 20, '2018-09-16', '2018-09-16'),
('Intelligent Information System (Sistem Rekomendasi Tempat Wisata di Indonesia)', 'IS-005', 1, '13515059', 'Muthmainnah', 21, '2018-09-16', '2018-09-16'),
('Method/Tools for SW Process Improvement', 'SE-005', 2, '13515069', 'Hisham Lazuardi Yusuf', 22, '2018-09-16', '2018-09-16'),
('Pengelolaan Basis Data Objek Bergerak', 'IM-003', 3, '13515069', 'Hisham Lazuardi Yusuf', 23, '2018-09-16', '2018-09-16'),
('Peringkasan Otomatis Kumpulan Berita Bahasa Indonesia', 'IS-003', 1, '13515080', 'Muhammad Treza Nolandra', 24, '2018-09-16', '2018-09-16'),
('Paraphrasing atau Semantic Text Similarity', 'IS-004', 2, '13515080', 'Muhammad Treza Nolandra', 25, '2018-09-16', '2018-09-16'),
('Pembangkitan Deskripsi Gambar Berbasis Emosi', 'IS-020', 3, '13515080', 'Muhammad Treza Nolandra', 26, '2018-09-16', '2018-09-16'),
('Software Bug Localization', 'IS-022', 1, '13515091', 'Adrian Hartarto P', 27, '2018-09-16', '2018-09-16'),
('Keyword Search in Graph', 'IS-021', 2, '13515091', 'Adrian Hartarto P', 28, '2018-09-16', '2018-09-16'),
('Pembangunan Search Engine untuk Domain Medis', 'SE-006', 3, '13515091', 'Adrian Hartarto P', 29, '2018-09-16', '2018-09-16'),
('Keyword Search in Graph', 'IS-021', 1, '13515098', 'Aya Aurora Rimbamorani', 30, '2018-09-16', '2018-09-16'),
('Software Bug Localization', 'IS-022', 1, '13515104', 'Rizki Ihza Parama', 31, '2018-09-16', '2018-09-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topiktemp`
--

CREATE TABLE `topiktemp` (
  `id` int(10) UNSIGNED NOT NULL,
  `areakeilmuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `areakeilmuanspesifik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci,
  `quota` int(11) NOT NULL,
  `pembimbing1` int(11) NOT NULL,
  `pembimbing2` int(11) DEFAULT NULL,
  `bidanglain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laboratorium` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idDosen` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usulan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `topiktemp`
--

INSERT INTO `topiktemp` (`id`, `areakeilmuan`, `areakeilmuanspesifik`, `topik`, `deskripsi`, `quota`, `pembimbing1`, `pembimbing2`, `bidanglain`, `laboratorium`, `keterangan`, `idDosen`, `tahun`, `semester`, `status`, `created_at`, `updated_at`, `usulan_id`) VALUES
(6, 'Algorithm and Complexity; Human-Computer Interaction; Information Management; Software Engineering', '', 'Library Pemrosesan dan Analisis Data Objek Bergerak', 'TA ini berbasis pada library pemrosesan dan analisis data objek yang sudah dikembangkan oleh Isham dan Malvin pada TA priode sebelumnya. Tujuan TA adalah mengembangkan library tsb agar: 1. memiliki fungsionalitas yang lebih lengkap (misalnya terkait visualisasi, terkait stream data), 2. teraplikasikan untuk sebuah domain yang dipilih (membangun \"killer\" application berbasis pada library tsb). 3. memiliki kecepatan akses yang baik (mislanya dengan mengimplementasi metode pengindeksan)', 2, 3, -1, '', 'Basisdata', 'non project', 3, 2018, 1, 0, '2018-07-17 06:52:21', '2018-07-17 06:52:21', NULL),
(7, 'Intelligent Systems', 'Computational Linguistic', 'Robust Indonesian Automatic Speech Recognition', 'Development of Indonesian automatic speech recognition that is robust against acoustic environmental distortion.', 2, 5, -1, 'Linguistic', 'Grafika dan Intelejensia Buatan', 'non project', 5, 2018, 1, 3, '2018-07-17 07:43:42', '2019-09-02 00:26:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tu`
--

CREATE TABLE `tu` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tu`
--

INSERT INTO `tu` (`user_id`, `nip`, `nama`, `created_at`, `updated_at`) VALUES
(1, '1234', 'Admin TU', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@taifitb.com', '$2y$10$fL.a1UUjMSkLABycdqOZkOQC7O9D4twAGH9uC4dDBCS36Zk4R90au', 'VY0xHpoInpMXrkZN5t6SWmuJQNe50JLa4fuld5jzYb3W4hq4NDErcbXyqcYn', NULL, NULL),
(2, 'Dr.Techn. Muhammad Zuhri Catur Candra ST,MT', 'catur@informatika.org', '$2y$10$GX7Mlq5c5Ue.gk9J8d7CwOaH13wxYJMrjD/bzdZ5bapt39EKv5tMe', '7O9QQK2exgzAYbYdqa7EMyeBfQZ2QhVIIxHTJTCgJNpIv4bcAj0dUL0xRZlB', '2018-07-17 02:48:32', '2018-07-17 02:48:32'),
(3, 'Dr.Techn. Saiful Akbar ST,MT', 'saiful@informatika.org', '$2y$10$pxFN/DnLD3eCotSFYouhX.Ngzs9/7h0SHWqfoYRO21i7yoUqrGai.', 'y4mu76fxKbSDuqPg5JEcMjytRYkejyLZxpzXuGUXK0G2PEpg18xpJOBIavRC', '2018-07-17 04:21:08', '2018-07-17 04:21:08'),
(4, 'Dr.Fazat Nur Azizah, ST., M.Sc.', 'fazat@informatika.org', '$2y$10$q1SQ5CVVLykF0nYugIwgs.xC44Nv6iMEk2ZLzQShEWlqZjG0YjkpK', NULL, '2018-07-17 04:23:28', '2018-07-17 04:23:28'),
(5, 'Dr. Dessi Puji Lestari, ST., M.Eng.', 'dessipuji@informatika.org', '$2y$10$lPDWfZB7uc8YRcnvUk8eL.U4v7pHakd5P6kaRrdXDTzSJPSX/0M0a', 'gRgO534guc7GEIGSrwqZgKTOQyTpydZvgx7EF1fbJuAu08VsEVkftteap1LX', '2018-07-17 04:35:40', '2018-07-17 04:35:40'),
(6, 'Prof. Dr.Ing.Ir. Benhard Sitohang', 'benhard@informatika.org', '$2y$10$DObWYRnoU8nvoCwYGCEc6ezw3/H4mMWUNJWXIIKR7MLsD9icYb7P2', 'rbtnJOyhd2tQtXwVLFivQ7vlvd4fFZqrqyXRSvyu5Q2uvMu4YdCBisNj5xsM', '2018-07-17 08:50:38', '2018-07-17 08:50:38'),
(7, 'Dr. Bayu Hendradjaya, ST.,MT.', 'bayu@informatika.org', '$2y$10$v1.a8jG0u5sHky4a8VZdneWIDI7kYH6/a3vFbbPmaa/HdsiU4wc0m', NULL, '2018-07-17 08:52:23', '2018-07-17 08:52:23'),
(8, 'Prof. Dr.Ing.Ir. Iping Supriana Suwardi', 'iping@informatika.org', '$2y$10$e3kzXiv.jd6xMzXxSue.r.kc9EYga8s1J3hkjSYUB8B2wqSNyj0De', NULL, '2018-07-17 08:55:52', '2018-07-17 08:55:52'),
(9, 'Prof. Ir. Dwi Hendratmo W., M.Sc., Ph.D.', 'dwi@informatika.org', '$2y$10$JC.nYEu05KxMt5ttV9w25.u4md/TVQcxDK.0EsqMy9B545DDyhXoa', '2nkiJISi2iDE3YQAOJeflaysjQLJW7Z7OuBjpNwcaGE95ptXZxu1qLomRZkp', '2018-07-17 08:57:42', '2018-07-17 08:57:42'),
(10, 'Dr.Eng. Ayu Purwarianti, ST., MT.', 'ayu@informatika.org', '$2y$10$oWvgzQqnI/s1r3aalGhsoeBJqKokJXqYUVJHyt5l9ddihSJUgBrVa', NULL, '2018-07-17 08:59:29', '2018-07-17 08:59:29'),
(11, 'Achmad Imam Kistijantoro, ST, M.Sc., Ph.D.', 'imam@informatika.org', '$2y$10$48laVTQXv.5/x0cydnUdGefmC/2IDexVolgLz0DDtU859g7YlSnt6', 'mottET7MbGn4yc0NKCvVkZNtTjx012gpl1AHbPdXZrsCIJfHEOh19tuzpq3D', '2018-07-17 09:01:35', '2018-07-17 09:01:35'),
(12, 'Dr. Ir. Gusti Ayu  Putri Saptawati, M.Comm.', 'putri@informatika.org', '$2y$10$9o8YJZiQfMgEvMVrA0pRoOnYgHCViljq1bsI7k/HuAnZ8vym8dVTS', NULL, '2018-07-17 09:10:55', '2018-07-17 09:10:55'),
(13, 'Dr.Masayu Leylia Khodra, ST., MT.', 'masayu@informatika.org', '$2y$10$tJfrQ8onBfv1qGAXrUzYLek5WKMnvIY/z46Cr17HL/13fbK3mGJum', NULL, '2018-07-17 09:17:07', '2018-07-17 09:17:07'),
(14, 'Adi Mulyanto, ST., MT.', 'adi@informatika.org', '$2y$10$kYmfAKZf4BsTOkSTAsCDE.RP.i6D6P2gmc4vUXsQMeChQ5.NbWHz.', NULL, '2018-07-17 09:18:20', '2018-07-17 09:18:20'),
(15, 'Ir. Afwarman, M.Sc.,Ph.D.', 'awang@informatika.org', '$2y$10$8cWrF4oyNUQ4SJ6xrYpat.z2jS5wAk1GyGLoSAVRU5SYuwqamBave', NULL, '2018-07-17 09:20:05', '2018-07-17 09:20:05'),
(16, 'Ir. Windy Gambetta', 'windy@informatika.org', '$2y$10$WJA0.wtIGGHl0AwXCP2VaOuFntgkMoT6Gs1dK/GJv6e9LwWDSTDMa', NULL, '2018-07-17 09:25:12', '2018-07-17 09:25:12'),
(17, 'Dody Dharma, ST., MT.', 'dody@informatika.org', '$2y$10$YyrzOpSi6A7yIpC1ycKkeut2ZNub6BLqHnZWYr02nJvUt8Iq.XdAK', NULL, '2018-07-17 09:25:52', '2018-07-17 09:25:52'),
(18, 'Dr.Ir. Rila Mandala, M.Eng.', 'rila@informatika.org', '$2y$10$e8kwgfEGejAdZw5cnpeX0.U61LiBHVjj12tTAaidmaQ6AZVRDMlRS', NULL, '2018-07-17 09:26:04', '2018-07-17 09:26:04'),
(19, 'Dra. Harlili, M.Sc.', 'harlili@informatika.org', '$2y$10$sQVtF458waV0cdHhWjHck.Gq8meHLTXq7/7ygHebqziwjD8Vo0VWu', NULL, '2018-07-17 09:26:55', '2018-07-17 09:26:55'),
(20, 'Dr. Ir. Judhi Santoso, M.Sc.', 'judhi@informatika.org', '$2y$10$hXAqqBQOIMl3uREGYCF4YeBa6BX3QgdnEE4MGsJjWKBsFh9WhJKl.', NULL, '2018-07-17 09:28:52', '2018-07-17 09:28:52'),
(21, 'Ir. Kridanto Surendro, M.Sc.,Ph.D.', 'endro@informatika.org', '$2y$10$XA5ANi8uTbFAu.SgUWpT4.gmBsJdFFPsXfhq2V8aersojJmr8UBr6', NULL, '2018-07-17 09:30:37', '2018-07-17 09:30:37'),
(23, 'Tricya Widagdo, ST., M.Sc.', 'cia@informatika.org', '$2y$10$9qENn5PL6rWSJFKlA4Gle.lIpk3ZALPGEX/FozJA0VT0AG007HT/6', NULL, '2018-07-17 09:31:50', '2018-07-17 09:31:50'),
(24, 'Dr. Nur Ulfa Maulidevi, ST., M.Sc.', 'ulfa@informatika.org', '$2y$10$/VbAVDAVPlpTru6hbHbJduNo.JvqtOYlBYPwe7d5LZXsQqAU/asJG', NULL, '2018-07-17 09:33:12', '2018-07-17 09:33:12'),
(25, 'Yani Widyani, ST., MT.', 'yani@informatika.org', '$2y$10$fB/kkEKoUxZYbT96gBrMvu92jqb0QNjtgY6Qwqb7L5bImUQuH/vuy', NULL, '2018-07-17 09:34:20', '2018-07-17 09:34:20'),
(26, 'Riza Satria Perdana, ST., MT.', 'riza@informatika.org', '$2y$10$CTrAE5ZY8lAJZiD7CVcTy.ANMoRwyEilsUa4vSWTN8d6lULQna1aa', NULL, '2018-07-17 09:56:00', '2018-07-17 09:56:00'),
(28, 'Dr. Ir. Rinaldi, MT.', 'rinaldi@informatika.org', '$2y$10$h6vix5BGzZlMo22sDrWL3OOu91M5s/dVduiDODvZU377hPIuFT48q', NULL, '2018-07-25 05:15:36', '2018-07-25 05:15:36'),
(29, 'Yudistira Dwi Wardhana Asnar, ST., Ph.D.', 'yudis@informatika.org', '$2y$10$PC/MkfAtorY96sJnAkb0rOGu.HCogE12KxdY0noL8i/46MW./4FTm', NULL, '2018-07-25 05:16:44', '2018-07-25 05:16:44'),
(30, 'Dr.techn. Wikan Danar Sunindyo, ST,M.Sc.', 'wikan@informatika.org', '$2y$10$SCuI8M7zomy1YRk9BOlyhuHz7jw8XmK8l63VsWlkX/yDTKmZ6i0Tu', NULL, '2018-07-25 05:17:37', '2018-07-25 05:17:37'),
(31, 'Fitra Arifiansyah, S.Kom., MT.', 'fitra@informatika.org', '$2y$10$MId6yww.fG5XyZke6xmVPe3XwMu7mvmWc9NdDQWfgnP4jXcuTudM6', NULL, '2018-07-25 05:18:26', '2018-07-25 05:18:26'),
(32, 'Hari Purnama, S.Si., M.Si.', 'purnama@informatika.org', '$2y$10$5J8XzFtkpun2Vy25KV1fSusH73FRekapFcA7g6CeAUDBHDrdh0lvy', NULL, '2018-07-25 05:20:24', '2018-07-25 05:20:24'),
(33, 'Nugraha Priya Utama, S.T., M.A., Ph.D.', 'utama@informatika.org', '$2y$10$itr7Ah8TuNzBQxd6dU4/lu0DXCnYdvPaSwPZD5vKipr7IPAToPmAO', NULL, '2018-07-25 05:21:30', '2018-07-25 05:21:30'),
(34, 'Dicky Prima Satya, ST., MT.', 'dicky@informatika.org', '$2y$10$hICd6yUw.3zEMBolQYa6IuxmTrpeJXDG9ztdyIiRJmfg2j5Hej1D2', NULL, '2018-07-25 05:26:02', '2018-07-25 05:26:02'),
(35, 'Farrell Yudihartomo, ST.', 'farrell@informatika.org', '$2y$10$rpPHJXvcWbUrqYzHaarDSe.fJtmNFDAxx9E9lbfJKRjeg//bOznTW', NULL, '2018-07-25 05:59:11', '2018-07-25 05:59:11'),
(36, 'Latifa Dwiyanti, ST., MT.', 'dwiyanti.latifa@gmail.com', '$2y$10$KvmURnVZBmlB0mhV5iq67eXHmxAo8xRG57j7Y.Owm8cv5MdQ4Nxu.', NULL, '2018-07-25 06:00:20', '2018-07-25 06:00:20'),
(37, 'Satrio Adi Rukmono, ST., MT.', 'r.satrioadi@gmail.com', '$2y$10$rGRBuyOfIZ9gaWyxqIt18uqxFH8Qo4dRMmmf6hBhCzduHs3pBghLC', NULL, '2018-07-25 06:01:22', '2018-07-25 06:01:22'),
(38, 'Andreas Bara Timur, ST., MT.', 'bara.timur91@gmail.com', '$2y$10$g/HmAIiM7eK4QzzLlseV8uO1lqzDZF4N5FAy17vvAuv12Te1hXE56', NULL, '2018-07-25 06:02:03', '2018-07-25 06:02:03'),
(39, 'Ginar Santika Niwanputri, S.T., M.Sc.', 'ginar@informatika.org', '$2y$10$w/YGCKVkL11BYzkd640r3uf/JdeO1woMYRHLrLyRHm4o9o7SLhzVK', NULL, '2018-07-25 06:20:18', '2018-07-25 06:20:18'),
(40, 'a', 'a@a.com', '$2y$10$aLgxPgybsnd40PDyOzHanudF7k0nLDqjAZXPVQRqEpv.iAs3BVOEO', 'kGMgWXkZ8xEzljpfiSJpztzRRdMiwDkz1bKMvNdKfB9kHWkXwu3VH6saSbvQ', '2018-08-15 09:22:57', '2018-08-15 09:22:57'),
(42, 'Rizki Ihza Parama', 'r@r.com', '$2y$10$5sYdQEBNFl7WKkHLhl6qPeizn17SqS300yW0opPdG66hDFzpxo3Ae', NULL, NULL, NULL),
(43, 'ratnadiraw', 'ratnadiraw@gmail.com', '$2y$10$uN5Ulk3oLo2N98HvMtT9KekjOLS45Uo6xxRK6ujFC3J1Ecsf5A31C', 'iKDOHsJJTrrNA7lczrzZ6FDEloOrOmndoa48ncLEXZ1c13rml75Ir1itExBt', '2019-09-02 00:31:25', '2019-09-02 00:31:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan_topik`
--

CREATE TABLE `usulan_topik` (
  `id` int(10) UNSIGNED NOT NULL,
  `mahasiswa_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `dosen_nip_unique` (`nip`);

--
-- Indeks untuk tabel `dosentemp`
--
ALTER TABLE `dosentemp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kodekeilmuantemp`
--
ALTER TABLE `kodekeilmuantemp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`);

--
-- Indeks untuk tabel `mahasiswa_bimbingan_pilihan`
--
ALTER TABLE `mahasiswa_bimbingan_pilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_bimbingan_pilihan_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `mahasiswa_bimbingan_pilihan_topik_id_foreign` (`topik_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD UNIQUE KEY `password_resets_email_unique` (`email`);

--
-- Indeks untuk tabel `pilihan_topik`
--
ALTER TABLE `pilihan_topik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pilihan_topik_ta_id_foreign` (`ta_id`),
  ADD KEY `pilihan_topik_prioritas1_foreign` (`prioritas1`),
  ADD KEY `pilihan_topik_prioritas2_foreign` (`prioritas2`),
  ADD KEY `pilihan_topik_prioritas3_foreign` (`prioritas3`);

--
-- Indeks untuk tabel `subtopik`
--
ALTER TABLE `subtopik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ta1_bimbingan`
--
ALTER TABLE `ta1_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_bimbingan_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `ta1_bimbingan_pembimbing_id_foreign` (`pembimbing_id`),
  ADD KEY `ta1_bimbingan_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta1_daftar_tugas`
--
ALTER TABLE `ta1_daftar_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_daftar_tugas_tugas_id_foreign` (`tugas_id`),
  ADD KEY `ta1_daftar_tugas_progress_id_foreign` (`progress_id`);

--
-- Indeks untuk tabel `ta1_dosen_ta`
--
ALTER TABLE `ta1_dosen_ta`
  ADD PRIMARY KEY (`dosen_ta_id`),
  ADD KEY `ta1_dosen_ta_ta_id_foreign` (`ta_id`),
  ADD KEY `ta1_dosen_ta_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `ta1_mom`
--
ALTER TABLE `ta1_mom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_mom_bimbingan_id_foreign` (`bimbingan_id`);

--
-- Indeks untuk tabel `ta1_pengumuman`
--
ALTER TABLE `ta1_pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_pengumuman_timta_id_foreign` (`timTA_id`);

--
-- Indeks untuk tabel `ta1_progress_summary`
--
ALTER TABLE `ta1_progress_summary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_progress_summary_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta1_seminar`
--
ALTER TABLE `ta1_seminar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_seminar_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta1_surat_seminar`
--
ALTER TABLE `ta1_surat_seminar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_surat_seminar_pembimbing_id_foreign` (`pembimbing_id`),
  ADD KEY `ta1_surat_seminar_pembimbing_opsional_id_foreign` (`pembimbing_opsional_id`),
  ADD KEY `ta1_surat_seminar_penguji1_id_foreign` (`penguji1_id`),
  ADD KEY `ta1_surat_seminar_penguji2_id_foreign` (`penguji2_id`),
  ADD KEY `ta1_surat_seminar_seminar_id_foreign` (`seminar_id`);

--
-- Indeks untuk tabel `ta1_surat_tugas`
--
ALTER TABLE `ta1_surat_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_surat_tugas_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta1_tugas`
--
ALTER TABLE `ta1_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ta1_tugas_akhir`
--
ALTER TABLE `ta1_tugas_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta1_tugas_akhir_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `ta1_tugas_akhir_topik_id_foreign` (`topik_id`),
  ADD KEY `ta1_tugas_akhir_tahun_ajaran_id_foreign` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `ta2_berita_acara_seminar`
--
ALTER TABLE `ta2_berita_acara_seminar`
  ADD PRIMARY KEY (`berita_acara_id`),
  ADD KEY `ta2_berita_acara_seminar_seminar_id_foreign` (`seminar_id`);

--
-- Indeks untuk tabel `ta2_berita_acara_sidang`
--
ALTER TABLE `ta2_berita_acara_sidang`
  ADD PRIMARY KEY (`bas_id`),
  ADD KEY `ta2_berita_acara_sidang_sidang_id_foreign` (`sidang_id`);

--
-- Indeks untuk tabel `ta2_bimbingan`
--
ALTER TABLE `ta2_bimbingan`
  ADD PRIMARY KEY (`bimbingan_id`),
  ADD KEY `ta2_bimbingan_ta_id_foreign` (`ta_id`),
  ADD KEY `ta2_bimbingan_dosen_id_foreign` (`dosen_id`),
  ADD KEY `ta2_bimbingan_dosen_id_2_foreign` (`dosen_id_2`);

--
-- Indeks untuk tabel `ta2_dosen_sidang`
--
ALTER TABLE `ta2_dosen_sidang`
  ADD PRIMARY KEY (`dosen_sidang_id`),
  ADD KEY `ta2_dosen_sidang_dosen_id_foreign` (`dosen_id`),
  ADD KEY `ta2_dosen_sidang_sidang_id_foreign` (`sidang_id`);

--
-- Indeks untuk tabel `ta2_dosen_ta`
--
ALTER TABLE `ta2_dosen_ta`
  ADD PRIMARY KEY (`dosen_ta_id`),
  ADD KEY `ta2_dosen_ta_ta_id_foreign` (`ta_id`),
  ADD KEY `ta2_dosen_ta_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `ta2_kelas`
--
ALTER TABLE `ta2_kelas`
  ADD PRIMARY KEY (`kelas_id`),
  ADD KEY `ta2_kelas_tim_ta_id_foreign` (`tim_ta_id`);

--
-- Indeks untuk tabel `ta2_mahasiswa_kelas`
--
ALTER TABLE `ta2_mahasiswa_kelas`
  ADD PRIMARY KEY (`mahasiswa_kelas_id`),
  ADD KEY `ta2_mahasiswa_kelas_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `ta2_mahasiswa_kelas_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `ta2_nilai_sidang`
--
ALTER TABLE `ta2_nilai_sidang`
  ADD PRIMARY KEY (`nilai_sidang_id`),
  ADD KEY `ta2_nilai_sidang_bas_id_foreign` (`bas_id`),
  ADD KEY `ta2_nilai_sidang_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `ta2_pengumuman`
--
ALTER TABLE `ta2_pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ta2_pengumuman_timta_id_foreign` (`timTA_id`);

--
-- Indeks untuk tabel `ta2_progress_summary`
--
ALTER TABLE `ta2_progress_summary`
  ADD PRIMARY KEY (`ps_id`),
  ADD KEY `ta2_progress_summary_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta2_seminar`
--
ALTER TABLE `ta2_seminar`
  ADD PRIMARY KEY (`seminar_id`),
  ADD KEY `ta2_seminar_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta2_sidang`
--
ALTER TABLE `ta2_sidang`
  ADD PRIMARY KEY (`sidang_id`),
  ADD KEY `ta2_sidang_ta_id_foreign` (`ta_id`);

--
-- Indeks untuk tabel `ta2_ta`
--
ALTER TABLE `ta2_ta`
  ADD PRIMARY KEY (`ta_id`),
  ADD KEY `ta2_ta_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `ta2_ta_topik_id_foreign` (`topik_id`),
  ADD KEY `ta2_ta_tahun_ajaran_id_foreign` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `ta2_tugas`
--
ALTER TABLE `ta2_tugas`
  ADD PRIMARY KEY (`tugas_id`);

--
-- Indeks untuk tabel `ta2_tugas_kelas`
--
ALTER TABLE `ta2_tugas_kelas`
  ADD PRIMARY KEY (`tugas_kelas_id`),
  ADD KEY `ta2_tugas_kelas_tugas_id_foreign` (`tugas_id`),
  ADD KEY `ta2_tugas_kelas_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `ta2_tugas_mahasiswa`
--
ALTER TABLE `ta2_tugas_mahasiswa`
  ADD PRIMARY KEY (`tugas_mahasiswa_id`),
  ADD KEY `ta2_tugas_mahasiswa_tugas_id_foreign` (`tugas_id`),
  ADD KEY `ta2_tugas_mahasiswa_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tempgenerate`
--
ALTER TABLE `tempgenerate`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tim_ta`
--
ALTER TABLE `tim_ta`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`topik_id`),
  ADD KEY `topik_pembimbing1_id_foreign` (`pembimbing1_id`),
  ADD KEY `topik_pembimbing2_id_foreign` (`pembimbing2_id`),
  ADD KEY `topik_usulan_id_foreign` (`usulan_id`);

--
-- Indeks untuk tabel `topikexcel`
--
ALTER TABLE `topikexcel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `topikmaketemp`
--
ALTER TABLE `topikmaketemp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `topikselecttemp`
--
ALTER TABLE `topikselecttemp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `topiktemp`
--
ALTER TABLE `topiktemp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tu`
--
ALTER TABLE `tu`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `tu_nip_unique` (`nip`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `usulan_topik`
--
ALTER TABLE `usulan_topik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usulan_topik_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dosentemp`
--
ALTER TABLE `dosentemp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kodekeilmuantemp`
--
ALTER TABLE `kodekeilmuantemp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa_bimbingan_pilihan`
--
ALTER TABLE `mahasiswa_bimbingan_pilihan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `pilihan_topik`
--
ALTER TABLE `pilihan_topik`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `subtopik`
--
ALTER TABLE `subtopik`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `ta1_bimbingan`
--
ALTER TABLE `ta1_bimbingan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_daftar_tugas`
--
ALTER TABLE `ta1_daftar_tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_dosen_ta`
--
ALTER TABLE `ta1_dosen_ta`
  MODIFY `dosen_ta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_mom`
--
ALTER TABLE `ta1_mom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_pengumuman`
--
ALTER TABLE `ta1_pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_progress_summary`
--
ALTER TABLE `ta1_progress_summary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ta1_seminar`
--
ALTER TABLE `ta1_seminar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_surat_seminar`
--
ALTER TABLE `ta1_surat_seminar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_surat_tugas`
--
ALTER TABLE `ta1_surat_tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_tugas`
--
ALTER TABLE `ta1_tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta1_tugas_akhir`
--
ALTER TABLE `ta1_tugas_akhir`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ta2_berita_acara_seminar`
--
ALTER TABLE `ta2_berita_acara_seminar`
  MODIFY `berita_acara_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_berita_acara_sidang`
--
ALTER TABLE `ta2_berita_acara_sidang`
  MODIFY `bas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_bimbingan`
--
ALTER TABLE `ta2_bimbingan`
  MODIFY `bimbingan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_dosen_sidang`
--
ALTER TABLE `ta2_dosen_sidang`
  MODIFY `dosen_sidang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_dosen_ta`
--
ALTER TABLE `ta2_dosen_ta`
  MODIFY `dosen_ta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_kelas`
--
ALTER TABLE `ta2_kelas`
  MODIFY `kelas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_mahasiswa_kelas`
--
ALTER TABLE `ta2_mahasiswa_kelas`
  MODIFY `mahasiswa_kelas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_nilai_sidang`
--
ALTER TABLE `ta2_nilai_sidang`
  MODIFY `nilai_sidang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_pengumuman`
--
ALTER TABLE `ta2_pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_progress_summary`
--
ALTER TABLE `ta2_progress_summary`
  MODIFY `ps_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_seminar`
--
ALTER TABLE `ta2_seminar`
  MODIFY `seminar_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_sidang`
--
ALTER TABLE `ta2_sidang`
  MODIFY `sidang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_ta`
--
ALTER TABLE `ta2_ta`
  MODIFY `ta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_tugas`
--
ALTER TABLE `ta2_tugas`
  MODIFY `tugas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_tugas_kelas`
--
ALTER TABLE `ta2_tugas_kelas`
  MODIFY `tugas_kelas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ta2_tugas_mahasiswa`
--
ALTER TABLE `ta2_tugas_mahasiswa`
  MODIFY `tugas_mahasiswa_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tempgenerate`
--
ALTER TABLE `tempgenerate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `topik`
--
ALTER TABLE `topik`
  MODIFY `topik_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `topikexcel`
--
ALTER TABLE `topikexcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `topikmaketemp`
--
ALTER TABLE `topikmaketemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `topikselecttemp`
--
ALTER TABLE `topikselecttemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `topiktemp`
--
ALTER TABLE `topiktemp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `usulan_topik`
--
ALTER TABLE `usulan_topik`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mahasiswa_bimbingan_pilihan`
--
ALTER TABLE `mahasiswa_bimbingan_pilihan`
  ADD CONSTRAINT `mahasiswa_bimbingan_pilihan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_bimbingan_pilihan_topik_id_foreign` FOREIGN KEY (`topik_id`) REFERENCES `topik` (`topik_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pilihan_topik`
--
ALTER TABLE `pilihan_topik`
  ADD CONSTRAINT `pilihan_topik_prioritas1_foreign` FOREIGN KEY (`prioritas1`) REFERENCES `topiktemp` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pilihan_topik_prioritas2_foreign` FOREIGN KEY (`prioritas2`) REFERENCES `topiktemp` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pilihan_topik_prioritas3_foreign` FOREIGN KEY (`prioritas3`) REFERENCES `topiktemp` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pilihan_topik_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta1_tugas_akhir` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_bimbingan`
--
ALTER TABLE `ta1_bimbingan`
  ADD CONSTRAINT `ta1_bimbingan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_bimbingan_pembimbing_id_foreign` FOREIGN KEY (`pembimbing_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_bimbingan_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta1_tugas_akhir` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_daftar_tugas`
--
ALTER TABLE `ta1_daftar_tugas`
  ADD CONSTRAINT `ta1_daftar_tugas_progress_id_foreign` FOREIGN KEY (`progress_id`) REFERENCES `ta1_progress_summary` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_daftar_tugas_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `ta1_tugas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_dosen_ta`
--
ALTER TABLE `ta1_dosen_ta`
  ADD CONSTRAINT `ta1_dosen_ta_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_dosen_ta_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta1_tugas_akhir` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_mom`
--
ALTER TABLE `ta1_mom`
  ADD CONSTRAINT `ta1_mom_bimbingan_id_foreign` FOREIGN KEY (`bimbingan_id`) REFERENCES `ta1_bimbingan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_pengumuman`
--
ALTER TABLE `ta1_pengumuman`
  ADD CONSTRAINT `ta1_pengumuman_timta_id_foreign` FOREIGN KEY (`timTA_id`) REFERENCES `tim_ta` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_progress_summary`
--
ALTER TABLE `ta1_progress_summary`
  ADD CONSTRAINT `ta1_progress_summary_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta1_tugas_akhir` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_seminar`
--
ALTER TABLE `ta1_seminar`
  ADD CONSTRAINT `ta1_seminar_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta1_tugas_akhir` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_surat_seminar`
--
ALTER TABLE `ta1_surat_seminar`
  ADD CONSTRAINT `ta1_surat_seminar_pembimbing_id_foreign` FOREIGN KEY (`pembimbing_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_surat_seminar_pembimbing_opsional_id_foreign` FOREIGN KEY (`pembimbing_opsional_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_surat_seminar_penguji1_id_foreign` FOREIGN KEY (`penguji1_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_surat_seminar_penguji2_id_foreign` FOREIGN KEY (`penguji2_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_surat_seminar_seminar_id_foreign` FOREIGN KEY (`seminar_id`) REFERENCES `ta1_seminar` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_surat_tugas`
--
ALTER TABLE `ta1_surat_tugas`
  ADD CONSTRAINT `ta1_surat_tugas_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta1_tugas_akhir` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta1_tugas_akhir`
--
ALTER TABLE `ta1_tugas_akhir`
  ADD CONSTRAINT `ta1_tugas_akhir_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_tugas_akhir_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta1_tugas_akhir_topik_id_foreign` FOREIGN KEY (`topik_id`) REFERENCES `topik` (`topik_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_berita_acara_seminar`
--
ALTER TABLE `ta2_berita_acara_seminar`
  ADD CONSTRAINT `ta2_berita_acara_seminar_seminar_id_foreign` FOREIGN KEY (`seminar_id`) REFERENCES `ta2_seminar` (`seminar_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_berita_acara_sidang`
--
ALTER TABLE `ta2_berita_acara_sidang`
  ADD CONSTRAINT `ta2_berita_acara_sidang_sidang_id_foreign` FOREIGN KEY (`sidang_id`) REFERENCES `ta2_sidang` (`sidang_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_bimbingan`
--
ALTER TABLE `ta2_bimbingan`
  ADD CONSTRAINT `ta2_bimbingan_dosen_id_2_foreign` FOREIGN KEY (`dosen_id_2`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_bimbingan_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_bimbingan_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta2_ta` (`ta_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_dosen_sidang`
--
ALTER TABLE `ta2_dosen_sidang`
  ADD CONSTRAINT `ta2_dosen_sidang_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_dosen_sidang_sidang_id_foreign` FOREIGN KEY (`sidang_id`) REFERENCES `ta2_sidang` (`sidang_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_dosen_ta`
--
ALTER TABLE `ta2_dosen_ta`
  ADD CONSTRAINT `ta2_dosen_ta_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_dosen_ta_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta2_ta` (`ta_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_kelas`
--
ALTER TABLE `ta2_kelas`
  ADD CONSTRAINT `ta2_kelas_tim_ta_id_foreign` FOREIGN KEY (`tim_ta_id`) REFERENCES `tim_ta` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_mahasiswa_kelas`
--
ALTER TABLE `ta2_mahasiswa_kelas`
  ADD CONSTRAINT `ta2_mahasiswa_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `ta2_kelas` (`kelas_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_mahasiswa_kelas_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_nilai_sidang`
--
ALTER TABLE `ta2_nilai_sidang`
  ADD CONSTRAINT `ta2_nilai_sidang_bas_id_foreign` FOREIGN KEY (`bas_id`) REFERENCES `ta2_berita_acara_sidang` (`bas_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_nilai_sidang_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_pengumuman`
--
ALTER TABLE `ta2_pengumuman`
  ADD CONSTRAINT `ta2_pengumuman_timta_id_foreign` FOREIGN KEY (`timTA_id`) REFERENCES `tim_ta` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_progress_summary`
--
ALTER TABLE `ta2_progress_summary`
  ADD CONSTRAINT `ta2_progress_summary_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta2_ta` (`ta_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_seminar`
--
ALTER TABLE `ta2_seminar`
  ADD CONSTRAINT `ta2_seminar_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta2_ta` (`ta_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_sidang`
--
ALTER TABLE `ta2_sidang`
  ADD CONSTRAINT `ta2_sidang_ta_id_foreign` FOREIGN KEY (`ta_id`) REFERENCES `ta2_ta` (`ta_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_ta`
--
ALTER TABLE `ta2_ta`
  ADD CONSTRAINT `ta2_ta_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_ta_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_ta_topik_id_foreign` FOREIGN KEY (`topik_id`) REFERENCES `topik` (`topik_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_tugas_kelas`
--
ALTER TABLE `ta2_tugas_kelas`
  ADD CONSTRAINT `ta2_tugas_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `ta2_kelas` (`kelas_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_tugas_kelas_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `ta2_tugas` (`tugas_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ta2_tugas_mahasiswa`
--
ALTER TABLE `ta2_tugas_mahasiswa`
  ADD CONSTRAINT `ta2_tugas_mahasiswa_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta2_tugas_mahasiswa_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `ta2_tugas` (`tugas_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tim_ta`
--
ALTER TABLE `tim_ta`
  ADD CONSTRAINT `tim_ta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `topik`
--
ALTER TABLE `topik`
  ADD CONSTRAINT `topik_pembimbing1_id_foreign` FOREIGN KEY (`pembimbing1_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topik_pembimbing2_id_foreign` FOREIGN KEY (`pembimbing2_id`) REFERENCES `dosen` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topik_usulan_id_foreign` FOREIGN KEY (`usulan_id`) REFERENCES `usulan_topik` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tu`
--
ALTER TABLE `tu`
  ADD CONSTRAINT `tu_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `usulan_topik`
--
ALTER TABLE `usulan_topik`
  ADD CONSTRAINT `usulan_topik_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
