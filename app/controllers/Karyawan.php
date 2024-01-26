<?php

class Karyawan extends Controller
{
    public function __construct()
    {
        // Tambahkan logic autentikasi atau sesuaikan dengan kebutuhan
        // Contoh: Check login atau role user
    }

    public function index()
    {
        $data['title'] = 'Data Karyawan';
        $data['karyawan'] = $this->model('KaryawanModel')->getAllKaryawan();
        $data['bidang'] = $this->model('BidangModel')->getAllBidang(); // Ambil data bidang untuk dropdown
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('karyawan/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Karyawan';
        $data['bidang'] = $this->model('BidangModel')->getAllBidang(); // Ambil data bidang untuk dropdown
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('karyawan/create', $data);
        $this->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Karyawan';
        $data['karyawan'] = $this->model('KaryawanModel')->getKaryawanById($id);
        $data['bidang'] = $this->model('BidangModel')->getAllBidang(); // Ambil data bidang untuk dropdown
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('karyawan/edit', $data);
        $this->view('templates/footer');
    }

    public function simpanKaryawan()
    {
        if ($this->model('KaryawanModel')->tambahKaryawan($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/karyawan');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/karyawan');
            exit;
        }
    }

    // Karyawan.php
    public function update()
    {
        if ($this->model('KaryawanModel')->updateKaryawan($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location:' . base_url . '/karyawan');
            exit;
        } else {

            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location:' . base_url . '/karyawan');
            exit;
        }
    }


    public function delete($id)
    {
        if ($this->model('KaryawanModel')->deleteKaryawan($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location:' . base_url . '/karyawan');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/karyawan');
            exit;
        }
    }
}
