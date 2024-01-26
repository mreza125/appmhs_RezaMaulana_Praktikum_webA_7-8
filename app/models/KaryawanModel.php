<?php

class KaryawanModel
{
    private $table = 'karyawan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getKaryawanById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ID=:id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function getAllKaryawan()
    {
        $this->db->query('SELECT k.*, b.Nama_Bidang FROM ' . $this->table . ' k JOIN bidang b ON k.ID_Bidang = b.ID_Bidang');
        return $this->db->resultSet();
    }

    public function tambahKaryawan($data)
    {
        $query = "INSERT INTO karyawan(Nama_Karyawan, ID_Bidang, Tanggal_Masuk) VALUES (:nama_karyawan, :id_bidang, :tanggal_masuk)";
        $this->db->query($query);
        $this->db->bind('nama_karyawan', $data['Nama_Karyawan']);
        $this->db->bind('id_bidang', $data['ID_Bidang']);
        $this->db->bind('tanggal_masuk', $data['Tanggal_Masuk']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // KaryawanModel.php
    public function updateKaryawan($data)
    {
        $query = 'UPDATE karyawan SET Nama_Karyawan=:nama_karyawan, ID_Bidang=:id_bidang, Tanggal_Masuk=:tanggal_masuk WHERE ID=:id';
        $this->db->query($query);
        $this->db->bind('nama_karyawan', $data['nama_karyawan']);
        $this->db->bind('id_bidang', $data['id_bidang']);
        $this->db->bind('tanggal_masuk', $data['tanggal_masuk']);
        $this->db->bind('id', $data['id_karyawan']); // Tidak perlu binding untuk ID
        $this->db->execute();
        return $this->db->rowCount();
    }







    public function deleteKaryawan($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE ID=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
