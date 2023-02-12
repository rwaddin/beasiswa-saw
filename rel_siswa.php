<div class="page-header">
    <h1>Data Pendaftaran</h1>
</div>
<?php
$kode_periode = _get('kode_periode');
?>
<div class="card">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <input type="hidden" name="m" value="rel_siswa" />
            <div class="col-auto">
                <select class="form-select" name="kode_periode" onchange="this.form.submit()">
                    <option value="">Pilih periode</option>
                    <?= get_periode_option($kode_periode) ?>
                </select>
            </div>
            <div class="col-auto">
                <a class="btn btn-secondary" href="cetak.php?m=rel_siswa&kode_periode=<?= $kode_periode ?>" target="_blank"><span class="fa fa-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <?php if ($kode_periode) : ?>
        <div class="card-body">
            <?php
            if ($_POST) include 'aksi.php';
            ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <?php foreach ($KRITERIA as $key => $val) : ?>
                            <th><?= $val->nama_kriteria ?></th>
                        <?php endforeach ?>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php
                $rel_siswa = get_rel_siswa(_get('kode_periode'));
                $rel_status = get_rel_status(_get('kode_periode'));
                $no = 1;
                foreach ($rel_siswa as $key => $val) : ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $key ?></td>
                        <td><?= $SISWA[$key]->nama_siswa ?></td>
                        <td><?= $SISWA[$key]->nama_kelas ?></td>
                        <?php foreach ($val as $k => $v) : ?>
                            <td><?= isset($CRISP[$v]) ? $CRISP[$v]->nama_crisp : '' ?></td>
                        <?php endforeach ?>
                        <td>
                            <?= $rel_status[$key] ?>
                            (
                            <a href="aksi.php?act=rel_siswa_status&status=<?= $rel_status[$key] == 'Acc' ? 'Pending' : 'Acc' ?>&kode_siswa=<?= $key ?>&kode_periode=<?= $kode_periode ?>" onclick="return confirm('<?= $rel_status[$key] == 'Acc' ? 'Pending' : 'Acc' ?> data?')"><?= $rel_status[$key] == 'Acc' ? 'Pending' : 'Acc' ?></a>
                            )
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="?m=rel_siswa_ubah&kode_periode=<?= $kode_periode ?>&ID=<?= $key ?>"><span class="fa fa-edit"></span> Ubah</a>
                            <a class="btn btn-sm btn-danger" href="aksi.php?act=rel_siswa_hapus&kode_periode=<?= $kode_periode ?>&kode_siswa=<?= $key ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif ?>
</div>