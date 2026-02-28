<?php
require_once __DIR__ . '/../config/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id_user = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function verifyPassword($username, $password)
    {
        $user = $this->findByUsername($username);
        if (!$user) return false;
        return password_verify($password, $user['password']);
    }

    public function markVoted($id)
    {
        $stmt = $this->db->prepare('UPDATE users SET status_memilih = 1 WHERE id_user = ?');
        return $stmt->execute([$id]);
    }

    public function create($username, $password, $role = 'siswa')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO users (username, password, role, status_memilih) VALUES (?, ?, ?, 0)');
        return $stmt->execute([$username, $hash, $role]);
    }
}
