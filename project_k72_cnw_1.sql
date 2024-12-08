-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 07, 2024 at 11:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_k72_cnw_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ho_so_nop`
--

CREATE TABLE `ho_so_nop` (
  `id_ho_so` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_nghanh` int(11) NOT NULL,
  `ho_va_ten` varchar(255) NOT NULL,
  `khoi_xet_tuyen` varchar(250) NOT NULL,
  `diem_toan` float NOT NULL,
  `diem_ly` float NOT NULL,
  `diem_hoa` float DEFAULT NULL,
  `diem_anh` float DEFAULT NULL,
  `diem_sinh` float DEFAULT NULL,
  `diem_lichsu` float DEFAULT NULL,
  `ngay_nop` date DEFAULT curdate(),
  `trang_thai` tinyint(1) NOT NULL,
  `giao_vien_duyet` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ho_so_nop`
--

INSERT INTO `ho_so_nop` (`id_ho_so`, `id_user`, `id_nghanh`, `ho_va_ten`, `khoi_xet_tuyen`, `diem_toan`, `diem_ly`, `diem_hoa`, `diem_anh`, `diem_sinh`, `diem_lichsu`, `ngay_nop`, `trang_thai`, `giao_vien_duyet`) VALUES
(31, 3, 3, 'Nguyễn Phương Hoàng Anh', 'A00', 8.5, 8.5, 8.5, 0, 0, 0, '2024-12-06', 2, 'Nguyễn Phương Hoàng Anh');

-- --------------------------------------------------------

--
-- Table structure for table `nghanh_xet_tuyen`
--

CREATE TABLE `nghanh_xet_tuyen` (
  `id_nghanh` int(250) NOT NULL,
  `ten_nghanh` varchar(250) NOT NULL,
  `khoi_xet_tuyen` varchar(250) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `giao_vien` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nghanh_xet_tuyen`
--

INSERT INTO `nghanh_xet_tuyen` (`id_nghanh`, `ten_nghanh`, `khoi_xet_tuyen`, `ngay_bat_dau`, `ngay_ket_thuc`, `trang_thai`, `giao_vien`) VALUES
(1, 'Công nghệ thông tin', 'A01', '2024-03-15', '2024-06-15', 1, 'Nguyễn Phương Hoàng Anh'),
(3, 'Sư phạm Tiếng Anh', 'A00', '2024-03-15', '2024-06-15', 1, 'Nguyễn Phương Hoàng Anh'),
(4, 'Y Đa Khoa', 'A00', '2024-04-09', '2024-10-09', 0, 'Nguyễn Phương Hoàng Anh'),
(5, 'Thú Y', 'B00', '2024-02-07', '2024-12-11', 1, 'Nguyễn Phương Hoàng Anh');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(250) NOT NULL,
  `ho_va_ten` varchar(250) NOT NULL,
  `tai_khoan` varchar(250) NOT NULL,
  `mat_khau` varchar(250) NOT NULL,
  `role` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ho_va_ten`, `tai_khoan`, `mat_khau`, `role`) VALUES
(1, 'Nguyễn Phương Hoàng Anh', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'Nguyễn Phương Hoàng Anh', 'gv', '7dc2e5a1851b162c949b9a7bd58ea968', 1),
(3, 'Nguyễn Phương Hoàng Anh', 'hs', '789406d01073ca1782d86293dcfc0764', 2),
(4, 'Nguyễn Phương Hoàng Anh', 'hs1', '789406d01073ca1782d86293dcfc0764', 2),
(6, 'Học Sinh 2', 'hs2', '280125cd77b5d140b0ef4fc6d238c2ba', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ho_so_nop`
--
ALTER TABLE `ho_so_nop`
  ADD PRIMARY KEY (`id_ho_so`),
  ADD KEY `id_nghanh` (`id_nghanh`),
  ADD KEY `ho_so_nop_ibfk_2` (`id_user`);

--
-- Indexes for table `nghanh_xet_tuyen`
--
ALTER TABLE `nghanh_xet_tuyen`
  ADD PRIMARY KEY (`id_nghanh`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ho_so_nop`
--
ALTER TABLE `ho_so_nop`
  MODIFY `id_ho_so` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `nghanh_xet_tuyen`
--
ALTER TABLE `nghanh_xet_tuyen`
  MODIFY `id_nghanh` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ho_so_nop`
--
ALTER TABLE `ho_so_nop`
  ADD CONSTRAINT `ho_so_nop_ibfk_1` FOREIGN KEY (`id_nghanh`) REFERENCES `nghanh_xet_tuyen` (`id_nghanh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ho_so_nop_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
