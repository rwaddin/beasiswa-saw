<form method="POST" action="?m=daftar_kode">
    <div class="card ">
        <div class="card-header">
            <strong>Masukkan NIS Anda</strong>
        </div>
        <div class="card-body">
            <?php if ($_POST) include 'aksi.php' ?>
            <div class="mb-2">
                <label>Kode Siswa (NIS) <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_siswa" value="<?= set_value('kode_siswa') ?>" />
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><span class="fa fa-search"></span> Berikutnya</button>
            <a class="btn btn-danger float-end" href="login.php"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</form>