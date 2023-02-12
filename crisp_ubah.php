<?php
$row = $db->get_row("SELECT * FROM tb_crisp WHERE kode_crisp='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Subkriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="mb-3">
                <label>Kriteria</label>
                <select class="form-select" name="kode_kriteria"><?= get_kriteria_option(set_value('kode_kriteria', $row->kode_kriteria)) ?></select>
            </div>
            <div class="mb-3">
                <label>Nama Subkriteria</label>
                <input class="form-control" type="text" name="nama_crisp" value="<?= set_value('nama_crisp', $row->nama_crisp) ?>" />
            </div>
            <div class="mb-3">
                <label>Nilai</label>
                <input class="form-control" type="text" name="nilai" value="<?= set_value('nilai', $row->nilai) ?>" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=crisp"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>