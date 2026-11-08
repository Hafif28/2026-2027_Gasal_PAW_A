CREATE DATABASE IF NOT EXISTS toko_db;
USE toko_db;

-- Tabel Supplier
CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

-- Tabel Barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL
);

-- Tabel Pelanggan
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

-- Tabel User
CREATE TABLE user (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
);

-- Tabel Transaksi (Master)
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT DEFAULT 0,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL
);

-- Tabel Transaksi Detail (Detail)
CREATE TABLE transaksi_detail (
    transaksi_id INT,
    barang_id INT,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

-- Tabel Pembayaran
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE
);

-- INPUT DATA SAMPLE (Master minimal 5 data, Transaksi minimal 10 data)
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Makmur', '081234567890', 'Surabaya'),
('CV Maju Jaya', '081234567891', 'Malang'),
('UD Sejahtera', '081234567892', 'Sidoarjo'),
('PT Sentosa Abadi', '081234567893', 'Gresik'),
('CV Berkah Bersama', '081234567894', 'Mojokerto');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG01', 'Buku Tulis', 5000, 100, 1),
('BRG02', 'Pulpen Gel', 3000, 150, 1),
('BRG03', 'Pensil 2B', 2000, 200, 2),
('BRG04', 'Penggaris 30cm', 4000, 80, 3),
('BRG05', ' Penghapus', 1500, 120, 4);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG01', 'Ahmad', 'L', '08511111111', 'Jl. Merdeka 1'),
('PLG02', 'Budi', 'L', '08522222222', 'Jl. Pemuda 2'),
('PLG03', 'Siti', 'P', '08533333333', 'Jl. Mawar 3'),
('PLG04', 'Dewi', 'P', '08544444444', 'Jl. Melati 4'),
('PLG05', 'Eko', 'L', '08555555555', 'Jl. Anggrek 5');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin'), 'Administrator', 'Kantor Pusat', '0899999999', 1);

-- 10 Data Transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-11-01', 'Pembelian ATK 1', 0, 'PLG01'),
('2026-11-01', 'Pembelian ATK 2', 0, 'PLG02'),
('2026-11-02', 'Pembelian ATK 3', 0, 'PLG03'),
('2026-11-02', 'Pembelian ATK 4', 0, 'PLG04'),
('2026-11-03', 'Pembelian ATK 5', 0, 'PLG05'),
('2026-11-03', 'Pembelian ATK 6', 0, 'PLG01'),
('2026-11-04', 'Pembelian ATK 7', 0, 'PLG02'),
('2026-11-04', 'Pembelian ATK 8', 0, 'PLG03'),
('2026-11-05', 'Pembelian ATK 9', 0, 'PLG04'),
('2026-11-05', 'Pembelian ATK 10', 0, 'PLG05');