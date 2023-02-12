<div class="page-header">
    <h1>Siswa</h1>
</div>
<?php
$kode_kelas = _get('kode_kelas');
?>
<div class="card">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <input type="hidden" name="m" value="siswa" />
            <div class="col-auto">
                <select class="form-select" name="kode_kelas" onchange="this.form.submit()">
                    <option value="">Semua kelas</option>
                    <?= get_kelas_option($kode_kelas) ?>
                </select>
            </div>
            <div class="col-auto">
                <input class="form-control" type="text" placeholder="Pencarian Dengan Nama" name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="col-auto">
                <a class="btn btn-primary" href="?m=siswa_tambah"><span class="fa fa-plus"></span> Tambah</a>
            </div>
            <div class="col-auto">
                <a class="btn btn-secondary" target="_blank" href="cetak.php?m=siswa&kode_kelas=<?= $kode_kelas ?>"><span class="fa fa-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped m-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field(_get('q'));
        $where = "WHERE nama_siswa LIKE '%$q%'";
        if ($kode_kelas)
            $where .= " AND s.kode_kelas='$kode_kelas'";
        $rows = $db->get_results("SELECT * FROM tb_siswa s LEFT JOIN tb_kelas k ON k.kode_kelas=s.kode_kelas $where ORDER BY kode_siswa");
        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->kode_siswa ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->nama_kelas ?></td>
                <td class="text-nowrap">
                    <a class="btn btn-sm btn-warning" href="?m=siswa_ubah&ID=<?= $row->kode_siswa ?>"><span class="fa fa-edit"></span></a>
                    <a class="btn btn-sm btn-danger" href="aksi.php?act=siswa_hapus&ID=<?= $row->kode_siswa ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="card-footer">
        Total Siswa: <?= count($rows) ?>
    </div>
</div>