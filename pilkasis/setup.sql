CREATE DATABASE IF NOT EXISTS pilkasis_db;

USE pilkasis_db;

CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'siswa') NOT NULL,
    status_memilih TINYINT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS kandidat (
    id_kandidat INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    foto VARCHAR(255),
    visi TEXT,
    misi TEXT
);

CREATE TABLE IF NOT EXISTS voting (
    id_voting INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_kandidat INT NOT NULL,
    waktu_vote DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_kandidat) REFERENCES kandidat(id_kandidat)
);

-- Insert default admin user (password: admin123)
INSERT IGNORE INTO users (username, password, role) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
