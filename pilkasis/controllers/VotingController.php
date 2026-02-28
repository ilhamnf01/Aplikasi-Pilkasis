<?php
require_once __DIR__ . '/../models/Voting.php';
require_once __DIR__ . '/../models/Kandidat.php';
require_once __DIR__ . '/../models/User.php';

class VotingController
{
    private $vModel;
    private $kModel;

    public function __construct()
    {
        $this->vModel = new Voting();
        $this->kModel = new Kandidat();
    }

    public function vote($data)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /pilkasis');
            return;
        }
        $userId = $_SESSION['user']['id'];
        $kandidatId = $data['kandidat'] ?? null;
        if (!$kandidatId) {
            $_SESSION['flash'] = 'Pilih kandidat terlebih dahulu.';
            header('Location: /pilkasis');
            return;
        }
        if ($this->vModel->hasUserVoted($userId)) {
            $_SESSION['flash'] = 'Anda sudah memilih.';
            header('Location: /pilkasis');
            return;
        }
        $ok = $this->vModel->addVote($userId, $kandidatId);
        $_SESSION['flash'] = $ok ? 'Suara tersimpan. Terima kasih.' : 'Gagal menyimpan suara.';
        header('Location: /pilkasis');
    }

    public function results()
    {
        $results = $this->vModel->getResults();
        include __DIR__ . '/../views/hasil.php';
    }
}
