<?php

class KehadiranModel
{
    private $table = 'kehadiran';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllKehadiran()
    {
        $query = "SELECT ke.*, k.Nama_Karyawan, b.ID_Bidang, b.Nama_Bidang
                  FROM $this->table ke
                  LEFT JOIN karyawan k ON ke.id_karyawan = k.ID
                  LEFT JOIN bidang b ON k.ID_Bidang = b.ID_Bidang";

        $this->db->query($query);
        return $this->db->resultSet();
    }


    public function getKehadiranById($id)
    {
        // Sesuaikan dengan model yang Anda miliki
        $query = "SELECT ke.*, k.Nama_Karyawan, b.ID_Bidang, b.Nama_Bidang
                  FROM $this->table ke
                  LEFT JOIN karyawan k ON ke.id_karyawan = k.ID
                  LEFT JOIN bidang b ON k.ID_Bidang = b.ID_Bidang
                  WHERE ke.id_kehadiran=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahKehadiran($data)
    {
        // Periksa apakah ID Karyawan dan Tanggal sudah diberikan
        if (!isset($data['id_karyawan']) || !isset($data['tanggal'])) {
            return 0; // Gagal menambahkan kehadiran
        }

        $query = "INSERT INTO kehadiran (id_karyawan, tanggal) VALUES (:id_karyawan, :tanggal)";
        $this->db->query($query);
        $this->db->bind(':id_karyawan', $data['id_karyawan']);
        $this->db->bind(':tanggal', $data['tanggal']);
        $this->db->execute();

        return $this->db->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
    }



    public function updateDataKehadiran($data)
    {
        // Periksa apakah ID Karyawan, Tanggal, dan ID Kehadiran sudah diberikan
        if (!isset($data['id_karyawan']) || !isset($data['tanggal']) || !isset($data['id_kehadiran'])) {
            return 0; // Gagal mengupdate kehadiran
        }

        $query = "UPDATE kehadiran SET id_karyawan=:id_karyawan, tanggal=:tanggal WHERE id_kehadiran=:id_kehadiran";
        $this->db->query($query);
        $this->db->bind(':id_kehadiran', $data['id_kehadiran']);
        $this->db->bind(':id_karyawan', $data['id_karyawan']);
        $this->db->bind(':tanggal', $data['tanggal']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteKehadiran($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_kehadiran=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // Tambahan fitur untuk mendapatkan jumlah kehadiran per karyawan
    public function getJumlahKehadiranPerKaryawan()
    {
        $query = "SELECT k.Nama_Karyawan, COUNT(ke.id_kehadiran) as JumlahKehadiran
                  FROM karyawan k
                  LEFT JOIN kehadiran ke ON k.ID = ke.id_karyawan
                  GROUP BY k.Nama_Karyawan";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Fungsi untuk mendapatkan laporan kehadiran per bidang
    public function laporanKehadiranBidang()
    {
        $query = "SELECT b.ID_Bidang, b.Nama_Bidang, COUNT(kh.id_kehadiran) AS JumlahKehadiran
                  FROM bidang b
                  LEFT JOIN karyawan k ON b.ID_Bidang = k.ID_Bidang
                  LEFT JOIN kehadiran kh ON k.ID = kh.id_karyawan
                  GROUP BY b.ID_Bidang, b.Nama_Bidang
                  ORDER BY b.ID_Bidang";

        $this->db->query($query);
        return $this->db->resultSet();
    }
}
