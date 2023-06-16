-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 04:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kd_kecamatan` varchar(50) NOT NULL,
  `nm_kecamatan` varchar(30) NOT NULL,
  `geojson_kecamatan` varchar(30) NOT NULL,
  `warna_kecamatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`id_kecamatan`, `kd_kecamatan`, `nm_kecamatan`, `geojson_kecamatan`, `warna_kecamatan`) VALUES
(7, '3515010', 'Tarik', 'tarik.geojson', '#7FFF00'),
(8, '3515020', 'Prambon', 'prambon.geojson', '#D2691E'),
(9, '3515030', 'Krembung', 'krembung.geojson', '#FF7F50'),
(10, '3515040', 'Porong', 'porong.geojson', '#6495ED'),
(11, '3515050', 'Jabon', 'jabon.geojson', '#FFF8DC'),
(12, '3515060', 'Tanggulangin', 'tanggulangin.geojson', '#00FFFF'),
(13, '3515070', 'Candi', 'candi.geojson', '#00008B'),
(14, '3515080', 'Tulangan', 'tulangan.geojson', '#9400D3'),
(15, '3515090', 'Wonoayu', 'wonoayu.geojson', '#00BFFF'),
(16, '3515100', 'Sukodono', 'sukodono.geojson', '#1E90FF'),
(17, '3515110', 'Sidoarjo', 'sidoarjo.geojson', '#228B22'),
(18, '3515120', 'Buduran', 'buduran.geojson', '#F0FFF0'),
(19, '3515130', 'Sedati', 'sedati.geojson', '#FFD700'),
(20, '3515140', 'Waru', 'waru.geojson', '#F0E68C'),
(21, '3515150', 'Gedangan', 'gedangan.geojson', '#FFFACD'),
(22, '3515160', 'Taman', 'taman.geojson', '#FFA07A'),
(23, '3515170', 'Krian', 'krian.geojson', '#FFE4B5'),
(24, '3515180', 'Balong Bendo', 'balongbendo.geojson', '#000080');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nm_pengguna` varchar(20) NOT NULL,
  `kt_sandi` varchar(32) NOT NULL,
  `level` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nm_pengguna`, `kt_sandi`, `level`) VALUES
(1, 'admin', '123456', 'Admin'),
(2, 'User1', '123456', 'User'),
(5, 'bayu', 'bayugokil', 'User'),
(6, 'ucup', 'duatigaempat', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `rs`
--

CREATE TABLE `rs` (
  `id_rs` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `nm_rs` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tipe` varchar(30) NOT NULL,
  `jn_rs` varchar(50) NOT NULL,
  `jml_pelayanan` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `no_tlp` varchar(50) NOT NULL,
  `lat` float(9,6) NOT NULL,
  `lng` float(9,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rs`
--

INSERT INTO `rs` (`id_rs`, `id_kecamatan`, `nm_rs`, `alamat`, `tipe`, `jn_rs`, `jml_pelayanan`, `email`, `no_tlp`, `lat`, `lng`) VALUES
(1, 17, 'RS Umum Daerah Sidoarjo', 'Jl. Mojopahit No.667, Sidowayah, Celep', 'B', 'RSU', '60 ', 'program.rsud@gmail.com', '0318961649', -7.465025, 112.715630),
(2, 22, 'RS Umum Siti Khodijah Muhammadiyah Cabang Sepanjang', 'Jl. Raya Bebekan, RT.02/RW.01, Bebekan', 'B', 'RSU', '45', 'siti-khodijah@hotmail.com ', '0317882123', -7.344633, 112.699013),
(3, 10, 'RS Umum Pusdik Polri Porong', 'Jl. Raya Porong No.1, Porong, Kec. Porong', 'C', 'RSU', '45 ', 'rsbporong@gmail.com', '0343856444', -7.543268, 112.698418),
(4, 17, 'RS Umum Delta Surya', 'Jl. Pahlawan No.9, Jati', 'C', 'RSU', '40', ' rsdeltasurya@gmail.com', '(031) 8962531', -7.446901, 112.701614),
(5, 17, 'RS Islam Siti Hajar Sidoarjo', 'Jl. Raden Patah No.70 - 72, Jasem, Bulusidokare', 'B', 'RSU', '83 ', 'rsi_sitihajar_sda@yahoo.co.id ', '031-8921233 ', -7.457533, 112.721947),
(6, 17, 'RS Umum Jasem', 'Jl. Samanhudi No.85a, Jasem, Bulusidokare', 'D', 'RSU', '14 ', 'rsujasem.sidoarjo@gmail.com ', '(031) 8962129', -7.459292, 112.721809),
(7, 24, 'RS Umum Anwar Medika', 'Jl. Bypass Krian No.KM. 33, Semawut, Balongbendo', 'C', 'RSU', '54 ', 'rsu.anwarmedika@gmail.com ', '8972052', -7.409802, 112.556953),
(8, 20, 'RS Umum Mitra Keluarga Waru', 'Jl. Jenderal S. Parman No.8, Krajan Kulon, Waru', 'B', 'RSU', '55 ', 'waru@mitrakeluarga.com ', '031-8543111/ 85', -7.362702, 112.728630),
(9, 22, 'RS Umum Usada', 'Jl. Jeruk No.117, Jatiagung, Wage', 'D', 'RSU', '4 ', 'rsusada@gmail.com ', '031 - 8539671', -7.370485, 112.713120),
(10, 22, 'RS Ibu dan Anak Kirana', 'Jl. Raya Ngelom No.87, Ngelom', 'C', 'RSIA', '12', 'rsiakirana@gmail.com ', '031 - 7881623', -7.349056, 112.691711),
(11, 23, 'RS Umum Al-Islam H. M. Mawardi', 'Jl. Kyai Mojo No.12 A, Dusun Jeruk, Jerukgamping', 'C', 'RSU', '33 ', 'rsu.alislam.hm.mawardi@gmail.com ', '(031) 8973379', -7.416897, 112.583321),
(12, 16, 'RS Umum Assakinah Medika', 'Jl. Raya Kebon Agung No.65, Sambang, Kebonagung', 'D', 'RSU', '9 ', 'assakinahmedikasda@gmail.com ', '031 - 8832354', -7.414362, 112.674187),
(13, 22, 'RS Ibu dan Anak Soerya', 'Jl. Raya Kalijaten No.11-15, Kalijaten', 'C', 'RSIA', '27', 'tu.soerya@gmail.com ', '031-7885011 ', -7.352173, 112.691772),
(14, 20, 'RS Umum Prima Husada', 'Jl. Letjen Suprapto No.3, Kundi, Kepuhkiriman', 'D', 'RSU', '15', 'rsuprimahusada@gmail.com ', '031-8672303', -7.352847, 112.766266),
(15, 7, 'RS Umum Citra Medika', 'Jalan Tol Surabaya - Mojokerto No.KM.44, Kramat, Kramat Temenggung', 'C', 'RSU', '32 ', 'rs@citramedika.com ', '(0321) 361000 ', -7.433021, 112.463570),
(16, 16, 'RS Umum Rahman Rahim', 'Jl. Raya Saimbang No.10, Kebonagung', 'D', 'RSU', '25', 'rahmanrahimrs@gmail.com ', '031 - 8830010 ', -7.420578, 112.672028),
(17, 21, 'RS Ibu dan Anak Mitra Husada', 'Jl. Raya Sruni No.159, Dusun Sruni, Sruni', 'C', 'RSIA', '13', 'rsia.mitrahusada@yahoo.com ', '031-8917479 ', -7.401001, 112.726944),
(18, 17, 'RS Ibu dan Anak Buah Delima', 'Jl. Sunandar Priyo Sudarmo No.154, Kuthuk, Sidokare', 'C', 'RSIA', '6 ', 'rsia.buahdelima@gmail.com ', '031-8056911', -7.462995, 112.713440),
(19, 17, 'RS DKT Sidoarjo', 'Jl. Dr. Soetomo No.2, Gajah Timur, Magersari', 'D', 'RSU', '23', 'rsdkt_sidoarjo@yahoo.co.id ', '0318964610 ', -7.444697, 112.716606),
(20, 22, 'RS Mata Fatma', 'Jl. Raya Kalijaten No.40, Kalijaten Timur, Kalijaten', 'C', 'RSK ', '21', 'boxfatma@gmail.com ', '(031) 7879857', -7.353061, 112.691406),
(21, 20, 'RS Ibu dan Anak Pondok Tjandra', 'Perumahan Pondok Tjandra, Jl. Mangga I No.E-225, Tambaksumur', 'C', 'RSIA', '18 ', 'pondoktjandra@gmail.com ', '031-8664488, 86', -7.345237, 112.779228),
(22, 14, 'RS Umum Aisyiyah Siti Fatimah', 'Jl. Raya Kenongo No.14, Kenongo', 'D', 'RSU', '19 ', 'aisyiyah.15@gmail.com ', '(031) 8856303', -7.485691, 112.653465),
(23, 17, 'RS Arafah Anwar Medika Sukodono', 'Jl. Raya Dungus Jl. Sawo No.2, Sukadono, Sukodono', 'D', 'RSU', '20 ', 'rsu.aams.sukodono@gmail.com ', '031 8830989 /03', -7.394226, 112.672974),
(24, 20, 'RS Umum Bunda', 'Jl. Raya Kundi No.70, Kundi, Kepuhkiriman', 'C', 'RSU', '23', 'rsbunda.sda@gmail.com ', '031-8668880', -7.351639, 112.770752),
(25, 8, 'RS Umum Aminah', 'Jl. Soenandar Priyo Sudarmo, Watutulis Utara, Watutulis', 'D', 'RSU', '22 ', 'rsiaminah557@gmail.com ', '031-99890993', -7.440286, 112.573318),
(26, 23, 'RS Umum Mitra Sehat Mandiri Sidoarjo', 'Jl. Krian-Mojosari No.KM, RW.3, Balepanjang, Tropodo', 'D', 'RSU', '21 ', 'rumkit.msms@gmail.com ', '3199891626', -7.431941, 112.573906),
(27, 19, 'RS Sheila Medika', 'Jalan Letjen Wahono No.77-79 ( bypass Juanda Baru, Sedati Gede', 'D', 'RSU', '30', 'rssheilamedika@gmail.com ', '082244251088', -7.371679, 112.759712),
(28, 20, 'RS Mitra Keluarga Pondok Tjandra', 'Jl. Raya Taman Asri Kav. DD No. 1-8, Tambaksumur', 'C', 'RSU', '90 ', 'pondoktjandra@mitrakeluarga.com ', '031 99691999', -7.344797, 112.775482),
(29, 13, 'RS Pusura Candi', 'Jl. Raya Gelam No.34, Gelam', 'D', 'RSU', '25 ', 'rspusuracandi@gmail.com ', '', -7.486316, 112.712555);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `rs`
--
ALTER TABLE `rs`
  ADD PRIMARY KEY (`id_rs`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rs`
--
ALTER TABLE `rs`
  MODIFY `id_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rs`
--
ALTER TABLE `rs`
  ADD CONSTRAINT `rs_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `m_kecamatan` (`id_kecamatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
