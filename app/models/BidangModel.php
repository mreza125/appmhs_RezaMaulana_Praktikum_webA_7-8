<?php

class BidangModel
{
    private $table = 'bidang';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getBidangById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ID_Bidang=:id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function getAllBidang()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function tambahBidang($data)
    {
        $query = "INSERT INTO bidang( Nama_Bidang) VALUES ( :nama_bidang)";
        $this->db->query($query);
        $this->db->bind('nama_bidang', $data['Nama_Bidang']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateBidang($data)
    {
        $query = 'UPDATE bidang SET Nama_Bidang=:nama_bidang WHERE ID_Bidang=:id';
        $this->db->query($query);
        $this->db->bind('nama_bidang', $data['nama_bidang']);
        $this->db->bind('id', $data['id_bidang']); // Ini tetap diperlukan untuk mencocokkan ID yang akan diupdate
        $this->db->execute();
        return $this->db->rowCount();
    }



    public function deleteBidang($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE ID_Bidang=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
