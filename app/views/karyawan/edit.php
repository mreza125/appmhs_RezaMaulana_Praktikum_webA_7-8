<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Karyawan</h1>
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
            <!-- Edit.php -->
            <form role="form" action="<?= base_url; ?>/karyawan/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_karyawan" value="<?= $data['karyawan']['ID']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama karyawan..." name="nama_karyawan" value="<?= $data['karyawan']['Nama_Karyawan']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Bidang</label>
                        <select class="form-control" name="id_bidang">
                            <?php foreach ($data['bidang'] as $bidang) : ?>
                                <option value="<?= $bidang['ID_Bidang']; ?>" <?= ($bidang['ID_Bidang'] == $data['karyawan']['ID_Bidang']) ? 'selected' : ''; ?>>
                                    <?= $bidang['Nama_Bidang']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="<?= $data['karyawan']['Tanggal_Masuk']; ?>">
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