<?php
require_once '../models/Kandidat.php';

class KandidatController {
    private $db;
    private $kandidat;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->kandidat = new Kandidat($this->db);
    }

    public function getAllKandidat() {
        return $this->kandidat->readAll();
    }

    public function getKandidatById($id) {
        $this->kandidat->id_kandidat = $id;
        $this->kandidat->readOne();
        return $this->kandidat;
    }

    public function addKandidat($data) {
        $this->kandidat->nama = $data['nama'];
        $this->kandidat->foto = $data['foto'];
        $this->kandidat->visi = $data['visi'];
        $this->kandidat->misi = $data['misi'];
        return $this->kandidat->create();
    }

    public function updateKandidat($id, $data) {
        $this->kandidat->id_kandidat = $id;
        $this->kandidat->nama = $data['nama'];
        $this->kandidat->foto = $data['foto'];
        $this->kandidat->visi = $data['visi'];
        $this->kandidat->misi = $data['misi'];
        return $this->kandidat->update();
    }

    public function deleteKandidat($id) {
        $this->kandidat->id_kandidat = $id;
        return $this->kandidat->delete();
    }
}
?>
