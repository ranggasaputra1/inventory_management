-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2024 pada 08.59
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myinventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barangs`
--

CREATE TABLE `data_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `data_ruangan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merk_barang` varchar(255) DEFAULT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `foto_barang` varchar(255) DEFAULT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `kondisi_barang` varchar(255) NOT NULL,
  `status_barang` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_barangs`
--

INSERT INTO `data_barangs` (`id`, `kode_barang`, `data_ruangan_id`, `nama_barang`, `merk_barang`, `jenis_barang`, `satuan_barang`, `foto_barang`, `jumlah_barang`, `kondisi_barang`, `status_barang`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '123456', 1, 'Laptop', 'Acer', 'Elektronik', 'Pcs', '1724914682_1693586160053-10-Rekomendasi-Laptop-Terbaik-untuk-Data-Analyst-2023.jpg', 1, 'Baik', 'Baik', 'Satu paket komputer lengkap dengan mouse dan keyboard yang siap digunakan untuk mahasiswa beraktifitas di lab komputer', '2024-08-28 23:51:25', '2024-08-28 23:58:02'),
(2, '7890', 3, 'Raket', 'Yonex', 'Alat Olahraga', 'Pcs', 'Xhl6iONuyWMiimLb6lsji2TLUqRcAGXod4dkv52T.jpg', 1, 'Baik', 'baik', 'Raket Yonex yang tersedia untuk seluruh mahasiswa yang ingin bermain bulu tangkis', '2024-08-28 23:54:05', '2024-08-28 23:56:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_peminjaman`
--

CREATE TABLE `data_peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `kode_barang` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_ruangan` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ruangans`
--

CREATE TABLE `data_ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_ruangan` varchar(255) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `kondisi_ruangan` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_ruangans`
--

INSERT INTO `data_ruangans` (`id`, `kode_ruangan`, `nama_ruangan`, `kondisi_ruangan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'G2021', 'Lab Komputer', 'Baik untuk digunakan', 'Ruangan ini biasa digunakan untuk aktifitas belajar mengajar mahasiswa dan praktik langsung untuk pembelajaran komputer', '2024-08-28 23:47:00', '2024-08-28 23:48:59'),
(3, 'G2022', 'Ruang Olahraga', 'Baik untuk digunakan', 'Ruangan olahraga ini biasa digunakan untuk aktifitas olahraga mahasiswa, dimana terdapat juga fasilitas dan alat olahraga didalamnya', '2024-08-28 23:48:45', '2024-08-28 23:48:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_14_005812_create_data_ruangans_table', 1),
(6, '2024_08_14_030646_create_data_barangs_table', 1),
(7, '2024_08_14_060558_create_pengadaans_table', 1),
(8, '2024_08_14_073703_create_data_peminjaman_table', 1),
(9, '2024_08_14_232600_add_deleted_at_to_data_peminjaman_table', 1),
(10, '2024_08_15_090407_add_profile_picture_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaans`
--

CREATE TABLE `pengadaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  `kode_barang` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_picture`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '2024-08-28 23:44:19', 0, '$2y$10$60qJNk/p5mkq0Pq/1sdl6e3U0ui0CMPIfOCcMyMPAwah8rdvHIwsm', NULL, '2024-08-28 23:44:19', '2024-08-28 23:44:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_barangs`
--
ALTER TABLE `data_barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_barangs_kode_barang_unique` (`kode_barang`),
  ADD KEY `data_barangs_data_ruangan_id_foreign` (`data_ruangan_id`);

--
-- Indeks untuk tabel `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_peminjaman_kode_barang_foreign` (`kode_barang`),
  ADD KEY `data_peminjaman_kode_ruangan_foreign` (`kode_ruangan`);

--
-- Indeks untuk tabel `data_ruangans`
--
ALTER TABLE `data_ruangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_ruangans_kode_ruangan_unique` (`kode_ruangan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengadaans`
--
ALTER TABLE `pengadaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengadaans_kode_barang_foreign` (`kode_barang`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_barangs`
--
ALTER TABLE `data_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_ruangans`
--
ALTER TABLE `data_ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengadaans`
--
ALTER TABLE `pengadaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_barangs`
--
ALTER TABLE `data_barangs`
  ADD CONSTRAINT `data_barangs_data_ruangan_id_foreign` FOREIGN KEY (`data_ruangan_id`) REFERENCES `data_ruangans` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  ADD CONSTRAINT `data_peminjaman_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `data_barangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_peminjaman_kode_ruangan_foreign` FOREIGN KEY (`kode_ruangan`) REFERENCES `data_ruangans` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pengadaans`
--
ALTER TABLE `pengadaans`
  ADD CONSTRAINT `pengadaans_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `data_barangs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
