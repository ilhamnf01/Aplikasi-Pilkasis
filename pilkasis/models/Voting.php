<?php
require_once __DIR__ . '/../config/Database.php';

class Voting
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function hasUserVoted($userId)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as cnt FROM voting WHERE id_user = ?');
        $stmt->execute([$userId]);
        $r = $stmt->fetch();
        return $r && $r['cnt'] > 0;
    }

    public function addVote($userId, $kandidatId)
    {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare('INSERT INTO voting (id_user, id_kandidat, waktu_vote) VALUES (?, ?, NOW())');
            $stmt->execute([$userId, $kandidatId]);
            $stmt2 = $this->db->prepare('UPDATE users SET status_memilih = 1 WHERE id_user = ?');
            $stmt2->execute([$userId]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getResults()
    {
        $stmt = $this->db->query('SELECT k.id_kandidat, k.nama, COUNT(v.id_voting) as votes FROM kandidat k LEFT JOIN voting v ON k.id_kandidat=v.id_kandidat GROUP BY k.id_kandidat, k.nama ORDER BY votes DESC');
        return $stmt->fetchAll();
    }
}
