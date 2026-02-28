<?php
require_once __DIR__ . '/../config/Database.php';

class Kandidat
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM kandidat ORDER BY id_kandidat');
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM kandidat WHERE id_kandidat = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function countVotes($id)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as cnt FROM voting WHERE id_kandidat = ?');
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        return $r ? (int)$r['cnt'] : 0;
    }
}
