-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 04:06 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interpolasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabelfriska`
--

CREATE TABLE `tabelfriska` (
  `id` int(11) NOT NULL,
  `dataKualitas` text NOT NULL,
  `waktuData` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabelfriska`
--

INSERT INTO `tabelfriska` (`id`, `dataKualitas`, `waktuData`) VALUES
(1, '[{\"id\" : \"1\", \"lat\" : \"-6.972837\", \"lng\" : \"107.631684\", \"ph\" : \"5\", \"co2\" : \"50\", \"turbidity\" : \"20\", \"suhu\" : \"29\", \"tds\" : \"155\"},{\"id\" : \"2\", \"lat\" : \"-6.972907\", \"lng\" : \"107.631673\", \"ph\" : \"5\", \"co2\" : \"100\", \"turbdity\" : \"19\", \"suhu\" : \"28\", \"tds\" : \"154\"},{\"id\" : \"3\", \"lat\" : \"-6.972955\", \"lng\" : \"107.631667\", \"ph\" : \"6\",\"turbidity\" : \"18\", \"suhu\" : \"27\", \"tds\" : \"153\"},{\"id\" : \"4\", \"lat\" : \"-6.973019\", \"lng\" : \"107.631670\", \"ph\" : \"6\", \"turbidity\" : \"17\", \"suhu\" : \"27\", \"tds\" : \"152\"},{\"id\" : \"5\", \"lat\" : \"-6.973101\", \"lng\" : \"107.631673\", \"ph\" : \"7\",\"turbidity\" : \"17\", \"suhu\" : \"26\", \"tds\": \"151\"}]', '2019-07-04 23:48:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabelfriska`
--
ALTER TABLE `tabelfriska`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabelfriska`
--
ALTER TABLE `tabelfriska`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
