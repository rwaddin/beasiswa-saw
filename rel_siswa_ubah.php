<?php
$row = $db->get_row("SELECT * FROM tb_siswa WHERE kode_siswa='$_GET[ID]'");
$kode_periode = _get('kode_periode');
?>
<div class="page-header">
    <h1>Ubah Nilai Bobot &raquo; <small><?= $row->nama_siswa ?></small></h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <?php
            $rows = $db->get_results("SELECT * FROM tb_rel_siswa WHERE kode_periode='$kode_periode' AND kode_siswa='$_GET[ID]' ORDER BY kode_kriteria");
            foreach ($rows as $row) : ?>
                <div class="mb-3">
                    <label><?= $KRITERIA[$row->kode_kriteria]->nama_kriteria ?></label>
                    <select class="form-select" name="kode_crisp[<?= $row->ID ?>]">
                        <?= get_crisp_option($row->kode_kriteria, $row->kode_crisp) ?>
                    </select>
                </div>
            <?php endforeach ?>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=rel_siswa&kode_periode=<?= $kode_periode ?>"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>