/*
SQLyog Ultimate v8.4 
MySQL - 5.5.5-10.4.14-MariaDB : Database - chicken_hitz
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `bahan_baku` */

DROP TABLE IF EXISTS `bahan_baku`;

CREATE TABLE `bahan_baku` (
  `kd_bk` varchar(60) NOT NULL,
  `nm_bk` varchar(150) NOT NULL,
  `satuan` varchar(70) NOT NULL,
  `stok` float NOT NULL,
  `kd_suply` varchar(60) NOT NULL,
  PRIMARY KEY (`kd_bk`),
  KEY `FK_bahan_baku` (`kd_suply`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `bahan_baku` */

insert  into `bahan_baku`(`kd_bk`,`nm_bk`,`satuan`,`stok`,`kd_suply`) values ('BK-0001','Ayam Paha ','Potong',33,'SUPLY-001'),('BK-0002','Ayam Sayap','Potong',117,'SUPLY-001'),('BK-0003','Ayam Dada','Potong',53,'SUPLY-001'),('BK-0004','Mangga','Kg',4.98,'SUPLY-002'),('BK-0005','Cabe Rawit','Kg',15,'SUPLY-001'),('BK-0006','Tepung','Kg',37.3,'SUPLY-001'),('BK-0007','Lada','Kg',12.365,'SUPLY-001'),('BK-0008','Garam','Kg',6.946,'SUPLY-001'),('BK-0009','Bawang Putih','Kg',10.946,'SUPLY-001'),('BK-0010','Beras','Kg',47.3,'SUPLY-002'),('BK-0011','Kangkung','Kg',8,'SUPLY-001'),('BK-0012','Galon Aqua','Liter',14.3,'SUPLY-002'),('BK-0013','Jeruk','Kg',14.98,'SUPLY-002'),('BK-0014','Teh Bubuk','Kg',49.58,'SUPLY-002'),('BK-0015','Keju','Kg',17,'SUPLY-001'),('BK-0016','Gula Pasir','Kg',4.945,'SUPLY-002');

/*Table structure for table `det_paketcatering` */

DROP TABLE IF EXISTS `det_paketcatering`;

CREATE TABLE `det_paketcatering` (
  `kd_detpaketcat` int(11) NOT NULL AUTO_INCREMENT,
  `kd_paketcatering` varchar(60) NOT NULL,
  `kd_menu` varchar(60) NOT NULL,
  PRIMARY KEY (`kd_detpaketcat`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `det_paketcatering` */

insert  into `det_paketcatering`(`kd_detpaketcat`,`kd_paketcatering`,`kd_menu`) values (1,'PAKCAT-0001','MENU-0001'),(2,'PAKCAT-0001','MENU-0002'),(3,'PAKCAT-0001','MENU-0003'),(4,'PAKCAT-0002','MENU-0004'),(5,'PAKCAT-0002','MENU-0005'),(6,'PAKCAT-0002','MENU-0006'),(7,'PAKCAT-0003','MENU-0007'),(8,'PAKCAT-0003','MENU-0008'),(9,'PAKCAT-0003','MENU-0009'),(10,'PAKCAT-0004','MENU-0001'),(11,'PAKCAT-0004','MENU-0010');

/*Table structure for table `det_pengambilan` */

DROP TABLE IF EXISTS `det_pengambilan`;

CREATE TABLE `det_pengambilan` (
  `kd_detpengambilan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pengambilan` varchar(60) NOT NULL,
  `kd_bk` varchar(60) NOT NULL,
  `satuan` varchar(70) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`kd_detpengambilan`),
  KEY `FK_det_pengambilan` (`kd_pengambilan`),
  KEY `FK_det_pengambilan1` (`kd_bk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `det_pengambilan` */

/*Table structure for table `det_penjualan` */

DROP TABLE IF EXISTS `det_penjualan`;

CREATE TABLE `det_penjualan` (
  `kd_detjual` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(60) NOT NULL,
  `kd_menu` varchar(60) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`kd_detjual`),
  KEY `FK_det_penjualan` (`kd_penjualan`),
  KEY `FK_det_penjualan1` (`kd_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `det_penjualan` */

insert  into `det_penjualan`(`kd_detjual`,`kd_penjualan`,`kd_menu`,`jumlah`,`harga`) values (1,'JL-0000124012021150750','MENU-0002',1,16000),(2,'JL-0000124012021150750','MENU-0003',1,13500),(6,'JL-0000224012021152329','MENU-0002',1,16000),(7,'JL-0000224012021152403','MENU-0007',1,19000),(8,'JL-0000324012021152557','MENU-0001',40,15000),(9,'JL-0000324012021152557','MENU-0002',40,16000),(10,'JL-0000324012021152557','MENU-0003',40,13500),(11,'JL-0000424012021152720','MENU-0004',40,18000),(12,'JL-0000424012021152720','MENU-0005',40,19000),(13,'JL-0000424012021152720','MENU-0006',40,16000),(14,'JL-0000524012021154116','MENU-0001',100,15000),(15,'JL-0000524012021154116','MENU-0002',100,16000),(16,'JL-0000524012021154116','MENU-0003',100,13500);

/*Table structure for table `det_resep` */

DROP TABLE IF EXISTS `det_resep`;

CREATE TABLE `det_resep` (
  `kd_detresep` int(11) NOT NULL AUTO_INCREMENT,
  `kd_resep` varchar(60) NOT NULL,
  `kd_bk` varchar(60) NOT NULL,
  `takaran` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_detresep`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

/*Data for the table `det_resep` */

insert  into `det_resep`(`kd_detresep`,`kd_resep`,`kd_bk`,`takaran`,`satuan`) values (1,'RSP-0001','BK-0003',1,'Potong'),(2,'RSP-0001','BK-0006',100,'Gram'),(3,'RSP-0001','BK-0007',5,'Gram'),(4,'RSP-0001','BK-0008',2,'Gram'),(5,'RSP-0001','BK-0009',2,'Gram'),(6,'RSP-0001','BK-0010',100,'Gram'),(8,'RSP-0002','BK-0006',100,'Gram'),(9,'RSP-0002','BK-0007',5,'Gram'),(10,'RSP-0002','BK-0008',2,'Gram'),(11,'RSP-0002','BK-0009',2,'Gram'),(12,'RSP-0002','BK-0001',1,'Potong'),(13,'RSP-0002','BK-0010',100,'Gram'),(15,'RSP-0003','BK-0002',1,'Potong'),(16,'RSP-0003','BK-0006',100,'Gram'),(17,'RSP-0003','BK-0007',5,'Gram'),(18,'RSP-0003','BK-0008',2,'Gram'),(19,'RSP-0003','BK-0009',2,'Gram'),(20,'RSP-0003','BK-0010',100,'Gram'),(22,'RSP-0004','BK-0003',1,'Potong'),(23,'RSP-0004','BK-0006',100,'Gram'),(24,'RSP-0004','BK-0007',5,'Gram'),(25,'RSP-0004','BK-0008',2,'Gram'),(26,'RSP-0004','BK-0009',2,'Gram'),(27,'RSP-0004','BK-0010',100,'Gram'),(29,'RSP-0005','BK-0001',1,'Potong'),(30,'RSP-0005','BK-0006',100,'Gram'),(31,'RSP-0005','BK-0007',5,'Gram'),(32,'RSP-0005','BK-0008',2,'Gram'),(33,'RSP-0005','BK-0009',2,'Gram'),(34,'RSP-0005','BK-0010',100,'Gram'),(36,'RSP-0006','BK-0002',1,'Potong'),(37,'RSP-0006','BK-0006',100,'Gram'),(38,'RSP-0006','BK-0007',5,'Gram'),(39,'RSP-0006','BK-0008',2,'Gram'),(40,'RSP-0006','BK-0009',2,'Gram'),(41,'RSP-0006','BK-0015',20,'Gram'),(42,'RSP-0006','BK-0010',100,'Gram'),(43,'RSP-0007','BK-0003',1,'Potong'),(44,'RSP-0007','BK-0006',100,'Gram'),(45,'RSP-0007','BK-0009',2,'Gram'),(46,'RSP-0007','BK-0007',5,'Gram'),(47,'RSP-0007','BK-0008',2,'Gram'),(48,'RSP-0007','BK-0004',20,'Gram'),(49,'RSP-0007','BK-0010',100,'Gram'),(50,'RSP-0008','BK-0001',1,'Potong'),(51,'RSP-0008','BK-0006',100,'Gram'),(52,'RSP-0008','BK-0007',5,'Gram'),(53,'RSP-0008','BK-0008',2,'Gram'),(54,'RSP-0008','BK-0009',2,'Gram'),(55,'RSP-0008','BK-0004',20,'Gram'),(56,'RSP-0008','BK-0010',100,'Gram'),(57,'RSP-0009','BK-0002',1,'Potong'),(58,'RSP-0009','BK-0006',100,'Gram'),(59,'RSP-0009','BK-0007',5,'Gram'),(60,'RSP-0009','BK-0008',2,'Gram'),(61,'RSP-0009','BK-0009',2,'Gram'),(62,'RSP-0009','BK-0004',20,'Gram'),(63,'RSP-0009','BK-0010',100,'Gram'),(64,'RSP-0010','BK-0013',20,'Gram'),(65,'RSP-0010','BK-0012',350,'ml'),(66,'RSP-0010','BK-0016',30,'Gram'),(67,'RSP-0011','BK-0014',20,'Gram'),(68,'RSP-0011','BK-0016',25,'Gram'),(69,'RSP-0011','BK-0012',350,'ml');

/*Table structure for table `kabupaten` */

DROP TABLE IF EXISTS `kabupaten`;

CREATE TABLE `kabupaten` (
  `kd_tarif` varchar(60) NOT NULL,
  `nm_kabupaten` varchar(150) NOT NULL,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`kd_tarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kabupaten` */

insert  into `kabupaten`(`kd_tarif`,`nm_kabupaten`,`tarif`) values ('ONGKIR-0001','Sleman',10000),('ONGKIR-0002','Bantul',15000);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(60) NOT NULL,
  `nm_karyawan` varchar(150) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`nm_karyawan`,`jk`,`email`,`jabatan`,`no_hp`,`alamat`) values ('KAR-05','Hanaffy RusAin','Laki-Laki','hanaffyrusain@gmail.com','Admin','085252337275','Jl. Magelang KM 5,5 Sleman Yogyakarta'),('KAR-06','Hanaffy','Laki-Laki','hanaffy@gmail.com','Owner','085252337070','Jl. Sungai Kuyang, Berau, Kalimantan Timur');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kd_ktgr` varchar(60) NOT NULL,
  `nm_ktgr` varchar(75) NOT NULL,
  PRIMARY KEY (`kd_ktgr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`kd_ktgr`,`nm_ktgr`) values ('KTGR-01','Makanan'),('KTGR-02','Minuman');

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `kd_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_tarif` varchar(60) NOT NULL,
  `nm_kecamatan` varchar(160) NOT NULL,
  PRIMARY KEY (`kd_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kecamatan` */

insert  into `kecamatan`(`kd_kecamatan`,`kd_tarif`,`nm_kecamatan`) values (1,'ONGKIR-0001','Mlati'),(2,'ONGKIR-0001','Depok'),(4,'ONGKIR-0001','Ngaglik'),(6,'ONGKIR-0001','Ngemplak'),(7,'ONGKIR-0001','Jetis'),(8,'ONGKIR-0002','Banguntapan'),(9,'ONGKIR-0002','Piyungan');

/*Table structure for table `kelurahan` */

DROP TABLE IF EXISTS `kelurahan`;

CREATE TABLE `kelurahan` (
  `kd_kelurahan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kecamatan` int(11) NOT NULL,
  `nm_kelurahan` varchar(160) NOT NULL,
  PRIMARY KEY (`kd_kelurahan`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kelurahan` */

insert  into `kelurahan`(`kd_kelurahan`,`kd_kecamatan`,`nm_kelurahan`) values (1,1,'Sengdadi'),(2,1,'Sinduadi'),(3,2,'Caturtunggal'),(4,2,'Condongcatur'),(5,9,'Srimulyo'),(6,9,'Sitimulyo'),(7,8,'Baturetno'),(8,8,'Jagalan'),(9,7,'Canden'),(10,7,'Patalan'),(11,6,'Bimomartani'),(12,6,'Sindumartani'),(13,4,'Donoharjo'),(14,4,'Sariharjo');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `kd_menu` varchar(60) NOT NULL,
  `kd_ktgr` varchar(60) NOT NULL,
  `nama_menu` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_menu`),
  KEY `FK_menu` (`kd_ktgr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu` */

insert  into `menu`(`kd_menu`,`kd_ktgr`,`nama_menu`,`harga`,`deskripsi`,`gambar`,`status`) values ('MENU-0001','KTGR-01','Ayam Geprek Paha Original',15000,'Ayam Paha Geprek Original ','01012021213951ayam paha.jpg','Tersedia'),('MENU-0002','KTGR-01','Ayam Geprek Dada Original',16000,'Ayam Geprek Dada Original ','01012021214054ayam dada.jpg','Tersedia'),('MENU-0003','KTGR-01','Ayam Geprek Sayap Original',13500,'Ayam Geprek Sayap Original','01012021214133ayam sayap.jpg','Tersedia'),('MENU-0004','KTGR-01','Ayam Dada Geprek Keju ',18000,'Ayam Dada Geprek Keju ','01012021214230ayam dada.jpg','Tersedia'),('MENU-0005','KTGR-01','Ayam Paha Geprek Keju ',19000,'Ayam Paha Geprek Keju ','01012021214305ayampaha.jpg','Tersedia'),('MENU-0006','KTGR-01','Ayam Sayap Geprek Keju ',16000,'Ayam Sayap Geprek Keju ','01012021214400ayam sayap.jpg','Tersedia'),('MENU-0007','KTGR-01','Ayam Dada Saos Mangga',19000,'Ayam Dada Saos Mangga','01012021214440dada.jpg','Tersedia'),('MENU-0008','KTGR-01','Ayam Paha Saos Mangga',17500,'Ayam Paha Saos Mangga','01012021214513paha.jpg','Tersedia'),('MENU-0009','KTGR-01','Ayam Sayap Saos Mangga',19000,'Ayam Sayap Saos Mangga','01012021214550sayap.jpg','Tersedia'),('MENU-0010','KTGR-02','Es Teh',4000,'Es Teh','0101202121463824122020130635esteh.jpg','Tersedia'),('MENU-0011','KTGR-02','Es Jeruk',5000,'Es Jeruk','0101202121471724122020210255esjeruk.jpg','Tersedia');

/*Table structure for table `paket_catering` */

DROP TABLE IF EXISTS `paket_catering`;

CREATE TABLE `paket_catering` (
  `kd_paketcatering` varchar(60) NOT NULL,
  `nm_paketcatering` varchar(150) NOT NULL,
  `gambar` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_paketcatering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `paket_catering` */

insert  into `paket_catering`(`kd_paketcatering`,`nm_paketcatering`,`gambar`,`status`) values ('PAKCAT-0001','Paket Geprek Original','01012021214817ayam dada.jpg','Tersedia'),('PAKCAT-0002','Paket Geprek Keju','01012021214941ayampaha.jpg','Tersedia'),('PAKCAT-0003','Paket Ayam Saos Mangga','01012021215111paha.jpg','Tersedia'),('PAKCAT-0004','Paket Ayam Geprek Esteh','0301202116264529122020014553paket2.jpg','Tersedia');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(60) NOT NULL,
  `nm_plg` varchar(120) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nm_plg`,`jk`,`alamat`,`no_hp`) values ('PLG-00004','Diki Setiawan','Laki-Laki','Gamping, Sleman, Yogyakarta','081279080979'),('PLG-00005','Hanafi','Laki-Laki','Jl. Monjali KM 5,7 Sleman, Yogyakarta','085252337777');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `kd_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(60) NOT NULL,
  `tipe_bayar` varchar(50) NOT NULL,
  `status_bayar` varchar(100) NOT NULL,
  `gambar_resi` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`kd_bayar`),
  KEY `FK_pembayaran` (`kd_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`kd_bayar`,`kd_penjualan`,`tipe_bayar`,`status_bayar`,`gambar_resi`) values (1,'JL-0000124012021150750','Transfer','Telah Melakukan Transfer','240120211515025619C909-51B8-4413-A2EF-48814BA517CD.JPG'),(2,'JL-0000224012021151400','Bayar Ditempat','Bayar Ditempat','-'),(3,'JL-0000224012021151852','Bayar Ditempat','Bayar Ditempat','-'),(4,'JL-0000224012021152329','Bayar Ditempat','Bayar Ditempat','-'),(5,'JL-0000224012021152403','Bayar Ditempat','Bayar Ditempat','-'),(6,'JL-0000324012021152557','Transfer','DP','24012021152948resi.JPG'),(7,'JL-0000424012021152720','Transfer','Belum Melakukan Transfer',NULL),(8,'JL-0000524012021154116','Transfer','Lunas','240120211542585619C909-51B8-4413-A2EF-48814BA517CD.JPG');

/*Table structure for table `pengadaan` */

DROP TABLE IF EXISTS `pengadaan`;

CREATE TABLE `pengadaan` (
  `kd_pengadaan` varchar(60) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `kd_suply` varchar(60) NOT NULL,
  `id_karyawan` varchar(60) NOT NULL,
  `kd_bk` varchar(60) NOT NULL,
  `satuan` varchar(70) NOT NULL,
  `jumlah` float NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`kd_pengadaan`),
  KEY `FK_pegadaan` (`kd_suply`),
  KEY `FK_pegadaan1` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengadaan` */

insert  into `pengadaan`(`kd_pengadaan`,`tgl_pengadaan`,`kd_suply`,`id_karyawan`,`kd_bk`,`satuan`,`jumlah`,`harga`) values ('PENGADAAN-0001','2021-01-01','SUPLY-001','KAR-02','BK-0001','Potong',50,3000),('PENGADAAN-0002','2021-01-01','SUPLY-001','KAR-02','BK-0002','Potong',50,3000),('PENGADAAN-0003','2021-01-01','SUPLY-001','KAR-02','BK-0003','Potong',50,3000),('PENGADAAN-0004','2021-01-01','SUPLY-002','KAR-02','BK-0004','Kg',5,10000),('PENGADAAN-0005','2021-01-01','SUPLY-001','KAR-02','BK-0005','Kg',5,20000),('PENGADAAN-0006','2021-01-01','SUPLY-001','KAR-02','BK-0006','Kg',10,8000),('PENGADAAN-0007','2021-01-01','SUPLY-001','KAR-02','BK-0007','Kg',5,8000),('PENGADAAN-0008','2021-01-01','SUPLY-001','KAR-02','BK-0008','Kg',3,7500),('PENGADAAN-0009','2021-01-01','SUPLY-001','KAR-02','BK-0009','Kg',5,13000),('PENGADAAN-0010','2021-01-01','SUPLY-002','KAR-02','BK-0010','Kg',20,11000),('PENGADAAN-0011','2021-01-01','SUPLY-001','KAR-02','BK-0011','Kg',3,3000),('PENGADAAN-0012','2021-01-01','SUPLY-002','KAR-02','BK-0012','Liter',57,1000),('PENGADAAN-0013','2021-01-01','SUPLY-002','KAR-02','BK-0013','Kg',5,14000),('PENGADAAN-0014','2021-01-01','SUPLY-002','KAR-02','BK-0014','Kg',2,3000),('PENGADAAN-0015','2021-01-01','SUPLY-001','KAR-02','BK-0015','Kg',5,20000),('PENGADAAN-0016','2021-01-01','SUPLY-002','KAR-02','BK-0016','Kg',8,13000),('PENGADAAN-0017','2021-01-05','SUPLY-001','KAR-05','BK-0008','Kg',5,4000),('PENGADAAN-0018','2021-01-05','SUPLY-001','KAR-05','BK-0003','Potong',50,15000),('PENGADAAN-0019','2021-01-05','SUPLY-001','KAR-05','BK-0001','Potong',50,15000),('PENGADAAN-0020','2021-01-05','SUPLY-001','KAR-05','BK-0002','Potong',80,15000),('PENGADAAN-0021','2021-01-05','SUPLY-001','KAR-05','BK-0006','Kg',10,11000),('PENGADAAN-0022','2021-01-05','SUPLY-001','KAR-05','BK-0006','Kg',5,11000),('PENGADAAN-0023','2021-01-05','SUPLY-002','KAR-05','BK-0010','Kg',5,11000),('PENGADAAN-0024','2021-01-05','SUPLY-002','KAR-05','BK-0010','Kg',5,11000),('PENGADAAN-0025','2021-01-05','SUPLY-001','KAR-05','BK-0001','Potong',50,3000),('PENGADAAN-0026','2021-01-05','SUPLY-001','KAR-05','BK-0006','Kg',10,11000),('PENGADAAN-0027','2021-01-05','SUPLY-001','KAR-05','BK-0003','Potong',50,3000),('PENGADAAN-0028','2021-01-05','SUPLY-001','KAR-05','BK-0001','Potong',100,3000),('PENGADAAN-0029','2021-01-05','SUPLY-001','KAR-05','BK-0002','Potong',100,3000),('PENGADAAN-0030','2021-01-05','SUPLY-002','KAR-05','BK-0010','Kg',70,14000),('PENGADAAN-0031','2021-01-05','SUPLY-002','KAR-05','BK-0014','Kg',50,13000),('PENGADAAN-0032','2021-01-05','SUPLY-001','KAR-05','BK-0009','Kg',7,18000),('PENGADAAN-0033','2021-01-05','SUPLY-001','KAR-05','BK-0005','Kg',10,30000),('PENGADAAN-0034','2021-01-05','SUPLY-002','KAR-05','BK-0013','Kg',10,12000),('PENGADAAN-0035','2021-01-05','SUPLY-001','KAR-05','BK-0011','Kg',5,10000),('PENGADAAN-0036','2021-01-05','SUPLY-001','KAR-05','BK-0015','Kg',12,40000),('PENGADAAN-0037','2021-01-05','SUPLY-001','KAR-05','BK-0007','Kg',10,50000),('PENGADAAN-0038','2021-01-05','SUPLY-001','KAR-05','BK-0006','Kg',15,10000),('PENGADAAN-0039','2021-01-05','SUPLY-001','KAR-05','BK-0002','Potong',100,4000),('PENGADAAN-0040','2021-01-08','SUPLY-002','KAR-05','BK-0017','Kg',5,28000),('PENGADAAN-0041','2021-01-24','SUPLY-001','KAR-05','BK-0006','Kg',40,11000);

/*Table structure for table `pengambilan` */

DROP TABLE IF EXISTS `pengambilan`;

CREATE TABLE `pengambilan` (
  `kd_pengambilan` varchar(60) NOT NULL,
  `tgl_pengambilan` datetime NOT NULL,
  `id_karyawan` varchar(60) NOT NULL,
  PRIMARY KEY (`kd_pengambilan`),
  KEY `FK_pengambilan1` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengambilan` */

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `kd_penjualan` varchar(60) NOT NULL,
  `tgl_jual` datetime NOT NULL,
  `tgl_kirim` datetime DEFAULT NULL,
  `id_pelanggan` varchar(60) NOT NULL,
  `tipe_jual` varchar(80) NOT NULL,
  `tipe_ambil` varchar(70) NOT NULL,
  `kd_tarif` varchar(60) DEFAULT NULL,
  `kd_kecamatan` int(11) DEFAULT NULL,
  `kd_kelurahan` int(11) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  `alamat_kirim` text NOT NULL,
  `status` varchar(75) NOT NULL,
  PRIMARY KEY (`kd_penjualan`),
  KEY `FK_penjualan2` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `penjualan` */

insert  into `penjualan`(`kd_penjualan`,`tgl_jual`,`tgl_kirim`,`id_pelanggan`,`tipe_jual`,`tipe_ambil`,`kd_tarif`,`kd_kecamatan`,`kd_kelurahan`,`tarif`,`alamat_kirim`,`status`) values ('JL-0000124012021150750','2021-01-24 15:14:00','2021-01-24 15:16:57','PLG-00005','Biasa','Dikirim','ONGKIR-0001',2,3,10000,'Karangjati, caturtunggal, depok, sleman','Dikirim'),('JL-0000224012021152403','2021-01-24 15:25:57','2021-01-24 15:26:18','PLG-00005','Biasa','Dikirim','ONGKIR-0001',6,11,10000,'kost putra empoe,  sleman, yogyakarta','Dikirim'),('JL-0000324012021152557','2021-01-24 15:27:19','2021-01-28 15:26:00','PLG-00005','Catering','Dikirim','ONGKIR-0001',2,3,10000,'kost putra mlati, sleman, yogyakarta','Telah Dikirim'),('JL-0000424012021152720','2021-01-24 15:41:16','2021-01-28 15:41:00','PLG-00005','Catering','Di Toko','-',0,0,0,'-','Sedang Dikonfirmasi'),('JL-0000524012021154116','2021-01-24 15:42:32','2021-01-28 15:42:00','PLG-00005','Catering','Di Toko','-',0,0,0,'-','Sedang Dikonfirmasi');

/*Table structure for table `resep` */

DROP TABLE IF EXISTS `resep`;

CREATE TABLE `resep` (
  `kd_resep` varchar(60) NOT NULL,
  `kd_menu` varchar(60) NOT NULL,
  PRIMARY KEY (`kd_resep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `resep` */

insert  into `resep`(`kd_resep`,`kd_menu`) values ('RSP-0001','MENU-0002'),('RSP-0002','MENU-0001'),('RSP-0003','MENU-0003'),('RSP-0004','MENU-0004'),('RSP-0005','MENU-0005'),('RSP-0006','MENU-0006'),('RSP-0007','MENU-0007'),('RSP-0008','MENU-0008'),('RSP-0009','MENU-0009'),('RSP-0010','MENU-0011'),('RSP-0011','MENU-0010');

/*Table structure for table `suplier` */

DROP TABLE IF EXISTS `suplier`;

CREATE TABLE `suplier` (
  `kd_suply` varchar(60) NOT NULL,
  `nm_suply` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`kd_suply`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `suplier` */

insert  into `suplier`(`kd_suply`,`nm_suply`,`email`,`no_hp`,`alamat`) values ('SUPLY-001','Indogrosir','indogrosir@gmail.com','081256990812','Jl. Magelang KM.6 No.lt.1, Kutu Patran, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55288'),('SUPLY-002','Mirota Kampus','customercare@mirotakampus.com','08120890909','Jalan C Simanjuntak No. 70, Terban, Gondokusuman, Terban, Gondokusuman, Kota Yogyakarta, Daerah Isti');

/*Table structure for table `tmp_detpengambilan` */

DROP TABLE IF EXISTS `tmp_detpengambilan`;

CREATE TABLE `tmp_detpengambilan` (
  `kd_detpengambilan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pengambilan` varchar(60) NOT NULL,
  `kd_bk` varchar(60) NOT NULL,
  `satuan` varchar(70) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`kd_detpengambilan`),
  KEY `FK_det_pengambilan` (`kd_pengambilan`),
  KEY `FK_det_pengambilan1` (`kd_bk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tmp_detpengambilan` */

/*Table structure for table `tmp_detpenjualan` */

DROP TABLE IF EXISTS `tmp_detpenjualan`;

CREATE TABLE `tmp_detpenjualan` (
  `kd_detjual` int(11) NOT NULL AUTO_INCREMENT,
  `kd_penjualan` varchar(60) NOT NULL,
  `kd_menu` varchar(60) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`kd_detjual`),
  KEY `FK_det_penjualan` (`kd_penjualan`),
  KEY `FK_det_penjualan1` (`kd_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tmp_detpenjualan` */

insert  into `tmp_detpenjualan`(`kd_detjual`,`kd_penjualan`,`kd_menu`,`jumlah`,`harga`) values (1,'JL-0000124012021150750','MENU-0002',100,16000),(2,'JL-0000124012021150750','MENU-0003',100,13500),(5,'JL-0000224012021152329','MENU-0002',100,16000),(6,'JL-0000224012021152403','MENU-0007',1,19000),(7,'JL-0000324012021152557','MENU-0001',100,15000),(8,'JL-0000324012021152557','MENU-0002',100,16000),(9,'JL-0000324012021152557','MENU-0003',100,13500),(10,'JL-0000424012021152720','MENU-0004',40,18000),(11,'JL-0000424012021152720','MENU-0005',40,19000),(12,'JL-0000424012021152720','MENU-0006',40,16000),(13,'JL-0000524012021154116','MENU-0001',100,15000),(14,'JL-0000524012021154116','MENU-0002',100,16000),(15,'JL-0000524012021154116','MENU-0003',100,13500);

/*Table structure for table `tmpdet_paketcatering` */

DROP TABLE IF EXISTS `tmpdet_paketcatering`;

CREATE TABLE `tmpdet_paketcatering` (
  `kd_detpaketcat` int(11) NOT NULL AUTO_INCREMENT,
  `kd_paketcatering` varchar(60) NOT NULL,
  `kd_menu` varchar(60) NOT NULL,
  PRIMARY KEY (`kd_detpaketcat`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tmpdet_paketcatering` */

insert  into `tmpdet_paketcatering`(`kd_detpaketcat`,`kd_paketcatering`,`kd_menu`) values (1,'PAKCAT-0001','MENU-0001'),(2,'PAKCAT-0001','MENU-0002'),(3,'PAKCAT-0001','MENU-0003'),(4,'PAKCAT-0002','MENU-0004'),(5,'PAKCAT-0002','MENU-0005'),(6,'PAKCAT-0002','MENU-0006'),(7,'PAKCAT-0003','MENU-0007'),(8,'PAKCAT-0003','MENU-0008'),(9,'PAKCAT-0003','MENU-0009'),(10,'PAKCAT-0004','MENU-0001'),(11,'PAKCAT-0004','MENU-0010');

/*Table structure for table `tmpdet_resep` */

DROP TABLE IF EXISTS `tmpdet_resep`;

CREATE TABLE `tmpdet_resep` (
  `tmpkd_detresep` int(11) NOT NULL AUTO_INCREMENT,
  `kd_resep` varchar(60) NOT NULL,
  `kd_bk` varchar(60) NOT NULL,
  `takaran` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  PRIMARY KEY (`tmpkd_detresep`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tmpdet_resep` */

insert  into `tmpdet_resep`(`tmpkd_detresep`,`kd_resep`,`kd_bk`,`takaran`,`satuan`) values (1,'RSP-0001','BK-0003',1,'Potong'),(2,'RSP-0001','BK-0006',100,'Gram'),(3,'RSP-0001','BK-0007',5,'Gram'),(4,'RSP-0001','BK-0008',2,'Gram'),(5,'RSP-0001','BK-0009',2,'Gram'),(6,'RSP-0001','BK-0010',100,'Gram'),(7,'RSP-0002','BK-0006',100,'Gram'),(8,'RSP-0002','BK-0007',5,'Gram'),(9,'RSP-0002','BK-0008',2,'Gram'),(10,'RSP-0002','BK-0009',2,'Gram'),(11,'RSP-0002','BK-0001',1,'Potong'),(12,'RSP-0002','BK-0010',100,'Gram'),(13,'RSP-0003','BK-0002',1,'Potong'),(14,'RSP-0003','BK-0006',100,'Gram'),(15,'RSP-0003','BK-0007',5,'Gram'),(16,'RSP-0003','BK-0008',2,'Gram'),(17,'RSP-0003','BK-0009',2,'Gram'),(18,'RSP-0003','BK-0010',100,'Gram'),(19,'RSP-0004','BK-0003',1,'Potong'),(20,'RSP-0004','BK-0006',100,'Gram'),(21,'RSP-0004','BK-0007',5,'Gram'),(22,'RSP-0004','BK-0008',2,'Gram'),(23,'RSP-0004','BK-0009',2,'Gram'),(24,'RSP-0004','BK-0010',100,'Gram'),(25,'RSP-0005','BK-0001',1,'Potong'),(26,'RSP-0005','BK-0006',100,'Gram'),(27,'RSP-0005','BK-0007',5,'Gram'),(28,'RSP-0005','BK-0008',2,'Gram'),(29,'RSP-0005','BK-0009',2,'Gram'),(30,'RSP-0005','BK-0010',100,'Gram'),(31,'RSP-0006','BK-0002',1,'Potong'),(32,'RSP-0006','BK-0006',100,'Gram'),(33,'RSP-0006','BK-0007',5,'Gram'),(34,'RSP-0006','BK-0008',2,'Gram'),(35,'RSP-0006','BK-0009',2,'Gram'),(36,'RSP-0006','BK-0015',20,'Gram'),(37,'RSP-0006','BK-0010',100,'Gram'),(38,'RSP-0007','BK-0003',1,'Potong'),(39,'RSP-0007','BK-0006',100,'Gram'),(40,'RSP-0007','BK-0009',2,'Gram'),(41,'RSP-0007','BK-0007',5,'Gram'),(42,'RSP-0007','BK-0008',2,'Gram'),(43,'RSP-0007','BK-0004',20,'Gram'),(44,'RSP-0007','BK-0010',100,'Gram'),(45,'RSP-0008','BK-0001',1,'Potong'),(46,'RSP-0008','BK-0006',100,'Gram'),(47,'RSP-0008','BK-0007',5,'Gram'),(48,'RSP-0008','BK-0008',2,'Gram'),(49,'RSP-0008','BK-0009',2,'Gram'),(50,'RSP-0008','BK-0004',20,'Gram'),(51,'RSP-0008','BK-0010',100,'Gram'),(52,'RSP-0009','BK-0002',1,'Potong'),(53,'RSP-0009','BK-0006',100,'Gram'),(54,'RSP-0009','BK-0007',5,'Gram'),(55,'RSP-0009','BK-0008',2,'Gram'),(56,'RSP-0009','BK-0009',2,'Gram'),(57,'RSP-0009','BK-0004',20,'Gram'),(58,'RSP-0009','BK-0010',100,'Gram'),(59,'RSP-0010','BK-0013',20,'Gram'),(60,'RSP-0010','BK-0012',350,'ml'),(61,'RSP-0010','BK-0016',30,'Gram'),(62,'RSP-0011','BK-0014',20,'Gram'),(63,'RSP-0011','BK-0016',25,'Gram'),(64,'RSP-0011','BK-0012',350,'ml');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` varchar(60) NOT NULL,
  `emails` varchar(100) NOT NULL,
  `passwords` varchar(500) NOT NULL,
  `levels` varchar(50) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`no`,`id_users`,`emails`,`passwords`,`levels`) values (9,'KAR-05','hanaffyrusain@gmail.com','$2y$10$CfjVL4IMTWuvF6hcNeNa7O25nF9Bv2ZBfCHq1lHvnXlM9He9aqVpm','Admin'),(10,'KAR-06','hanaffy@gmail.com','$2y$10$Yw5cYmQ1ghbsqqV6imwHPe6G0Ke9H9DMXr1dvSuUcKAmKmdmQ49.G','Owner'),(11,'PLG-00005','hanafi@gmail.com','$2y$10$ELSyS/dTSBJ13pug.iMgEeJ6aRvNMZ0.hWfv.UzlaGdSER6Jj2Ibi','Pelanggan');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
