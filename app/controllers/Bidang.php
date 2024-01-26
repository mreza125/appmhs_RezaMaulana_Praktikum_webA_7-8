<?php

class Bidang extends Controller
{
    public function __construct()
    {
        // Tambahkan logic autentikasi atau sesuaikan dengan kebutuhan
        // Contoh: Check login atau role user
    }

    public function index()
    {
        $data['title'] = 'Data Bidang';
        $data['bidang'] = $this->model('BidangModel')->getAllBidang();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('bidang/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Bidang';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('bidang/create', $data);
        $this->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Bidang';
        $data['bidang'] = $this->model('BidangModel')->getBidangById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('bidang/edit', $data);
        $this->view('templates/footer');
    }

    public function simpanBidang()
    {
        if ($this->model('BidangModel')->tambahBidang($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/bidang');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/bidang');
            exit;
        }
    }

    public function update()
    {
        if ($this->model('BidangModel')->updateBidang($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location:' . base_url . '/bidang');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location:' . base_url . '/bidang');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('BidangModel')->deleteBidang($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location:' . base_url . '/bidang');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/bidang');
            exit;
        }
    }
}
