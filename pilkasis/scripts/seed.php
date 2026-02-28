<?php
require_once __DIR__ . '/../config/Database.php';

$pdo = Database::getConnection();

// create tables
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'siswa',
    status_memilih TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$pdo->exec("CREATE TABLE IF NOT EXISTS kandidat (
    id_kandidat INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    visi TEXT,
    misi TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$pdo->exec("CREATE TABLE IF NOT EXISTS voting (
    id_voting INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_kandidat INT NOT NULL,
    waktu_vote DATETIME NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_kandidat) REFERENCES kandidat(id_kandidat) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// seed users
$u = $pdo->prepare('SELECT COUNT(*) as cnt FROM users');
$u->execute();
$r = $u->fetch();
if ($r && $r['cnt'] == 0) {
    $stmt = $pdo->prepare('INSERT INTO users (username, password, role, status_memilih) VALUES (?, ?, ?, 0)');
    $stmt->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT), 'admin']);
    $stmt->execute(['siswa1', password_hash('siswa123', PASSWORD_DEFAULT), 'siswa']);
    echo "Seeded users\n";
}

// seed kandidat
$k = $pdo->prepare('SELECT COUNT(*) as cnt FROM kandidat');
$k->execute();
$rk = $k->fetch();
if ($rk && $rk['cnt'] == 0) {
    $stmt = $pdo->prepare('INSERT INTO kandidat (nama, visi, misi) VALUES (?, ?, ?)');
    $stmt->execute(['Andi', 'Meningkatkan kegiatan ekstrakurikuler', 'Membangun komunikasi']);
    $stmt->execute(['Budi', 'Ramah dan adil untuk semua siswa', 'Mengadakan lomba rutin']);
    echo "Seeded kandidat\n";
}

echo "Done.\n";
