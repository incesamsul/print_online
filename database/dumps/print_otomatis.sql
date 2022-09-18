
INSERT INTO `cart` (`id_cart`, `id_user`, `id_produk`, `file`, `total`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '6323515b4fcf6.pdf', 0, '2022-09-15 08:22:51', '2022-09-15 08:22:51'),
(9, 4, 1, '6323f365c9007.pdf', 0, '2022-09-15 19:54:13', '2022-09-15 19:54:13'),
(13, 3, 1, '632667f366878.pdf', 0, '2022-09-17 16:36:03', '2022-09-17 16:36:03');

INSERT INTO `category` (`id_category`, `nama_category`, `created_at`, `updated_at`) VALUES
(1, 'print', NULL, NULL);


INSERT INTO `like` (`id_like`, `id_user`, `id_produk`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2022-09-15 19:34:31', '2022-09-15 19:34:31');


INSERT INTO `produk` (`id_produk`, `id_category`, `gambar_produk`, `nama_produk`, `harga_warna`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, '6323434c7e56d.jpg', 'print a4', 1000, 'print a4 harga 1000 / lembar', '2022-09-15 07:22:52', '2022-09-15 07:22:52');


INSERT INTO `profile` (`id_profile`, `id_user`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `nisn`, `alamat`, `no_telp`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `tahun_masuk`, `tahun_lulus`, `no_ijazah`, `no_skhun`, `created_at`, `updated_at`) VALUES
(1, 1, 'L', 'jl;', '2021-11-26', 'jlkjlj', 'ljlj', 'jl', 'jlj', 'ljl', 'jljl', 'jlkjl', 2000, 2000, 'jlkjlkj', 'lkjl', '2021-11-24 11:34:44', '2021-11-24 11:56:23'),
(2, 3, 'L', 'jl;', '2021-11-26', 'jlkjlj', 'ljlj', 'jl', 'jlj', 'ljl', 'jljl', 'jlkjl', 2000, 2000, 'jlkjlkj', 'lkjl', '2021-11-24 11:34:44', '2021-11-24 11:56:23'),
(3, 2, 'L', 'jl;', '2021-11-26', 'jlkjlj', 'ljlj', 'jl', 'jlj', 'ljl', 'jljl', 'jlkjl', 2000, 2000, 'jlkjlkj', 'lkjl', '2021-11-24 11:34:44', '2021-11-24 11:56:23');


INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_cart`, `total_amount`, `reference`, `merchant_reference`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 43000, 'DEV-T1542760570FKLKW', 'SAM-1663258993', 'paid', '2022-09-15 08:23:13', '2022-09-15 09:43:57'),
(4, 2, 2, 43000, 'DEV-T1542760574FYXFK', 'SAM-1663263992', 'paid', '2022-09-15 09:46:32', '2022-09-15 09:48:01'),
(8, 4, 9, 10000, 'DEV-T1542760592QRYMQ', 'SAM-1663300466', 'unpaid', '2022-09-15 19:54:26', '2022-09-15 19:54:26'),
(9, 4, 9, 10000, 'DEV-T1542760593RLYBA', 'SAM-1663300658', 'unpaid', '2022-09-15 19:57:39', '2022-09-15 19:57:39');


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', NULL, '$2y$10$N6nmGrHUtLAw5/5SlPZqEehn.S5KDNDFHf1yuW184mEw5zLWhVeLm', 'Administrator', '61b5cf20cb753.jpg', NULL, '2021-11-24 09:06:43', '2021-12-11 18:29:52'),
(2, 'ince', 'ince@mail.com', NULL, '$2y$10$uERSBz3.4uTzhmt6zFYE7OqIoFtVv7rfDU93/0aQo1C9zUG42Drui', 'user', '', NULL, '2022-09-15 07:21:48', '2022-09-15 07:21:48'),
(3, 'Sam', 'sam@mail.com', NULL, '$2y$10$rjQ5u/D2dmKFaI3phyOcs.6vef8CsVChSpbMosUcknyYGaig0toUm', 'user', '', NULL, '2022-09-15 19:28:36', '2022-09-15 19:28:36'),
(4, 'Hastini', 'hastini18@mhs.akba.ac.id', NULL, '$2y$10$EPl6Jg5bXGAiGGveNfaAiO4C5hx500fJjDtuOa8SvwX5RO7uwoF3i', 'user', '', NULL, '2022-09-15 19:45:00', '2022-09-15 19:45:00');

