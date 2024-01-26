<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $data['title']; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url; ?>/kehadiran/updateKehadiran" method="POST">
                <input type="hidden" name="id_kehadiran" value="<?= $data['kehadiran']['id_kehadiran']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Karyawan</label>
                        <select class="form-control" name="id_karyawan">
                            <?php foreach ($data['karyawan'] as $karyawan) : ?>
                                <option value="<?= $karyawan['ID']; ?>" <?php if ($data['kehadiran']['id_karyawan'] == $karyawan['ID']) {
                                                                            echo "selected";
                                                                        } ?>>
                                    <?= $karyawan['Nama_Karyawan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= $data['kehadiran']['tanggal']; ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->