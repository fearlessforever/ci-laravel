-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2016 at 03:29 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype_si`
--

-- --------------------------------------------------------

--
-- Table structure for table `vxcsdf_pengaturan`
--

CREATE TABLE `vxcsdf_pengaturan` (
  `nama` varchar(51) NOT NULL,
  `isi1` text,
  `isi2` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vxcsdf_pengaturan`
--

INSERT INTO `vxcsdf_pengaturan` (`nama`, `isi1`, `isi2`) VALUES
('theme', 'default', NULL),
('title', 'Prototype System Informasi', NULL),
('asset', 'http://lupa.ninja/proto/assets/', '0'),
('sys_demo', '0', NULL),
('sys_hapus', '1', NULL),
('alamat', 'Jln. Ir Sutami no 18a', NULL),
('sys_debug_db', '1', NULL),
('sys_notif', '1', NULL),
('sys_bg', '6821dbc9d9d9afd5208bdd9439c9175b.jpg', 'upload/profile/');

-- --------------------------------------------------------

--
-- Table structure for table `vxcsdf_pengguna`
--

CREATE TABLE `vxcsdf_pengguna` (
  `userid` int(10) UNSIGNED NOT NULL,
  `username` varchar(27) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `passnya` varchar(100) NOT NULL,
  `level` varchar(27) NOT NULL,
  `reset_stat` tinyint(4) NOT NULL DEFAULT '0',
  `reset_token` varchar(50) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `buat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vxcsdf_pengguna`
--

INSERT INTO `vxcsdf_pengguna` (`userid`, `username`, `email`, `passnya`, `level`, `reset_stat`, `reset_token`, `nama`, `buat`, `blokir`) VALUES
(1, 'HeL', 'tes@tes.com', '$2y$10$dzinVFdDbCobplTDxyk4Mu2qsqjzO.hO4Qcj8BZBH0tSXwXLMuMFy', 'admin', 0, NULL, 'Fear Less', '2016-08-27 10:03:39', 'N'),
(17, 'mEmber1', 'johon.cena@tes.com', '$2y$10$521GitpBWeKzNEpC0DA/DuUQjkKoD2OcRS13OL4pxd/zWBLPZbIAa', 'member', 0, NULL, 'Jhon Cena', '2016-09-06 11:03:42', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `vxcsdf_pengguna_ext`
--

CREATE TABLE `vxcsdf_pengguna_ext` (
  `userid` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '',
  `isi` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vxcsdf_pengguna_ext`
--

INSERT INTO `vxcsdf_pengguna_ext` (`userid`, `nama`, `isi`) VALUES
(1, 'folder', 'upload/profile/'),
(1, 'profile_pic', 'c4ca4238a0b923820dcc509a6f75849b.jpg'),
(1, 'last_seen_notif', '1473165843'),
(17, 'profile_pic', '70efdf2ec9b086079795c442636b55fb.jpg'),
(17, 'folder', 'upload/profile/');

-- --------------------------------------------------------

--
-- Table structure for table `vxcsdf_pengguna_izin`
--

CREATE TABLE `vxcsdf_pengguna_izin` (
  `level` varchar(27) NOT NULL,
  `nama_app` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vxcsdf_pengguna_izin`
--

INSERT INTO `vxcsdf_pengguna_izin` (`level`, `nama_app`) VALUES
('member', 'dashboard'),
('member', 'sys-info'),
('member', 'user-profile');

-- --------------------------------------------------------

--
-- Table structure for table `vxcsdf_pengguna_lvl`
--

CREATE TABLE `vxcsdf_pengguna_lvl` (
  `level` varchar(27) NOT NULL,
  `ket` text NOT NULL,
  `bintang` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vxcsdf_pengguna_lvl`
--

INSERT INTO `vxcsdf_pengguna_lvl` (`level`, `ket`, `bintang`) VALUES
('admin', 'Super User', 5),
('member', 'Anggota', 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_aplikasi`
--

CREATE TABLE `z_aplikasi` (
  `nama_app` varchar(60) NOT NULL DEFAULT '',
  `mode` varchar(50) NOT NULL DEFAULT '',
  `file_view` text,
  `file_model` text,
  `perawatan` tinyint(4) NOT NULL DEFAULT '0',
  `urutan` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` varchar(99) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_aplikasi`
--

INSERT INTO `z_aplikasi` (`nama_app`, `mode`, `file_view`, `file_model`, `perawatan`, `urutan`, `keterangan`) VALUES
('dashboard', 'system', 'dashboard_view', NULL, 0, 0, 'Dashboard'),
('systems', 'system', 'pengaturan', 'pengaturan', 0, 0, 'Pengaturan'),
('user-profile', 'system', 'user_profile', 'user_profile', 0, 0, 'User Profile'),
('manage-user', 'system', 'manage_user_view', 'manage_user_model', 0, 0, 'User Management'),
('sys-notif', 'system', NULL, 'sys_notif', 0, 0, 'System Notification'),
('manage-app', 'system', 'manage_app_view', 'manage_app_model', 0, 0, 'App Management'),
('sys-info', 'system', 'sys_info_view', NULL, 0, 0, 'Info');

-- --------------------------------------------------------

--
-- Table structure for table `z_info`
--

CREATE TABLE `z_info` (
  `id` varchar(5) NOT NULL DEFAULT '',
  `tipe` varchar(27) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_info`
--

INSERT INTO `z_info` (`id`, `tipe`, `tanggal`, `judul`, `keterangan`) VALUES
('1', 'author', '2016-08-11', '<i class="fa fa-btc"></i> Siapakah Pembuat Prototype System Informasi ini ?', 'Halo ... Salam Kenal , Pembuat Prototype System Informasi ini adalah Helmi (a.k.a HeL)   , Institut Teknologi Indonesia'),
('2', 'author', '2016-08-11', '<i class="fa fa-coffee"></i> Bagaimana cara menghubungi Author Prototype System Informasi Ini ?', 'Anda bisa menghubungi Author ( Helmi ) melalui info kontak berikut :\r\n		<ul>\r\n			<li> Nomor Hp : 0895700738289</li>\r\n			<li> BBM : D0D76205 </li>\r\n		</ul>\r\n		<br>\r\n		*** N.B : Jika anda memiliki saran dan ide untuk System yang lebih baik , silahkan hubungi Author .'),
('1', 'log', '2016-08-11', '05 Sepetember 2016 Release versi 0.1 ', 'Release Prototype System Informasi'),
('1', 'info', '2016-08-11', '<i class="fa fa-building-o"></i> Apa itu Prototype System Informasi ?', 'Prototype bisa dibilang juga adalah sebuah cetak biru (blueprint) atau model dari sebuah sistem atau perangkat yang nanti bisa dikembangkan ke depannya. <br>Prototype System Informasi ini dibuat untuk memudahkan developer untuk membuat Aplikasi Sistem Informasi yang biasa nya membutuhkan level login (multi level login) , hak akses , login,pengaturan user . <br> Jadi jika menggunakan prototype system ini anda cukup membuat module aplikasi yang akan anda gunakan saja .'),
('2', 'info', '2016-09-05', '<i class="fa fa-cloud"></i> Apa saja kelebihan Prototype SI ini ?', '<p>Saya menyadari kalau Prototype system ini masih jauh dari sempurna , jadi kedepannya jika ada saran atau masukan atapun anda ingin berkontribusi untuk Prototype Sistem Informasi yang lebih bagus silahkan push di github</p>\r\n<p>Sejauh ini Teknologi yang diterapkan dalam System Informasi ini adalah</p>\r\n<ul>\r\n<li>System Informasi ini dibuat menggunakan Code Igniter versi 3</li>\r\n<li>Tidak ada modifikasi dari core framework CI </li>\r\n<li>Menggunakan konsep namespace </li>\r\n<li>Akses Database menggunakan Component Database dari Laravel , jadi bisa menggunakan query builder nya Laravel ataupun Eloquent ORM nya Laravel Di Prototype System informasi ini. </li>\r\n<li> Fat Less Controller semua proses ada di Model</li>\r\n<li>Tidak menggunakan Query Builder ny CI dikarenakan CI tidak melakukan bind param ataupun value di query yg di eksekusi </li>\r\n<li>95% menggunakan ajax </li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Table structure for table `z_notif`
--

CREATE TABLE `z_notif` (
  `waktu` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tipe` tinyint(4) NOT NULL DEFAULT '0',
  `userid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `keterangan` varchar(99) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `z_notif`
--

INSERT INTO `z_notif` (`waktu`, `tipe`, `userid`, `keterangan`) VALUES
(1472758409, 1, 0, 'System Log Has Been Clear'),
(1472758424, 0, 0, ''),
(1472762643, 0, 0, ''),
(1472763454, 0, 1, ''),
(1472765016, 0, 2, ''),
(1472765056, 0, 1, ''),
(1472765624, 0, 2, ''),
(1472766218, 0, 2, ''),
(1472767665, 0, 5, ''),
(1472768047, 0, 2, ''),
(1472772084, 0, 2, ''),
(1472772170, 0, 2, ''),
(1472772271, 0, 2, ''),
(1472772372, 0, 2, ''),
(1472772545, 0, 2, ''),
(1472772655, 0, 2, ''),
(1472775441, 0, 6, ''),
(1472775486, 0, 6, ''),
(1472775724, 1, 1, ' Settingan System'),
(1472777916, 0, 1, ''),
(1472778022, 0, 6, ''),
(1472778079, 0, 2, ''),
(1472780599, 1, 1, ' Settingan System'),
(1472800358, 0, 1, ''),
(1472827088, 0, 1, ''),
(1472868050, 0, 1, ''),
(1472874802, 0, 9, ''),
(1472879471, 0, 10, ''),
(1472879692, 0, 10, ''),
(1472881802, 1, 1, ' Settingan System'),
(1472881977, 1, 1, ' Settingan System'),
(1472907820, 0, 1, ''),
(1472911365, 0, 1, ''),
(1472912647, 1, 1, ' Settingan System'),
(1472919889, 0, 1, ''),
(1472951966, 1, 1, ' Settingan System'),
(1472984051, 0, 1, ''),
(1472994493, 1, 1, ' Settingan System'),
(1473013111, 1, 1, ' Settingan System'),
(1473013116, 1, 1, ' Settingan System'),
(1473082157, 1, 1, ' Settingan System'),
(1473115698, 0, 1, ''),
(1473126420, 0, 1, ''),
(1473133150, 1, 1, ' Settingan System'),
(1473134708, 0, 17, ''),
(1473136650, 1, 1, ' Settingan System'),
(1473136652, 1, 1, ' Settingan System'),
(1473139524, 0, 17, ''),
(1473141597, 1, 1, ' Set Background '),
(1473162020, 0, 1, ''),
(1473162591, 0, 1, ''),
(1473162944, 0, 17, ''),
(1473164399, 0, 1, ''),
(1473165387, 0, 1, ''),
(1473165863, 0, 17, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vxcsdf_pengaturan`
--
ALTER TABLE `vxcsdf_pengaturan`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `vxcsdf_pengguna`
--
ALTER TABLE `vxcsdf_pengguna`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `Index 1` (`username`),
  ADD UNIQUE KEY `Index 2` (`email`);

--
-- Indexes for table `vxcsdf_pengguna_ext`
--
ALTER TABLE `vxcsdf_pengguna_ext`
  ADD PRIMARY KEY (`userid`,`nama`);

--
-- Indexes for table `vxcsdf_pengguna_izin`
--
ALTER TABLE `vxcsdf_pengguna_izin`
  ADD PRIMARY KEY (`level`,`nama_app`);

--
-- Indexes for table `vxcsdf_pengguna_lvl`
--
ALTER TABLE `vxcsdf_pengguna_lvl`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `z_aplikasi`
--
ALTER TABLE `z_aplikasi`
  ADD PRIMARY KEY (`nama_app`);

--
-- Indexes for table `z_info`
--
ALTER TABLE `z_info`
  ADD PRIMARY KEY (`id`,`tipe`);

--
-- Indexes for table `z_notif`
--
ALTER TABLE `z_notif`
  ADD KEY `Index 1` (`waktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vxcsdf_pengguna`
--
ALTER TABLE `vxcsdf_pengguna`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
