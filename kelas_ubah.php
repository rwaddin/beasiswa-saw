<?php
$row = $db->get_row("SELECT * FROM tb_kelas WHERE kode_kelas='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah kelas</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="mb-3">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_kelas"  value="<?= set_value ('nama_kelas',$row->kode_kelas) ?>" />
            </div>
            <div class="mb-3">
                <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_kelas" value="<?= set_value('nama_kelas', $row->nama_kelas) ?>" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kelas"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>