-- ============================================================
-- DATABASE: db_deteksi_diabetes
-- Berdasarkan ERD (Notasi Chen):
--   Entitas PENGGUNA  --1:M-->  Entitas RIWAYAT_DETEKSI
--   Relasi: MELAKUKAN
-- Siap diimpor melalui phpMyAdmin (tab Import)
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_deteksi_diabetes
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE db_deteksi_diabetes;

-- ------------------------------------------------------------
-- Tabel: pengguna
-- ------------------------------------------------------------
DROP TABLE IF EXISTS riwayat_deteksi;
DROP TABLE IF EXISTS pengguna;

CREATE TABLE pengguna (
    id_pengguna INT AUTO_INCREMENT PRIMARY KEY,
    nama        VARCHAR(100) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabel: riwayat_deteksi
-- Menyimpan atribut input model Random Forest + hasil prediksi
-- ------------------------------------------------------------
CREATE TABLE riwayat_deteksi (
    id_deteksi        INT AUTO_INCREMENT PRIMARY KEY,
    id_pengguna       INT NOT NULL,

    -- Atribut biner (0 = Tidak, 1 = Ya)
    HighBP            TINYINT(1) NOT NULL,
    Smoker            TINYINT(1) NOT NULL,
    Sex               TINYINT(1) NOT NULL,
    Fruits            TINYINT(1) NOT NULL,
    Veggies           TINYINT(1) NOT NULL,

    -- Atribut numerik / kategorikal
    BMI               DECIMAL(5,2) NOT NULL,
    BMI_Category      VARCHAR(30)  NOT NULL,      -- contoh: Underweight, Normal, Overweight, Obese
    Age               INT NOT NULL,
    Income            INT NOT NULL,
    Education         INT NOT NULL,
    GenHlth           INT NOT NULL,
    MentHlth          INT NOT NULL,
    PhysHlth          INT NOT NULL,
    BMI_PhysActivity  DECIMAL(6,2) NOT NULL,       -- fitur turunan (interaksi BMI & aktivitas fisik)
    RiskFactorCount   INT NOT NULL,

    -- Hasil & metadata
    hasil_prediksi    VARCHAR(30) NOT NULL,        -- contoh: Risiko Rendah / Risiko Tinggi
    created_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_riwayat_pengguna
        FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE INDEX idx_riwayat_id_pengguna ON riwayat_deteksi(id_pengguna);

-- ------------------------------------------------------------
-- Contoh data dummy (boleh dihapus jika tidak diperlukan)
-- ------------------------------------------------------------
INSERT INTO pengguna (nama, email, password) VALUES
('Andi Saputra', 'andi@example.com', '$2y$10$hashedpassword1'),
('Siti Rahma',   'siti@example.com', '$2y$10$hashedpassword2');

INSERT INTO riwayat_deteksi
(id_pengguna, HighBP, Smoker, Sex, Fruits, Veggies, BMI, BMI_Category, Age, Income, Education, GenHlth, MentHlth, PhysHlth, BMI_PhysActivity, RiskFactorCount, hasil_prediksi)
VALUES
(1, 1, 0, 1, 1, 1, 27.50, 'Overweight', 45, 6, 4, 3, 2, 5, 12.50, 3, 'Risiko Tinggi'),
(2, 0, 0, 0, 1, 1, 22.10, 'Normal',     30, 7, 5, 2, 0, 0,  6.30, 1, 'Risiko Rendah');
