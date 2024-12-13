-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Des 2024 pada 09.16
-- Versi Server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbpuskesmas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accountpasien`
--

CREATE TABLE IF NOT EXISTS `accountpasien` (
`accountpasienId` int(10) NOT NULL,
  `accountpasienName` varchar(50) NOT NULL,
  `accountpasienNik` varchar(50) NOT NULL DEFAULT '0',
  `accountpasienGender` int(10) NOT NULL,
  `accountpasienGolongan` int(10) NOT NULL,
  `accountpasienUsia` int(10) NOT NULL,
  `accountpasienAlamat` varchar(200) NOT NULL,
  `accountpasienLahir` date NOT NULL,
  `accountpasienDelete` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `accountpasien`
--

INSERT INTO `accountpasien` (`accountpasienId`, `accountpasienName`, `accountpasienNik`, `accountpasienGender`, `accountpasienGolongan`, `accountpasienUsia`, `accountpasienAlamat`, `accountpasienLahir`, `accountpasienDelete`) VALUES
(2, 'Rafi', '33109898789675', 2, 7, 15, 'Batang', '2000-01-23', 0),
(3, 'John Smith1', '2147483647', 1, 5, 20, 'Reban', '2007-05-31', 0),
(4, 'Jonggun', '15', 1, 8, 28, 'Tokyo', '1997-06-18', 0),
(5, 'John Smith1', '2147483647', 1, 5, 34, 'Rhikk', '2024-11-14', 0),
(6, 'John Smith1', '2147483647', 1, 6, 43, 'drjghj', '2024-11-26', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarpasien`
--

CREATE TABLE IF NOT EXISTS `daftarpasien` (
`daftarpasienId` int(11) NOT NULL,
  `daftarpasienTrx` varchar(50) NOT NULL,
  `daftarpasienpoliId` int(11) NOT NULL,
  `daftarpasienNik` int(11) NOT NULL,
  `daftarpasiennameId` varchar(50) NOT NULL DEFAULT '0',
  `daftarpasienKeluhan` varchar(50) NOT NULL,
  `daftarpasienStatus` int(11) NOT NULL,
  `daftarpasienDate` date NOT NULL,
  `daftarpasienDelete` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftarpasien`
--

INSERT INTO `daftarpasien` (`daftarpasienId`, `daftarpasienTrx`, `daftarpasienpoliId`, `daftarpasienNik`, `daftarpasiennameId`, `daftarpasienKeluhan`, `daftarpasienStatus`, `daftarpasienDate`, `daftarpasienDelete`) VALUES
(1, 'PG/1224/001', 1, 4, 'Jonggun', 'sering batuk keluar angin', 1, '2024-12-11', 0),
(2, 'PGZ/1224/001', 3, 2, 'Rafi', 'sering batuk keluar angin', 1, '2024-12-11', 0),
(4, 'PGZ/1224/003', 3, 4, 'Jonggun', 'suka terbang', 1, '2024-12-11', 0),
(5, 'PGZ/1224/002', 3, 3, 'John Smith1', 'sering batuk keluar angin', 1, '2024-12-11', 0),
(6, 'PU/1224/001', 1, 5, 'John Smith1', 'sering batuk keluar angin', 0, '2024-12-11', 0),
(7, 'PU/1224/002', 1, 3, 'John Smith1', 'sering batuk keluar angin', 0, '2024-12-11', 0),
(8, 'PG/1224/002', 2, 2, 'Rafi', 'sering batuk keluar angin', 1, '2024-12-12', 0),
(9, 'PGZ/1224/004', 3, 4, 'Jonggun', 'lolol', 0, '2024-12-13', 0),
(10, 'PG/1224/003', 2, 5, 'John Smith1', 'Kamehameha', 0, '2024-12-13', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarpoli`
--

CREATE TABLE IF NOT EXISTS `daftarpoli` (
  `daftarpoliId` int(11) NOT NULL,
  `daftarpoliName` varchar(50) NOT NULL,
  `daftarpoliDelete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftarpoli`
--

INSERT INTO `daftarpoli` (`daftarpoliId`, `daftarpoliName`, `daftarpoliDelete`) VALUES
(1, 'PoliUmum', 0),
(2, 'PoliGigi', 0),
(3, 'PoliGizi', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
`genderId` int(11) NOT NULL,
  `genderName` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gender`
--

INSERT INTO `gender` (`genderId`, `genderName`) VALUES
(1, 'Lak-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongandarah`
--

CREATE TABLE IF NOT EXISTS `golongandarah` (
`golongandarahId` int(11) NOT NULL,
  `golongandarahName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongandarah`
--

INSERT INTO `golongandarah` (`golongandarahId`, `golongandarahName`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountpasien`
--
ALTER TABLE `accountpasien`
 ADD PRIMARY KEY (`accountpasienId`), ADD KEY `accountpasienGender` (`accountpasienGender`), ADD KEY `accountpasienGolongan` (`accountpasienGolongan`);

--
-- Indexes for table `daftarpasien`
--
ALTER TABLE `daftarpasien`
 ADD PRIMARY KEY (`daftarpasienId`), ADD KEY `daftarpasienpoliId` (`daftarpasienpoliId`);

--
-- Indexes for table `daftarpoli`
--
ALTER TABLE `daftarpoli`
 ADD PRIMARY KEY (`daftarpoliId`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
 ADD PRIMARY KEY (`genderId`);

--
-- Indexes for table `golongandarah`
--
ALTER TABLE `golongandarah`
 ADD PRIMARY KEY (`golongandarahId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountpasien`
--
ALTER TABLE `accountpasien`
MODIFY `accountpasienId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `daftarpasien`
--
ALTER TABLE `daftarpasien`
MODIFY `daftarpasienId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
MODIFY `genderId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `golongandarah`
--
ALTER TABLE `golongandarah`
MODIFY `golongandarahId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `accountpasien`
--
ALTER TABLE `accountpasien`
ADD CONSTRAINT `gender` FOREIGN KEY (`accountpasienGender`) REFERENCES `gender` (`genderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `golongan` FOREIGN KEY (`accountpasienGolongan`) REFERENCES `golongandarah` (`golongandarahId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `daftarpasien`
--
ALTER TABLE `daftarpasien`
ADD CONSTRAINT `poli` FOREIGN KEY (`daftarpasienpoliId`) REFERENCES `daftarpoli` (`daftarpoliId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
