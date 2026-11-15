-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: penjualan
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `penjualan`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `penjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `penjualan`;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_barang` (`kode_barang`),
  KEY `fk_barang_supplier` (`supplier_id`),
  CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (1,'BRG001','Kopi Kapal Api 250g',12500,40,1),(2,'BRG002','Gula Pasir 1kg',15000,25,2),(3,'BRG003','Teh Sariwangi 25s',8500,30,3),(4,'BRG004','Air Mineral Aqua 600ml',3500,120,4),(5,'BRG005','Minyak Goreng Sania 1L',18500,18,5),(6,'BRG006','Beras Ramos 5kg',68000,12,6),(7,'BRG007','Mie Instan Indomie Goreng',3100,200,1),(8,'BRG008','Sabun Lifebuoy Batang',4500,60,2),(9,'BRG009','Susu Ultra 250ml',6000,45,3),(10,'BRG010','Telur Ayam 1kg',29000,20,5);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` VALUES ('PLG001','Andi Wijaya','L','081234000001','Jl. Ngagel Jaya No. 5, Surabaya'),('PLG002','Siti Aminah','P','081234000002','Jl. Pucang Anom No. 12, Surabaya'),('PLG003','Budi Santoso','L','081234000003','Jl. Raya Kenjeran No. 88, Surabaya'),('PLG004','Dewi Lestari','P','081234000004','Jl. Perak Timur No. 40, Surabaya'),('PLG005','Eko Prasetyo','L','081234000005','Jl. Raya Darmo No. 17, Surabaya'),('PLG006','Fitri Handayani','P','081234000006','Jl. Manyar Kertoarjo No. 6, Surabaya'),('PLG007','Gunawan Setiawan','L','081234000007','Jl. Wonokromo No. 33, Surabaya'),('PLG008','Hesti Rahayu','P','081234000008','Jl. Bratang Gede No. 2, Surabaya'),('PLG009','Irfan Maulana','L','081234000009','Jl. Kedungdoro No. 55, Surabaya'),('PLG010','Jihan Safira','P','081234000010','Jl. Gubeng Kertajaya No. 9, Surabaya');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL DEFAULT 'TUNAI',
  `transaksi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pembayaran_transaksi` (`transaksi_id`),
  CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES (1,'2026-10-01 10:15:00',35500,'TUNAI',1),(2,'2026-10-03 11:20:00',30500,'TRANSFER',2),(3,'2026-10-05 09:05:00',29000,'EDC',3),(4,'2026-10-08 14:30:00',97000,'TRANSFER',4),(5,'2026-10-12 16:45:00',39500,'TUNAI',5),(6,'2026-10-15 08:50:00',49000,'EDC',6),(7,'2026-10-19 13:10:00',42500,'TUNAI',7),(8,'2026-10-22 15:25:00',44500,'TRANSFER',8),(9,'2026-10-26 10:40:00',173000,'EDC',9),(10,'2026-10-30 17:15:00',80300,'TUNAI',10);
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'PT. Maju Bersama','081234567890','Jl. Rungkut Industri No. 12, Surabaya'),(2,'PT. Senang Sekali','081515563','Jl. Raya Bangkalan No. 45, Bangkalan'),(3,'PT. Segar Segar','0845454663','Jl. Diponegoro No. 88, Surabaya'),(4,'CV. Sumber Rejeki','081333444555','Jl. Ahmad Yani No. 21, Sidoarjo'),(5,'PT. Cahaya Abadi','082112223333','Jl. Basuki Rahmat No. 7, Surabaya'),(6,'UD. Berkah Jaya','085733334444','Jl. Trunojoyo No. 3, Bangkalan');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `pelanggan_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transaksi_pelanggan` (`pelanggan_id`),
  CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (1,'2026-10-01','Belanja harian',239500,'PLG001'),(2,'2026-10-03','Belanja kebutuhan dapur',30500,'PLG002'),(3,'2026-10-05','Pembelian minuman',29000,'PLG003'),(4,'2026-10-08','Belanja bulanan',97000,'PLG004'),(5,'2026-10-12','Belanja harian',39500,'PLG005'),(6,'2026-10-15','Belanja snack dan mie',49000,'PLG006'),(7,'2026-10-19','Belanja kebutuhan pokok',42500,'PLG007'),(8,'2026-10-22','Pembelian susu dan teh',44500,'PLG008'),(9,'2026-10-26','Belanja bulanan',173000,'PLG009'),(10,'2026-10-30','Belanja harian',80300,'PLG010');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`transaksi_id`,`barang_id`),
  KEY `fk_detail_barang` (`barang_id`),
  CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_detail`
--

LOCK TABLES `transaksi_detail` WRITE;
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
INSERT INTO `transaksi_detail` VALUES (1,1,12500,2),(1,4,3500,3),(1,6,68000,3),(2,2,15000,1),(2,7,3100,5),(3,3,8500,2),(3,9,6000,2),(4,6,68000,1),(4,10,29000,1),(5,4,3500,6),(5,5,18500,1),(6,7,3100,10),(6,8,4500,4),(7,1,12500,1),(7,2,15000,2),(8,3,8500,1),(8,9,6000,6),(9,5,18500,2),(9,6,68000,2),(10,4,3500,12),(10,7,3100,3),(10,10,29000,1);
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','0192023a7bbd73250516f069df18b500','Rizky Ahmad Nasrulloh','Jl. Rungkut Asri No. 8, Surabaya','081234567001',1),(2,'kasir1','de28f8f7998f23ab4194b51a6029416f','Andi Wijaya','Jl. Ngagel Jaya No. 5, Surabaya','081234567002',2),(3,'kasir2','de28f8f7998f23ab4194b51a6029416f','Siti Aminah','Jl. Pucang Anom No. 12, Surabaya','081234567003',2),(4,'kasir3','de28f8f7998f23ab4194b51a6029416f','Budi Santoso','Jl. Raya Kenjeran No. 88, Surabaya','081234567004',2),(5,'kasir4','de28f8f7998f23ab4194b51a6029416f','Dewi Lestari','Jl. Perak Timur No. 40, Surabaya','081234567005',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-15 21:19:07
