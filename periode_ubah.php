<?php
$row = $db->get_row("SELECT * FROM tb_periode WHERE kode_periode='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah periode</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="mb-3">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_periode" readonly="readonly" value="<?= $row->kode_periode ?>" />
            </div>
            <div class="mb-3">
                <label>Nama periode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_periode" value="<?= set_value('nama_periode', $row->nama_periode) ?>" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=periode"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>