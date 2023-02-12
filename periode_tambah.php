<div class="page-header">
    <h1>Tambah Periode</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="mb-3">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_periode" value="<?= set_value('kode_periode', kode_oto('kode_periode', 'tb_periode', 'P', 3)) ?>" />
            </div>
            <div class="mb-3">
                <label>Nama Periode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_periode" value="<?= set_value('nama_periode') ?>" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=periode"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>