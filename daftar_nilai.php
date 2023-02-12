<?php
$kode_siswa = set_value('kode_siswa');
$row = $db->get_row("SELECT * FROM tb_siswa WHERE kode_siswa='$kode_siswa'");
?>
<form method="POST" action="?m=daftar_nilai&kode_siswa=<?= $kode_siswa ?>">
    <div class="card ">
        <div class="card-header">
            <strong>Silakan Daftar</strong>
        </div>
        <div class="card-body">
            <?php if ($_POST) include 'aksi.php' ?>
            <div class="mb-1">
                <label>Kode Siswa (NIS) <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_siswa" value="<?= set_value('kode_siswa', $row->kode_siswa) ?>" readonly />
            </div>
            <div class="mb-1">
                <label>Nama Siswa <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_siswa" value="<?= set_value('nama_siswa', $row->nama_siswa) ?>" readonly />
            </div>
            <div class="mb-1">
                <label>Kelas <span class="text-danger">*</span></label>
                <select class="form-select" name="kode_kelas">
                    <?= get_kelas_option(set_value('kode_kelas')) ?>
                </select>
            </div>
            <div class="mb-1">
                <label>Periode <span class="text-danger">*</span></label>
                <select class="form-select" name="kode_periode">
                    <?= get_periode_option(set_value('kode_periode')) ?>
                </select>
            </div>
            <?php foreach ($KRITERIA as $key => $val) : ?>
                <div class="mb-1">
                    <label><?= $val->nama_kriteria ?> <span class="text-danger">*</span></label>
                    <select class="form-select" name="kode_crisp[<?= $key ?>]">
                        <option value="">&nbsp;</option>
                        <?= get_crisp_option($key, isset($_POST['kode_crisp'][$key]) ? $_POST['kode_crisp'][$key] : '') ?>
                    </select>
                </div>
            <?php endforeach ?>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><span class="fa fa-save"></span> Daftar</button>
            <a class="btn btn-danger float-end" href="daftar.php"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</form>