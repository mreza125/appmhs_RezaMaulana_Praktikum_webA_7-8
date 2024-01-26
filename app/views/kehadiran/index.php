<!-- File: views/kehadiran_index.php -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kehadiran</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <?php Flasher::Message(); ?>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Kehadiran</h3>
                <div class="btn-group float-right">
                    <a href="<?= base_url; ?>/kehadiran/tambah" class="btn float-right btn-xs btn btn-primary">Tambah Kehadiran</a>
                    <a href="<?= base_url; ?>/kehadiran/laporan" class="btn float-right btn-xs btn btn-info" target="_blank">Laporan kehadiran</a>
                    <a href="<?= base_url; ?>/kehadiran/laporanKehadiranPerBidang" class="btn float-right btn-xs btn btn-warning" target="_blank">Lihat Laporan kehadiran</a>
                    <a href="<?= base_url; ?>/kehadiran/laporanJumlahkehadiran" class="btn float-right btn-xs btn btn-success" target="_blank">Lihat kehadiran Per Prodi</a>
                    <!-- Tambahkan tombol lain sesuai kebutuhan -->
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nama Karyawan</th>
                            <th>Nama Bidang</th>
                            <th>Tanggal</th>
                            <th style="width:150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['kehadiran'] as $kehadiran) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $kehadiran['Nama_Karyawan']; ?></td>
                                <td><?= $kehadiran['Nama_Bidang']; ?></td>
                                <td><?= $kehadiran['tanggal']; ?></td>
                                <td>
                                    <a href="<?= base_url; ?>/kehadiran/edit/<?= $kehadiran['id_kehadiran'] ?>" class="badge badge-info">Edit</a>
                                    <a href="<?= base_url; ?>/kehadiran/hapus/<?= $kehadiran['id_kehadiran'] ?>" class="badge badge-danger" onclick="return confirm('Hapus data?');">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->