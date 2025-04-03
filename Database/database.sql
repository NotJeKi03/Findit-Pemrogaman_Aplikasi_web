CREATE DATABASE lost_found_db;

USE lost_found_db;

CREATE TABLE laporan_barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_laporan ENUM('Hilang', 'Ditemukan') NOT NULL,
    nama_barang VARCHAR(255) NOT NULL,
    nomor_penghubung VARCHAR(20) NOT NULL,
    lokasi_kejadian TEXT NOT NULL,
    deskripsi_barang TEXT NOT NULL,
    foto TEXT,  -- Bisa menyimpan URL atau path file gambar, dipisahkan dengan ';' jika lebih dari satu
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
