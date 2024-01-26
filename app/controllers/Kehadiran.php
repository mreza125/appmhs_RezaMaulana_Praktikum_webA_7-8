<?php

class Kehadiran extends Controller
{
    public function __construct()
    {
        // Sesuaikan dengan kebutuhan autentikasi atau middleware yang Anda miliki
        // Contoh autentikasi sederhana
        if (!isset($_SESSION['session_login']) || $_SESSION['session_login'] !== 'sudah_login') {
            Flasher::setMessage('Login', 'Tidak ditemukan.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Kehadiran';
        $data['kehadiran'] = $this->model('KehadiranModel')->getAllKehadiran();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kehadiran/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Kehadiran';
        // Sesuaikan dengan model yang Anda miliki
        $data['karyawan'] = $this->model('KaryawanModel')->getAllKaryawan();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kehadiran/create', $data);
        $this->view('templates/footer');
    }

    public function simpanKehadiran()
    {
        if ($this->model('KehadiranModel')->tambahKehadiran($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/kehadiran');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/kehadiran');
            exit;
        }
    }

    private function getKaryawanNameById($id)
    {
        // Sesuaikan dengan model yang Anda miliki
        $karyawan = $this->model('KaryawanModel')->getKaryawanById($id);

        if ($karyawan) {
            return $karyawan['Nama_Karyawan'];
        }

        return '';
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Kehadiran';
        $data['kehadiran'] = $this->model('KehadiranModel')->getKehadiranById($id);
        // Sesuaikan dengan model yang Anda miliki
        $data['karyawan'] = $this->model('KaryawanModel')->getAllKaryawan();

        // Tambahkan informasi karyawan terkait untuk kehadiran yang sedang diedit
        $data['kehadiran']['nama_karyawan'] = $this->getKaryawanNameById($data['kehadiran']['id_karyawan']);

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kehadiran/edit', $data);
        $this->view('templates/footer');
    }
    public function updateKehadiran()
    {
        if ($this->model('KehadiranModel')->updateDataKehadiran($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location: ' . base_url . '/kehadiran');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location: ' . base_url . '/kehadiran');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('KehadiranModel')->deleteKehadiran($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/kehadiran');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/kehadiran');
            exit;
        }
    }

    public function laporan()
    {
        $data['kehadiran'] = $this->model('KehadiranModel')->getAllKehadiran();
        $pdf = new FPDF('p', 'mm', 'A4');

        // Membuat halaman baru
        $pdf->AddPage();
        // Setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 14);
        // Mencetak string
        $pdf->Cell(190, 7, 'LAPORAN KEHADIRAN', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 6, 'Nama Karyawan', 1);
        $pdf->Cell(80, 6, 'Bidang', 1);
        $pdf->Cell(40, 6, 'Tanggal', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['kehadiran'] as $row) {
            $pdf->Cell(40, 6, $row['Nama_Karyawan'], 1);
            $pdf->Cell(80, 6, $row['Nama_Bidang'], 1);
            $pdf->Cell(40, 6, date('d-m-Y', strtotime($row['tanggal'])), 1);
            $pdf->Ln();
        }
        $pdf->Output('I', 'Laporan Kehadiran.pdf', true);
    }
    public function laporanKehadiranPerBidang()
    {
        $data['title'] = 'Laporan Kehadiran per Bidang';
        $data['laporanKehadiran'] = $this->model('KehadiranModel')->laporanKehadiranBidang();
        $this->view('kehadiran/laporankehadiranbidang', $data);
    }
}
