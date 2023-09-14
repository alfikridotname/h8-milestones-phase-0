-- Insert Users
INSERT INTO `company_profile_db`.`users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `created_at`, `updated_at`, `level`, `status`) VALUES (1, 'AL', 'FIKRI', 'alfikri.name@gmail.com', 'alfikridotname', '$2y$10$e8uXCbxBJeEIynYtXmMm5elKNAYyOc2JTzJXc9NZ5f/Gx8tQORNpe', '2023-09-12 16:50:30', '2023-09-13 06:58:30', 'admin', 1);

-- Insert Categories
INSERT INTO `company_profile_db`.`categories` (`id`, `nama_kategory`, `deskripsi`, `created_at`, `updated_at`) VALUES (9, 'FERTILIZER', 'FERTILIZER', '2023-09-13 08:41:28', '2023-09-13 08:41:28');
INSERT INTO `company_profile_db`.`categories` (`id`, `nama_kategory`, `deskripsi`, `created_at`, `updated_at`) VALUES (10, 'NON FERTILIZER', 'NON FERTILIZER', '2023-09-13 08:41:47', '2023-09-13 08:41:47');

-- Insert Products
INSERT INTO `company_profile_db`.`products` (`id`, `kategori_id`, `nama_produk`, `foto`, `harga`, `created_at`, `updated_at`) VALUES (37, 9, 'Urea', 'urea.png', 120000.00, '2023-09-14 02:19:48', '2023-09-14 02:19:48');
INSERT INTO `company_profile_db`.`products` (`id`, `kategori_id`, `nama_produk`, `foto`, `harga`, `created_at`, `updated_at`) VALUES (38, 9, 'ZA', 'za.png', 300000.00, '2023-09-14 02:21:48', '2023-09-14 02:59:53');
INSERT INTO `company_profile_db`.`products` (`id`, `kategori_id`, `nama_produk`, `foto`, `harga`, `created_at`, `updated_at`) VALUES (39, 9, 'ZA Plus', 'za-plus.png', 324000.00, '2023-09-14 02:26:48', '2023-09-14 02:26:48');
INSERT INTO `company_profile_db`.`products` (`id`, `kategori_id`, `nama_produk`, `foto`, `harga`, `created_at`, `updated_at`) VALUES (40, 10, 'Petro Ponic', 'petro-ponic.png', 120000.00, '2023-09-14 02:28:18', '2023-09-14 02:28:18');

-- Insert Identity
INSERT INTO `company_profile_db`.`identity` (`id`, `nama_perusahaan`, `lokasi`, `email`, `telpon`) VALUES (1, 'PT. PUPUK INDO JAYA SUKSES', 'Padang, Sumatera Barat', 'no-reply@pupukindojayasukses.com', '0751-235464');