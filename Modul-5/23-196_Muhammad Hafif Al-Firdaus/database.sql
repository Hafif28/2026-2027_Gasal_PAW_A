-- Database penjualan (Module 5: Database)
CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

DROP TABLE IF EXISTS pembayaran;
DROP TABLE IF EXISTS transaksi_detail;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS user;

CREATE TABLE supplier (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  telp VARCHAR(12),
  alamat TEXT
);

CREATE TABLE barang (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10),
  nama_barang VARCHAR(100),
  harga INT(11),
  stok INT(11),
  supplier_id INT(11),
  FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE CASCADE
);

CREATE TABLE pelanggan (
  id VARCHAR(20) NOT NULL PRIMARY KEY,
  nama VARCHAR(100),
  jenis_kelamin ENUM('L','P'),
  telp VARCHAR(12),
  alamat TEXT
);

CREATE TABLE transaksi (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATE,
  keterangan TEXT,
  total INT(11),
  pelanggan_id VARCHAR(20),
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
  transaksi_id INT(11) NOT NULL,
  barang_id INT(11) NOT NULL,
  harga INT(11),
  qty INT(11),
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
  FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE
);

CREATE TABLE pembayaran (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar DATETIME,
  total INT(11),
  metode ENUM('TUNAI','TRANSFER','EDC'),
  transaksi_id INT(11),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE
);

CREATE TABLE user (
  id_user TINYINT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30),
  password VARCHAR(35),
  nama VARCHAR(50),
  alamat VARCHAR(150),
  hp VARCHAR(20),
  level TINYINT(1)
);

-- Data master
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama','08123456','Surabaya'),
('PT. Senang Sekali','081515563','Bangkalan'),
('PT. Segar Segar','0845454663','Surabaya'),
('PT. Sumber Rejeki','081234500004','Sidoarjo'),
('PT. Tani Makmur','081234500005','Malang'),
('PT. Abadi Jaya','081234500006','Gresik'),
('PT. Cahaya Baru','081234500007','Pamekasan'),
('PT. Mitra Sejati','081234500008','Sampang'),
('PT. Indah Pangan','081234500009','Jember'),
('PT. Berkah Sentosa','081234500010','Mojokerto');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001','Beras 5 kg',65000,100,1),
('BRG002','Minyak Goreng 2 L',32000,80,2),
('BRG003','Gula Pasir 1 kg',15000,120,3),
('BRG004','Telur Ayam 1 kg',28000,60,1),
('BRG005','Tepung Terigu 1 kg',12000,90,4),
('BRG006','Susu UHT 1 L',18000,70,5),
('BRG007','Kopi Bubuk 200 g',22000,50,6),
('BRG008','Teh Celup 25 pcs',9000,110,7),
('BRG009','Mie Instan',3500,200,8),
('BRG010','Sabun Mandi',4500,150,9);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001','Budi Santoso','L','081234567801','Surabaya'),
('PLG002','Siti Aminah','P','081234567802','Bangkalan'),
('PLG003','Ahmad Fauzi','L','081234567803','Sidoarjo'),
('PLG004','Dewi Lestari','P','081234567804','Malang'),
('PLG005','Rudi Hartono','L','081234567805','Gresik'),
('PLG006','Rina Wulandari','P','081234567806','Pamekasan'),
('PLG007','Joko Prasetyo','L','081234567807','Sampang'),
('PLG008','Lia Handayani','P','081234567808','Jember'),
('PLG009','Hasan Basri','L','081234567809','Mojokerto'),
('PLG010','Nur Aini','P','081234567810','Surabaya');

-- Data transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01','Pembelian beras',130000,'PLG001'),
('2026-10-02','Pembelian minyak goreng',32000,'PLG002'),
('2026-10-03','Pembelian gula',45000,'PLG003'),
('2026-10-04','Pembelian telur',56000,'PLG004'),
('2026-10-05','Pembelian tepung',60000,'PLG005'),
('2026-10-06','Pembelian susu',72000,'PLG006'),
('2026-10-07','Pembelian kopi',44000,'PLG007'),
('2026-10-08','Pembelian teh',54000,'PLG008'),
('2026-10-09','Pembelian mie instan',35000,'PLG009'),
('2026-10-10','Pembelian sabun',13500,'PLG010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,1,65000,2),(2,2,32000,1),(3,3,15000,3),(4,4,28000,2),(5,5,12000,5),
(6,6,18000,4),(7,7,22000,2),(8,8,9000,6),(9,9,3500,10),(10,10,4500,3);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00',130000,'TUNAI',1),
('2026-10-02 10:15:00',32000,'TRANSFER',2),
('2026-10-03 10:30:00',45000,'EDC',3),
('2026-10-04 11:00:00',56000,'TUNAI',4),
('2026-10-05 11:20:00',60000,'TRANSFER',5),
('2026-10-06 12:00:00',72000,'EDC',6),
('2026-10-07 12:30:00',44000,'TUNAI',7),
('2026-10-08 13:00:00',54000,'TRANSFER',8),
('2026-10-09 13:30:00',35000,'EDC',9),
('2026-10-10 14:00:00',13500,'TUNAI',10);

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin',MD5('admin123'),'Administrator','Surabaya','081200000001',1),
('kasir1',MD5('kasir123'),'Kasir Satu','Bangkalan','081200000002',2),
('kasir2',MD5('kasir123'),'Kasir Dua','Sidoarjo','081200000003',2),
('kasir3',MD5('kasir123'),'Kasir Tiga','Malang','081200000004',2),
('gudang1',MD5('gudang123'),'Staf Gudang Satu','Gresik','081200000005',3),
('gudang2',MD5('gudang123'),'Staf Gudang Dua','Pamekasan','081200000006',3),
('manager',MD5('manager123'),'Manajer Toko','Sampang','081200000007',1),
('sales1',MD5('sales123'),'Sales Satu','Jember','081200000008',2),
('sales2',MD5('sales123'),'Sales Dua','Mojokerto','081200000009',2),
('owner',MD5('owner123'),'Pemilik Toko','Surabaya','081200000010',1);
