-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3310
-- Waktu pembuatan: 14 Jan 2022 pada 19.51
-- Versi server: 5.7.24
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_case_majoo_1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` mediumint(3) NOT NULL,
  `email` char(50) NOT NULL,
  `name` char(50) NOT NULL,
  `password` char(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin1@example.com', 'admin 1', '$2y$10$0eFOJgl.XKtGfylmkZJAl.K/85Lxiy3v7O/NGGQh7hEJAvJO/UYCC', '2022-01-14 16:45:19', '2022-01-14 16:45:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `image`
--

CREATE TABLE `image` (
  `id` mediumint(9) NOT NULL,
  `product_id` mediumint(6) DEFAULT NULL,
  `path` char(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `image`
--

INSERT INTO `image` (`id`, `product_id`, `path`, `created_at`, `updated_at`) VALUES
(1, NULL, 'img/test_upload/1642146262-61e129d674b6e.jpg', '2022-01-14 00:44:22', '2022-01-14 00:44:22'),
(2, NULL, 'img/test_upload/1642146278-61e129e69a416.jpg', '2022-01-14 00:44:38', '2022-01-14 00:44:38'),
(3, NULL, 'img/test_upload/1642146316-61e12a0c93628.jpg', '2022-01-14 00:45:16', '2022-01-14 00:45:16'),
(7, NULL, 'img/test_upload/1642146887-61e12c47bdb96.jpg', '2022-01-14 00:54:47', '2022-01-14 00:54:47'),
(8, NULL, 'img/test_upload/1642146894-61e12c4e0c149.jpg', '2022-01-14 00:54:54', '2022-01-14 00:54:54'),
(12, 6, 'img/test_upload/1642187643-61e1cb7bcc302.jpg', '2022-01-14 12:14:03', '2022-01-14 12:14:16'),
(13, 6, 'img/test_upload/1642187652-61e1cb84c1295.jpg', '2022-01-14 12:14:12', '2022-01-14 12:14:16'),
(14, 7, 'img/test_upload/1642187696-61e1cbb091621.jpg', '2022-01-14 12:14:56', '2022-01-14 12:14:58'),
(15, 1, 'img/test_upload/1642188426-61e1ce8a8d7e6.png', '2022-01-14 12:27:06', '2022-01-14 12:29:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` mediumint(6) NOT NULL,
  `category_id` smallint(3) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text,
  `price` int(14) NOT NULL,
  `added_by` tinyint(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mesin Kasir', '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam fugiat ullam cumque dolor mollitia, quaerat eius pariatur? Facere necessitatibus consequatur a ad veniam eum at minus dolore. Maiores, at ea!</p>', 3200000, NULL, '2022-01-13 00:59:30', '2022-01-14 12:29:51'),
(3, 6, 'Produk 10', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet eos nesciunt exercitationem, dolore est at neque distinctio sequi ducimus nostrum voluptas enim atque deserunt possimus ab commodi corrupti velit pariatur iste? Repudiandae, et vel! Amet repellendus corporis debitis nostrum atque est ut quam, architecto id ducimus soluta saepe deleniti culpa!', 70000, NULL, '2022-01-13 11:18:07', '2022-01-13 11:18:07'),
(4, 7, 'Produk 123123', '<p>asdasdasd</p>', 123123, NULL, '2022-01-14 00:51:14', '2022-01-14 00:51:14'),
(6, 6, 'Printer', '<p>Ini deskripsi printer</p>', 1250000, 1, '2022-01-14 12:14:16', '2022-01-14 12:14:16'),
(7, 7, 'Printer Thermal', '<p>Ini deskripsi printer thermal</p>', 1780000, 1, '2022-01-14 12:14:58', '2022-01-14 12:14:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `id` mediumint(6) NOT NULL,
  `name` char(255) NOT NULL,
  `description` text,
  `added_by` tinyint(3) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `description`, `added_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Kategori 1 Update', 'Ini deskripsi kategori 1', 1, 0, '2022-01-13 07:44:36', '2022-01-13 09:13:03'),
(2, 'Kategori 2', 'lorem ipsum dolor sit amet', 1, 0, '2022-01-13 09:03:06', '2022-01-13 09:03:06'),
(3, 'Kategori 3', 'Ini deskripsi kategori 3', 1, 1, '2022-01-13 09:04:43', '2022-01-13 09:49:39'),
(5, 'Kategori 5', NULL, 1, 0, '2022-01-13 09:57:46', '2022-01-13 09:57:46'),
(6, 'Kategori 6', NULL, 1, 0, '2022-01-13 09:57:56', '2022-01-13 09:57:56'),
(7, 'Kategori 7', NULL, 1, 0, '2022-01-13 09:58:04', '2022-01-13 09:58:04'),
(8, 'Kategori 8', NULL, 1, 0, '2022-01-13 09:58:12', '2022-01-13 09:58:12'),
(9, 'Kategori 9', NULL, 1, 0, '2022-01-13 09:58:21', '2022-01-13 09:58:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` mediumint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `image`
--
ALTER TABLE `image`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
