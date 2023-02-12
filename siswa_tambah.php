<div class="page-header">
    <h1>Tambah Siswa</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="mb-3">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_siswa" value="<?= set_value('kode_siswa') ?>" />
            </div>
            <div class="mb-3">
                <label>Nama Siswa <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_siswa" value="<?= set_value('nama_siswa') ?>" />
            </div>
            <div class="mb-3">
                <label>Kelas <span class="text-danger">*</span></label>
                <select class="form-select" name="kode_kelas">
                    <?= get_kelas_option(set_value('kode_kelas')) ?>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=siswa"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>